<?php
require 'includes/header.inc.php';
require("../private/db.connect.php");

$prodQuery = "
		SELECT prod.id, prod.name, prod.description, prod.qty
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

$product_name = $product['name'];
$product_image = "image";
$product_price = $price['price'];
$product_qty = $product['qty'];
$product_description = $product['description'];

?>

<div class="col-lg-3 col-md-3 col-sm-12">

    <!-- OPTIONAL BEST SELLER/HIGHEST RATING PANEL -->
    <!-- Best Seller -->
    <div class="col-lg-12 col-md-12 col-sm-12 visible-lg visible-md">
        <div class="no-padding">
            <span class="title">BEST SELLER</span>
        </div>
        <div class="thumbnail col-lg-12 col-md-12 col-sm-6 text-center">
            <a href="<?= $best_seller ?>" class="link-p">
                <img src="<?= $product_image ?>" alt="<?= $product_name ?>">
            </a>
            <div class="caption prod-caption">
                <h4><a href="<?= $product_detail ?>"><?= $product_name ?>Product Name</a></h4>
                <p><?= $product_description ?></p>
                <p>
                <div class="btn-group">
                    <a href="<?= $add_product ?>" class="btn btn-default">$ <?= $product_price ?></a>
                    <a href="<?= $add_product ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Buy</a>
                </div>
                </p>
            </div>
        </div>
        <div class="thumbnail col-lg-12 col-md-12 col-sm-6 hidden-xs text-center">
            <a href="<?= $best_seller ?>" class="link-p">
                <img src="<?= $product_image ?>" alt="<?= $product_name ?>">
            </a>
            <div class="caption prod-caption">
                <h4><a href="<?= $product_detail ?>"><?= $product_name ?>Product Name</a></h4>
                <p><?= $product_description ?></p>
                <p>
                <div class="btn-group">
                    <a href="<?= $add_product ?>" class="btn btn-default">$ <?= $product_price ?></a>
                    <a href="<?= $add_product ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Buy</a>
                </div>
                </p>
            </div>
        </div>
    </div>
    <!-- End Best Seller -->
    <!-- END OPTIONAL BEST SELLER/HIGHEST RATING PANEL -->
</div>





<div class="clearfix visible-sm"></div>





