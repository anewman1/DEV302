<?php
    require 'includes/header.inc.php';
	
	//import the database connection script
	require("../../../dev302_private/db.inc.php");
	
	$sortType = (isset($_GET['sortBy']) ? ($_GET['sortBy']) : "release-date");
	$sort = "prod.id";
	
	date_default_timezone_set('Australia/Brisbane');
	$date = date("Y-m-d H:i:s");
	
	$query = "
		SELECT prod.id, prod.name, prod.qty, img.image, c.rating, (
			SELECT price.price 
			FROM price 
			WHERE price.date < '$date' AND prod.id = price.product_id 
			ORDER BY price.date DESC 
			LIMIT 1
		) AS price
		FROM product AS prod
		LEFT JOIN image AS img
		ON prod.id = img.product_id
		LEFT JOIN content
		ON prod.content_id = content.id
		GROUP BY prod.id
		ORDER BY $sort;
	";
	$sth = $pdo->query($query);
?>

    <div id="content" class="clearfix">
    	<div id="sort" class="clearfix">
        	<p>Sort by: </p>
            <form name="sort" method="get" action="products.php" class="input-group">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-refresh"></span>
                    </button>
                </span>
                <select name="sortBy" class="form-control">
            	  <option value="release-date" <?php currentSort("release-date"); ?>>New Releases</option>
            	  <option value="name" <?php currentSort("name"); ?>>Name</option>
            	  <option value="price" <?php currentSort("price"); ?>>Price</option>
            	  <option value="rating" <?php currentSort("rating"); ?>>Content Rating</option>
            	</select>
			</form>
        </div>
    	<div class="products clearfix">
<?php
	while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
		$alias = preg_replace('/\s+/', '-', $row['name']);
		$alias = preg_replace('/[^A-Za-z0-9:\-]/', '', $alias);
?>
            <a href="products/<?= $row['id'] . "-" . $alias ?>">
                <div class="product">
                    <h3><?= $row['name'] ?></h3>
                    <div class="img-holder">
                    	<img src="<?= $row['image'] ?>"/>
                    </div>
                    <p>
                    	<span class="price">$<?= $row['price'] ?></span><br />
                        Rated: <?= $row['rating'] ?>
                    </p>
                    <button type="button" class="btn btn-lg btn-success">Product Page</button>
                </div>
            </a>
<?php
	} 
?>
    	</div>
    </div>
    
<?php
	require 'includes/footer.inc.php';
?>
