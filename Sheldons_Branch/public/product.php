<?php
    // START SESSION and set VARIABLES
    session_start();
    $loggedIn = (isset($_SESSION['login'])!= "")? $_SESSION['login'] : null;
    $USER = (isset($_SESSION['user'])!= "")? $_SESSION['user'] : null;
	
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
	$alias = $_SESSION['alias'];
	$alias = preg_replace('/\-/', ' ', $alias);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="DEV - The Fighting Mongooses">
    
    <title>DEV_Store</title>
    
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../css/styles.css" rel="stylesheet" type="text/css" media="all"/>
    <style>
        body{
            padding-top: 50px;
            padding-bottom: 20px;
            /*background-image: url("../img/dark_mosaic.png"); //www.subtlepatterns.com*/
            background-image: url("../img/crossword.png"); //www.subtlepatterns.com
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">DEV Store</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="../products.php">Products</a></li>
                    <li><a href="../index.php#about">About</a></li>
                    <li><a href="../contact.php">Contact</a></li>
                    <li><a href="../cart.php">Cart <span class="badge"><?= $cart ?>0</span></a></li>
                </ul>
                
                <?php
                    // DISPLAYS LOG IN BAR IF NOT LOGGED IN
                    if(!$loggedIn){ 
                ?>
                <form class="navbar-form navbar-right" name="login" method="POST" action="../login.php">
                    <div class="form-group">
                    <input type="text" placeholder="Username" class="form-control" name="user">
                    </div>
                    <div class="form-group">
                    <input type="password" placeholder="Password" class="form-control" name="pass">
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-success">Log in</button>
                    </div>
                    <div class="form-group">
                    <a href="../register.php"><button type="button" class="btn btn-danger">Register</button></a>
                    </div>
                </form>
                <?php
                    // DISPLAYS USERNAME GREETING IF LOGGED IN
                    }elseif($loggedIn == true){ 
                ?>
                <a class="navbar-right navbar-brand" href="../logout.php">Welcome, <?=$USER?></a>
                <?php
                    }
                ?>
                
            </div><!--/.navbar-collapse -->
        </div>
    </nav> <!-- END of NAVBAR-->
    
    <div class="container">

<?php	
	//import the database connection script
	require("../private/db.inc.php");
	
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
            while($img = $imgsth->fetch(PDO::FETCH_ASSOC)) {
				
				
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
