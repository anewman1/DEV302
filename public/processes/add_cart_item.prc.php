<?php 
session_start();

// Receive new cart item details (If sent)
$id = (isset($_POST['productID']) && ($_POST['productID'] != "") ? $_POST['productID'] : NULL);
$size = (isset($_POST['productSize']) && ($_POST['productSize'] != "") ? $_POST['productSize'] : NULL);
$qty = (isset($_POST['qty']) && ($_POST['qty'] != "") ? $_POST['qty'] : NULL);

// Create the products file handle
$filename = ("../data/products.csv");
// Open the file with read only access
$fh = fopen($filename, "r");
// Create the Products Array
$products = array();

// Loop through the file
while(list($productType, $productName, $productImage, $productDesc, $productPrice) = fgetcsv($fh)) {
	
	// Put the values into a product array
	$product = array();
	$product['productName'] = $productName;
	$product['productImage'] = $productImage;
	$product['productPrice'] = $productPrice;
	
	// Add the product to the Products array
	// Note: product id becomes index for products array
	$products[] = $product;
}

fclose($fh);

unset($product);

$product = array("name" => $products[$id]['productName'], "img" => $products[$id]['productImage'], "price" => $products[$id]['productPrice']);

unset($products);

$_SESSION['cart'][] = array(
	"name" => $product['name'], 
	"img" => $product['img'], 
	"size" => $size, 
	"qty" => $qty, 
	"price" => $product['price']
);

// Redirect the user back to the Product page
header("Location: ../cart.php");

?>