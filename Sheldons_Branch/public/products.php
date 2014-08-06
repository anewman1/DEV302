<?php
    require 'includes/header.inc.php';
	
	//import the database connection script
	require("../private/db.inc.php");
	
	$query = "
		SELECT prod.id, prod.name, con.rating, prod.qty, img.image 
		FROM product AS prod
		LEFT JOIN image AS img
		
		ON prod.id = img.product_id
		LEFT JOIN content AS con
		ON prod.content_id = con.id
		ORDER BY prod.id;
			";
	$sth = $pdo->query($query);
?>

    <div id="content">
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
