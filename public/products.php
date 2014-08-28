<?php
    require 'includes/header.inc.php';
	
	//import the database connection script
	require("../private/db.connect.php");
	
	$sortType = (isset($_GET['sortBy']) ? ($_GET['sortBy']) : "release-date");
	$sort = "prod.id";
	
	function currentSort($option) {
		global $sortType;
		if ($option == $sortType) {
			echo("selected");
		}
	}
	
	switch ($sortType) {
		case "release-date":
			$sort = "prod.id DESC";
			break;
		case "name":
			$sort = "prod.name";
			break;
		case "price":
			$sort = "price";
			break;
		case "rating":
			$sort = "class.id";
			break;
	}
	
	$query = "
		SELECT prod.id, prod.name, prod.description, img.image, class.rating, (
			SELECT price.price 
			FROM price 
			WHERE price.date < '$date' AND prod.id = price.product_id 
			ORDER BY price.date DESC 
			LIMIT 1
		) AS price
		FROM product AS prod
		LEFT JOIN image AS img
		ON prod.id = img.product_id
		LEFT JOIN classification AS class
		ON prod.class_id = class.id
		GROUP BY prod.id
		ORDER BY $sort;
	";
	$sth = $pdo->query($query);
?>

    <div id="content" class="clearfix">
            <div id="sort" class="clearfix col-md-12">
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
            <div class="col-lg-4 col-sm-4 hero-feature text-center">
	                <div class="thumbnail">
	                	<a style="overflow: hidden; position: relative;" href="products/<?= $row['id'] . "-" . $alias ?>" class="link-p">
	                    	<img style="position: absolute; width: auto; height: auto; max-width: none; max-height: none; left: 0px; top: 83px;" src="<?= $row['image'] ?>" alt="">
	                	</a>
	                    <div class="caption prod-caption">
	                        <h4><a href="products/<?= $row['id'] . "-" . $alias ?>"><?= $row['name'] ?></a></h4>
	                        <p>Rated: <?= $row['rating'] ?></p>
	                        <p>
	                        	</p><div class="btn-group">
		                        	<a href="#" class="btn btn-default">$<?= $row['price'] ?></a>
		                        	<a href="#" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Buy</a>
	                        	</div>
	                        <p></p>
	                    </div>
	                </div>
	            </div>
            
<?php
	} 
?>
    	</div>
    </div>
    
<?php
	require 'includes/footer.inc.php';
?>
