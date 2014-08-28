<?php
    session_start();
	
    $loggedIn = (isset($_SESSION['login'])!= "")? $_SESSION['login'] : NULL;
    $USER = (isset($_SESSION['user'])!= "")? $_SESSION['user'] : NULL;
	$access = (isset($_SESSION['user']['access']) ? $_SESSION['user']['access'] : NULL);
	
	$_SESSION['user']['access'] = $access;
	// Prevents access to ADMIN TOOLS if not logged in as admin.
    $location = $_SERVER['SCRIPT_NAME'];
    $url = explode('/', $location);
    $num = count($url);
    $adminTool = $url[$num-1];
    if($access !== 'admin' && $adminTool == 'adminTools.php'){
        header("Location: index.php");
    }
	
	if (!isset($_SESSION['cart']) || (empty($_SESSION['cart']))) {

		$_SESSION['cart'][] = array(
			"name" => "Black Bong Tee", 
			"img" => "img/store/fullmetal_alch.png", 
			"qty" => 2, 
			"price" => 40
		);
		$_SESSION['cart'][] = array(
			"name" => "White Bong Tee", 
			"img" => "img/store/fullmetal_alch.png",
			"qty" => 1, 
			"price" => 40
		);
	}
	
	$i = 0;
	$count = count($_SESSION['cart']);
	
	for($i=0; $i<$count; $i++) {
		$cartQty[] = $_SESSION['cart'][$i]['qty'];
	}
	
	$cartQty = array_sum($cartQty);

	
	// Check if 'alias' is set in the session
	if (isset($_SESSION['alias'])) {
		// Check if a different alias is available in the URL
		if (isset($_GET['alias']) && ($_GET['alias'] !== $_SESSION['alias']) && ($_GET['alias'] != '')) {
			$alias = explode('-', $_GET['alias'], 2);
			
			// Update the Session variable
			$_SESSION['alias'] = $alias;
		}
	} else {
		// If it isn't, check that a value is available in the URL
		if (isset($_GET['alias']) && ($_GET['alias'] != '')) {
			$alias = explode('-', $_GET['alias'], 2);
			
			// If there is, set the Session variable to match
			$_SESSION['alias'] = $alias;
			
		}
	}
	
	$id = $_SESSION['alias'][0];
	// Get the value of alias
	// Replace hyphens with spaces
	$alias = $_SESSION['alias'][1];
	$alias = preg_replace('/\-/', ' ', $alias);
	
	date_default_timezone_set('Australia/Brisbane');
	$date = date("Y-m-d H:i:s");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>The DVD Store</title>
    <script src="../js/jquery-1.10.2.min.js" type="text/javascript"></script>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/jquery.bxslider.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <script type="text/javascript">
		$(document).ready(function() {
            $('.p-toggle').click(function(e) {
				e.preventDefault();
				$('#product-info p').toggleClass('small');
				if ($('.p-toggle').text() == "Show More") {
					$('.p-toggle').text("Show Less");
				} else {
					$('.p-toggle').text("Show More");
				}
			});
        });
		
	</script>
