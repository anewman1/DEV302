<?php
    // START SESSION and set VARIABLES
    session_start();
    $loggedIn = (isset($_SESSION['login'])!= "")? $_SESSION['login'] : null;
    $USER = (isset($_SESSION['user'])!= "")? $_SESSION['user'] : null;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="DEV - The Fighting Mongooses">
    
    <title>DEV_Store</title>
    
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <style>
        body{
            padding-top: 50px;
            padding-bottom: 20px;
            /*background-image: url("img/dark_mosaic.png"); //www.subtlepatterns.com*/
            background-image: url("img/crossword.png"); //www.subtlepatterns.com
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">DEV Store</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="products.php">Products</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
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
                
                <form class="navbar-form navbar-right" name="logout" method="POST" action="#">
                    <div class="form-group">
                    <a href="processes/logout.php" class="navbar-right"><button type="button" class="btn btn-warning">Log-Out</button></a>
                    </div>
                </form>
                <!-- USER APPEARS FIRST ON SCREEN AS IT IS PUSHED RIGHT AFTER THE LOGOUT BUTTON -->
                <ul class="nav navbar-nav navbar-right" >
                    <li><a class="navbar-brand navbar-right" href="#">Welcome, <?=$USER?></a></li>
                </ul>

                <?php
                    }
                ?>
                
            </div><!--/.navbar-collapse -->
        </div>
    </nav> <!-- END of NAVBAR-->
    
    <div class="container">