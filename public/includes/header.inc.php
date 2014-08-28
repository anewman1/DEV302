<?php

    // START SESSION and set VARIABLES
    session_start();
    $loggedIn = (isset($_SESSION['login'])!= "")? $_SESSION['login'] : null;
    $USER = (isset($_SESSION['user'])!= "")? $_SESSION['user'] : null;
    $access = (isset($_SESSION['access'])!="")? $_SESSION['access'] : null;
    
    
    // Prevents access to ADMIN TOOLS if not logged in as admin.
    $location = $_SERVER['SCRIPT_NAME'];
    $url = explode('/', $location);
    $num = count($url);
    $adminTool = $url[$num-1];
    if($access !== 'admin' && $adminTool == 'adminTools.php'){
        header("Location: index.php");
    }
    
    //Sheldons Section
    
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

    for ($i = 0; $i < $count; $i++) {
        $cartQty[] = $_SESSION['cart'][$i]['qty'];
    }

    $cartQty = array_sum($cartQty);
   
    // WHAT IS ALIAS BEEN USED FOR?

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
    <script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/jquery.bxslider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
	<header>
	    <div class="container">
	        <div class="row">

	        	<!-- Logo -->
	            <div class="col-lg-4 col-md-3 hidden-sm hidden-xs">
	            	<div class="well logo">
	            		<a href="index.html">
	            			The DVD Store <span>Online Shop</span>
	            		</a>
	            		<div>Australia's largest collection of movies online today!</div>
	            	</div>
	            </div>
	            <!-- End Logo -->

				<!-- Search Form -->
	            <div class="col-lg-5 col-md-5 hidden-sm hidden-xs">
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
	            <div class="col-lg-3 col-md-4 hidden-sm hidden-xs">
	                <div class="well">
	                    <div class="btn-group btn-group-cart">
	                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
	                            <span class="pull-left"><i class="fa fa-shopping-cart icon-cart"></i></span>
	                            <span class="pull-left">Shopping Cart: 2 item(s)</span>
	                            <span class="pull-right"><i class="fa fa-caret-down"></i></span>
	                        </button>
	                        <ul class="dropdown-menu cart-content" role="menu">
                                <li>
                                    <a href="detail.html">
                                        <b>Fullmetal Alchemist: Brotherhood Collection</b>
                                        <span>x1 $29.99</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="detail.html">
                                        <b>Game of Thrones: Season 1</b>
                                        <span>x1 $34.99</span>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="cart.html">Total: $64.98</a></li>
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
                <a class="navbar-brand visible-xs" href="index.php">The DVD Store</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li class="nav-dropdown">
                    	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							Products <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="products.php">New Releases</a></li>
							<li><a href="products.php">DVDs</a></li>
							<li><a href="products.php">Games</a></li>
                         <li><a href="products.php">TV Series</a></li>
                         <li><a href="products.php">Blu Ray</a></li>
						</ul>
                    </li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="cart.php">Cart</a></li>
                </ul>
                                <?php
                    // DISPLAYS LOG IN BAR IF NOT LOGGED IN
                    if(!$loggedIn){ 
                ?>
                <form class="navbar-form navbar-right" name="login" method="POST" action="processes/login.php">
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
                    <a href="register.php"><button type="button" class="btn btn-danger">Register</button></a>
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
                            <li><a href="adminTools.php" style="color:#333!important;"><span class="glyphicon glyphicon-cog"></span> Admin Toolbox</a></li>
                            <?php
                            }
                            ?>
                            <li class="blk"><a href="address.php" style="color:#333!important;"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                            <li class="divider"></li>
                            <li class="blk"><a href="processes/logout.prc.php" style="color:#333!important;"><span class="glyphicon glyphicon-off"></span> Log-Out</a></li>
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