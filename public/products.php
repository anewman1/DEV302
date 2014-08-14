<?php
    require 'includes/header.inc.php';
	
	//import the database connection script
	require("../private/db.connect.php");
	
	$sort = (isset($_GET['sort']) ? ($_GET['sort']) : "prod.id DESC");
	
	function currentSort($option) {
		global $sort;
		if ($option == $sort) {
			echo("selected");
		}
	}
	
	$query = "
		SELECT prod.id, prod.name, con.rating, prod.qty, img.image 
		FROM product AS prod
		LEFT JOIN image AS img
		
		ON prod.id = img.product_id
		LEFT JOIN content AS con
		ON prod.content_id = con.id
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
                <select name="sort" class="form-control" >
            	  <option value="prod.id DESC" <?php currentSort("prod.id DESC"); ?>>New Releases</option>
                  <option value="con.id" <?php currentSort("con.id"); ?>>Rating</option>
            	  <option value="prod.name" <?php currentSort("prod.name"); ?>>Name</option>
            	  <option value="prod.price" <?php currentSort("prod.price"); ?>>Price</option>
            	  <option value="rate.stars" <?php currentSort("rate.stars"); ?>>Top Rated</option>
            	</select>
			</form>
        </div>
    	<div class="products clearfix">
<?php
	while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
?>
            <a href="product.php?product=<?= $row['id'] ?>">
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
