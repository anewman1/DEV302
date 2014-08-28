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
		/*case "price":
			$sort = "price.price";
			break;
		case "rating":
			$sort = "rate.stars";
			break;*/
	}
	
	$query = "
		SELECT prod.id, prod.name, con.rating, prod.qty, img.image 
		FROM product AS prod
		LEFT JOIN image AS img
		
		ON prod.id = img.product_id
		LEFT JOIN classification AS con
		ON prod.class_id = con.id
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
            	  <option value="rating" <?php currentSort("rating"); ?>>Top Rated</option>
            	</select>
			</form>
        </div>
    	<div class="products clearfix">
<?php
	while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
		$alias = preg_replace('/\s+/', '-', $row['name']);
		$alias = preg_replace('/[^A-Za-z0-9:\-]/', '', $alias);
?>
            <a href="products/<?= $alias ?>">
                <div class="product">
                    <h3><?= $row['name'] ?></h3>
                    <div class="img-holder">
                    	<img src="<?= $row['image'] ?>"/>
                    </div>
                    <p>Rated: <?= $row['rating'] ?></p>
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
