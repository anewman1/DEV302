<?php

// Check if 'alias' is set in the session
if (isset($_SESSION['alias'])) {
    // Check if a different alias is available in the URL
    if (isset($_GET['alias']) && ($_GET['alias'] !== $_SESSION['alias']) && ($_GET['alias'] != '')) {
        // Update the Session variable
        $_SESSION['alias'] = $_GET['alias'];
    }
} else {
    // If it isn't, check that a value is available in the URL
    if (isset($_GET['alias']) && ($_GET['alias'] != '')) {
        // If there is, set the Session variable to match
        $_SESSION['alias'] = $_GET['alias'];
    }
}

// Get the value of alias
// Replace hyphens with spaces
$alias = (isset($_SESSION['$alias']) != "") ? $_SESSION['$alias'] : null;
$alias = preg_replace('/\-/', ' ', $alias);

//$cart=null;



require 'includes/header.inc.php';




//import the database connection script
require("../private/db.connect.php");

$prodQuery = "
		SELECT prod.id, prod.name, prod.description
		FROM product AS prod
		WHERE prod.name LIKE '%$alias%';
	";

$sth = $pdo->query($prodQuery);
$product = $sth->fetch();
$id = $product['id'];

$imgQuery = "
		SELECT img.image 
		FROM image AS img
		WHERE img.product_id = '$id';
	";

$priceQuery = "
		SELECT price.price
		FROM price
		WHERE price.product_id = '$id'
		ORDER BY price.date DESC
		LIMIT 1;
	";
?>

<div id="content" class="clearfix">
    <div id="product-container" class="clearfix">
        <div id="product-pic" class="clearfix">
<?php
//$sth->closeCursor();
$imgsth = $pdo->query($imgQuery);
while ($img = $imgsth->fetch(PDO::FETCH_ASSOC)) {
    ?>
                <img src="../<?= $img['image'] ?>" alt="<?= $product['name'] ?>" title="<?= $product['name'] ?>" />
                <?php
            }
            ?>
        </div>
        <div id="product-info">
            <h1><?= $product['name'] ?></h1>
            <p><?= $product['description'] ?></p>
            <h2>$25</h2>
            <!-- Display the add to cart form -->
            <form name="cart-add" method="post" action="cart.php">
                <label for="size" title="Size">Size: </label>
                <select name="productSize" required title="Size">
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Large">Large</option>
                    <option value="X-Large">X-Large</option>
                </select>
                <br />
                <label for="qty" title="Qty">Qty: </label>
                <select name="qty" required title="Qty">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
                <br />
                <!-- Create hidden fields containing product info -->
                <input name="productName" type="hidden" value="<?php echo($productName); ?>" />
                <input name="productImage" type="hidden" value="<?php echo($productImage); ?>" />
                <input name="productPrice" type="hidden" value="<?php echo($productPrice); ?>" />
                <button type="submit" class="btn btn-lg btn-success">Add to Cart</button>
            </form>
        </div>
    </div>
</div>
</div>
</div>

<?php
require 'includes/footer.inc.php';
?>