</head>
<body>
	<header>
	    <div class="container">
	        <div class="row">

	        	<!-- Logo -->
	            <div class="col-lg-4 col-md-3 hidden-sm hidden-xs">
	            	<div class="well logo">
	            		<a href="../index.php">
	            			The DVD Store <span>Online Shop</span>
	            		</a>
	            		<div>Australia's largest collection of movies online today!</div>
	            	</div>
	            </div>
	            <!-- End Logo -->

				<!-- Search Form -->
	            <div class="col-lg-5 col-md-5 col-sm-7 col-xs-12">
	            	<div class="well">
	                    <form action="">
	                        <div class="input-group">
	                            <input type="text" class="form-control input-search" placeholder="Enter something to search"/>
	                            <span class="input-group-btn">
	                                <button class="btn btn-default no-border-left" type="submit"><i class="fa fa-search"></i></button>
	                            </span>
	                        </div>
	                    </form>
	                </div>
	            </div>
                
                
	            <!-- End Search Form -->

	            <!-- Shopping Cart List -->
	            <div class="col-lg-3 col-md-4 col-sm-5">
	                <div class="well">
	                    <div class="btn-group btn-group-cart">
	                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
	                            <span class="pull-left"><i class="fa fa-shopping-cart icon-cart"></i></span>
	                            <span class="pull-left">Shopping Cart: 2 item(s)</span>
	                            <span class="pull-right"><i class="fa fa-caret-down"></i></span>
	                        </button>
	                        <ul class="dropdown-menu cart-content" role="menu">
                                <li>
                                    <b>Fullmetal Alchemist: Brotherhood Collection</b>
                                    <span>x1 $29.99</span>
                                </li>
                                <li>
                                    <b>Game of Thrones: Season 1</b>
                                    <span>x1 $34.99</span>
                                </li>
                                <li class="divider"></li>
                                <li><a href="../cart.html">Total: $64.98</a></li>
                            </ul>
	                    </div>
	                </div>
	            </div>
	            <!-- End Shopping Cart List -->
	        </div>
	    </div>
    </header>

	<!-- Navigation -->
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- text logo on mobile view -->
                <a class="navbar-brand visible-xs" href="../index.html">Th</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../about.php">About</a></li>
                    <li class="nav-dropdown">
                    	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							Products <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
                            <li><a href="../products.php">New Releases</a></li>
                            <li><a href="../products.php">DVDs</a></li>
                            <li><a href="../products.php">Games</a></li>
                            <li><a href="../products.php">TV Series</a></li>
                            <li><a href="../products.php">Blu Ray</a></li>
						</ul>
                    </li>
                    <li><a href="../blog.php">Blog</a></li>
                    <li><a href="../contact.php">Contact</a></li>
                    <li><a href="../cart.php">Cart</a></li>
                </ul>
                                <?php
                    // DISPLAYS LOG IN BAR IF NOT LOGGED IN
                    if(!$loggedIn){ 
                ?>
                <form class="navbar-form navbar-right" name="login" method="POST" action="../processes/login.php">
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
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbar-brand" data-toggle="dropdown"><?=$USER?> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <?php
                            if($access == 'admin'){
                            ?>
                            <li><a href="../adminTools.php" style="color:#333!important;"><span class="glyphicon glyphicon-cog"></span> Admin Toolbox</a></li>
                            <?php
                            }
                            ?>
                            <li class="blk"><a href="#usersettings" style="color:#333!important;"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                            <li class="divider"></li>
                            <li class="blk"><a href="../processes/logout.prc.php" style="color:#333!important;"><span class="glyphicon glyphicon-off"></span> Log-Out</a></li>
                        </ul>
                    </li>
                </ul>
                <?php
                    }
                ?>
            </div>
        </div>
    </nav>
    <!-- End Navigation -->

    <div class="container main-container">
        <div class="row">
<?php	
	//import the database connection script
	require("../../../dev302_private/db.connect.php");
	
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
	
	$ratingQuery = "
		SELECT rat.stars, (
			SELECT user.uname
			FROM user
			WHERE rat.user_id = user.id
		) AS uname
		FROM rating AS rat
        WHERE rat.product_id = '$id'
        GROUP BY stars;
	";
	
	$priceQuery = "
		SELECT price.price
		FROM price
		WHERE price.product_id = '$id' AND price.date < '$date'
		ORDER BY price.date DESC
		LIMIT 1;
	";
	$pricesth = $pdo->query($priceQuery);
	$price = $pricesth->fetch();
	
?>

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
                        <p class="small"><?= $product['description'] ?></p>
                        <a href="#" class="p-toggle">Show More</a>
                        <h2>$<?= $price['price'] ?></h2>
                        <!-- Display the add to cart form -->
                        <form name="cart-add" method="post" action="cart.php">
                            <label for="qty" title="Qty">Qty: </label>
                            <select name="qty" required title="Qty">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                            <br />
                            <!-- Create hidden fields containing product info -->
                            <button type="submit" class="btn btn-lg btn-success">Add to Cart</button>
                        </form>
                        <div id="reviews">
                            <h1>Ratings</h1>