<!-- Product Detail -->
<div class="col-lg-9 col-md-9 col-sm-12">
    <div class="col-lg-12 col-sm-12">
        <span class="title"><?= $product_name ?></span>
    </div>
    <div class="col-lg-12 col-sm-12 hero-feature">
        <div class="sp-wrap">
            <?php
                $imgsth = $pdo->query($imgQuery);
                while ($img = $imgsth->fetch(PDO::FETCH_ASSOC)) 
                {
            ?>
                    <img src="<?= $img['image'] ?>" alt="<?= $product['name'] ?>" title="<?= $product['name'] ?>" />
            <?php
                }
            ?>
        </div>
        <h4><?= $product_name ?></h4>
        <?= $product_qty ?> items in stock
        <hr/>
        <?= $product_description ?>
        <hr/>
        <h3>$<?= $product_price ?></h3>
        <div class="input-qty-detail">
            <input type="text" class="form-control input-qty text-center" value="1" style="width:90px !important;float:left!important;">
            <button class="btn btn-primary pull-left" style="float:left!important;">add to cart</button>
        </div>
        <br/>
        <hr/>
        <div id="reviews">
            <h1>Ratings</h1>
            <?php

            function echoRating() {
                global $rating;
                // Display relevant number of stars

                /* Switch simplfied by Aaron. */
                switch ($rating['stars']) {
                    case 5:
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                    case 4:
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                    case 3:
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                    case 2:
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                    case 1:
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        break;
                }
            }

            $ratingsth = $pdo->query($ratingQuery);
            $ratings = [];
            while ($rating = $ratingsth->fetch(PDO::FETCH_ASSOC)) {
                $ratings[] = $rating['stars'];
                ?>
                <div class="review">
                    <h3><?php echoRating(); ?></h3>
                    <p><i>Rated by: <?= $rating['uname'] ?></i></p>
                </div>
                <?php
            }
            if ($ratings != null) {
                $average = array_sum($ratings) / count($ratings);
                
                switch($average){
                    case($average<1): 
                        echo("<span class=\"glyphicon glyphicon-star-empty\"></span>");
                        break;
                    
                    case($average===1): 
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        break;
                    
                    case($average>1 && $average <2): 
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star-empty\"></span>");
                        break;
                    
                    case($average===2): 
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        break;
                    
                    case($average>2 && $average<3): 
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star-empty\"></span>");
                        break;
                    case($average===3):  
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        break;
                    case($average>1 && $average<4):   
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star-empty\"></span>");
                        break;
                    case($average===4):    
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        break;
                    case($average>1 && $average<5):   
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star-empty\"></span>");
                        break;
                    case($average===5):   
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        echo("<span class=\"glyphicon glyphicon-star\"></span>");
                        break;
                }
                echo("Average rating of $average Stars");
            }
            if ($loggedIn) {
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
            }else{
                echo("<br><br><p>Please log in to rate or review this item.</p>");
            }
            ?>
        </div>
        <hr/>
        <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
            <a class="addthis_button_preferred_1"></a>
            <a class="addthis_button_preferred_2"></a>
            <a class="addthis_button_preferred_3"></a>
            <a class="addthis_button_preferred_4"></a>
            <a class="addthis_button_compact"></a>
        </div>

        <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-4f0c254f1302adf8"></script>
    </div>
    <div class="clearfix"></div>
    <!-- End Product Detail -->

    
    
    
    
    
    
    
    <!-- OPTIONAL RELATED PRODUCTS PANEL -->
    <div class="col-lg-12 col-sm-12">
        <span class="title">RELATED PRODUCTS</span>
    </div>
    <div class="col-lg-4 col-sm-4 hero-feature text-center">
        <div class="thumbnail">
            <a href="<?= $product_detail ?>" class="link-p">
                <img src="<?= $product_image ?>" alt="<?= $product_name ?>">
            </a>
            <div class="caption prod-caption">
                <h4><a href="<?= $product_detail ?>"><?= $product_name ?>Product Name</a></h4>
                <p><?= $product_description ?></p>
                <p>
                <div class="btn-group">
                    <a href="<?= $add_product ?>" class="btn btn-default">$ <?= $product_price ?></a>
                    <a href="<?= $add_product ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Buy</a>
                </div>
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 hero-feature text-center">
        <div class="thumbnail">
            <a href="d<?= $product_detail ?>" class="link-p">
                <img src="<?= $product_image ?>" alt="<?= $product_name ?>">
            </a>
            <div class="caption prod-caption">
                <h4><a href="<?= $product_detail ?>"><?= $product_name ?>Product Name</a></h4>
                <p><?= $product_description ?></p>
                <p>
                <div class="btn-group">
                    <a href="<?= $add_product ?>" class="btn btn-default">$ <?= $product_price ?></a>
                    <a href="<?= $add_product ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Buy</a>
                </div>
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 hero-feature text-center">
        <div class="thumbnail">
            <a href="<?= $product_name ?>" class="link-p">
                <img src="<?= $product_image ?>" alt="<?= $product_name ?>">
            </a>
            <div class="caption prod-caption">
                <h4><a href="<?= $product_detail ?>"><?= $product_name ?>Product Name</a></h4>
                <p><?= $product_description ?></p>
                <p>
                <div class="btn-group">
                    <a href="<?= $add_product ?>" class="btn btn-default">$ <?= $product_price ?></a>
                    <a href="<?= $add_product ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Buy</a>
                </div>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- END RELATED PRODUCTS PANEL -->





<?php
require 'includes/footer.inc.php';
?>