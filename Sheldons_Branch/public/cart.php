<?php
require("includes/header.inc.php");

?>

	<ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li class="active">Cart</li>
    </ol>
    <h1>Your Cart</h1>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr valign="middle">
                    <th colspan="2">Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
<?php 

// Initiate counters for loop
$i = 0;
$count = count($_SESSION['cart']);

// Loop through itemName array
for($i=0; $i<$count; $i++) {
	$subtotal[$i] = ($_SESSION['cart'][$i]['price'] * $_SESSION['cart'][$i]['qty']);
?>
                    <tr>
                        <td><img src="<?= $_SESSION['cart'][$i]['img'] ?>" width="50px" /></td>
                        <td class="name"><?= $_SESSION['cart'][$i]['name'] ?></td>
                        <td>$<?= $_SESSION['cart'][$i]['price'] ?></td>
                        <td><?= $_SESSION['cart'][$i]['qty'] ?></td>	
						<td>$<?= $subtotal[$i] ?></td>		
                        <td>
                        <form method="post" action="func/del_cart_item.func.php">
                            <input name="deleteID" type="hidden" value="<?= $i ?>" />
                            <button type="submit" class="btn btn-lg btn-danger">Delete</button>
                        </form>
                        </td>
                    </tr>
<?php
}

// Set totalPrice as the sum of all values in itemPrice array
$totalPrice = array_sum($subtotal);

?>
					<tr>
                    	<!-- Echo out the totalPrice value -->
                        <td colspan="4"><h3 align="right">Total: </h3></td>
						<td colspan="1" style="border-left: #ddd 1px solid;"><h3>$<?= $totalPrice ?></h3></td>
                        <td colspan="1"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a href="billing.php" title="Pay Now"><button type="submit" class="btn btn-lg btn-success">Buy Now</button></a>
    </div>
</div>


<?php
require("includes/footer.inc.php");
?>