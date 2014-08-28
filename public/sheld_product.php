<?php
require 'includes/header.inc.php';
?>

<?php
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
        while ($img = $imgsth->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <img src="<?= $img['image'] ?>" alt="<?= $product['name'] ?>" title="<?= $product['name'] ?>" />
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
                print_r($average);
            }
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

<?php
require 'includes/footer.inc.php';
?>