<?php 
function echoRating () {
	global $rating;
	// Display relevant number of stars
	switch ($rating['stars']) {
		case 1:
			echo("<span class=\"glyphicon glyphicon-star\"></span>");
			break;
		case 2:
			echo("<span class=\"glyphicon glyphicon-star\"></span>");
			echo("<span class=\"glyphicon glyphicon-star\"></span>");
			break;
		case 3:
			echo("<span class=\"glyphicon glyphicon-star\"></span>");
			echo("<span class=\"glyphicon glyphicon-star\"></span>");
			echo("<span class=\"glyphicon glyphicon-star\"></span>");
			break;
		case 4:
			echo("<span class=\"glyphicon glyphicon-star\"></span>");
			echo("<span class=\"glyphicon glyphicon-star\"></span>");
			echo("<span class=\"glyphicon glyphicon-star\"></span>");
			echo("<span class=\"glyphicon glyphicon-star\"></span>");
			break;
		case 5:
			echo("<span class=\"glyphicon glyphicon-star\"></span>");
			echo("<span class=\"glyphicon glyphicon-star\"></span>");
			echo("<span class=\"glyphicon glyphicon-star\"></span>");
			echo("<span class=\"glyphicon glyphicon-star\"></span>");
			echo("<span class=\"glyphicon glyphicon-star\"></span>");
			break;
	}
}
$ratingsth = $pdo->query($ratingQuery);
while($rating = $ratingsth->fetch(PDO::FETCH_ASSOC)) {
	$ratings[] = $rating['stars'];
?>
    <div class="review">
		<h3><?php echoRating(); ?></h3>
		<p><i>Rated by: <?= $rating['uname'] ?></i></p>
	</div>
<?php
}

$average = array_sum($ratings) / count($ratings);
print_r($average);

if (isset($loggedIn)) {
?>
                            <form name="review-post" method="post" action="processes/rating.php">
                                <label for="rating" title="Rating">Rate this product: </label>
                                <select name="rating" required title="rating">
                                    <option value="5">5 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="2">2 Stars</option>
                                    <option value="1">1 Star</option>
                                </select>
                                <br/>
                                <button type="submit" class="btn btn-lg btn-success">Post Rating</button>
                            </form>
<?php
}
?>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </div>
     </div>
	</div>
    
<!-- Footer -->
	<footer>
    	<div class="container">
        	<div class="col-lg-3 col-md-3 col-sm-6">
        		<div class="column">
        			<h4>Information</h4>
        			<ul>
        				<li><a href="../about.html">About Us</a></li>
        				<li><a href="../typography.html">Policy Privacy</a></li>
        				<li><a href="../typography.html">Terms and Conditions</a></li>
        				<li><a href="../typography.html">Shipping Methods</a></li>
        			</ul>
        		</div>
        	</div>
        	<div class="col-lg-3 col-md-3 col-sm-6">
        		<div class="column">
        			<h4>Categories</h4>
        			<ul>
        				<li><a href="catalogue.html">New Releases</a></li>
        				<li><a href="catalogue.html">TV Series</a></li>
        				<li><a href="catalogue.html">Games</a></li>
        				<li><a href="catalogue.html">DVDs</a></li>
        			</ul>
        		</div>
        	</div>
        	<div class="col-lg-3 col-md-3 col-sm-6">
        		<div class="column">
        			<h4>Customer Service</h4>
        			<ul>
        				<li><a href="../contact.html">Contact Us</a></li>
                      <li><a href="#">Telephone: 07 3892 1111</a></li>
        				<li><a href="#">Skype: the_fighting_mongooses</a></li>
        				<li><a href="#">Email: fightingmongooses@gmail.com</a></li>
        			</ul>
        		</div>
        	</div>
        	<div class="col-lg-3 col-md-3 col-sm-6">
        		<div class="column">
        			<h4>Follow Us</h4>
        			<ul class="social">
        				<li><a href="#">Google Plus</a></li>
        				<li><a href="#">Facebook</a></li>
        				<li><a href="#">Twitter</a></li>
        				<li><a href="#">RSS Feed</a></li>
        			</ul>
        		</div>
        	</div>
        </div>
        <div class="navbar-inverse text-center copyright">
        	Copyright &copy; The Fighting Mongooses. All right reserved.
        </div>
    </footer>

    <a href="#top" class="back-top text-center" onclick="$('body,html').animate({scrollTop:0},500); return false">
    	<i class="fa fa-angle-double-up"></i>
    </a>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.bxslider.min.js"></script>
    <script src="../js/jquery.blImageCenter.js"></script>
    <script src="../js/mimity.js"></script>
</body>
</html>
