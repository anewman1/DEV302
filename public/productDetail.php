<?php
    require 'includes/header.inc.php';
?>
<div class="container main-container">
        <div class="row">
        	<div class="col-lg-3 col-md-3 col-sm-12">

<!-- OPTIONAL BEST SELLER/HIGHEST RATING PANEL -->
	<!-- Best Seller -->
				<div class="col-lg-12 col-md-12 col-sm-12 visible-lg visible-md">
					<div class="no-padding">
	            		<span class="title">BEST SELLER</span>
	            	</div>
		                <div class="thumbnail col-lg-12 col-md-12 col-sm-6 text-center">
		                	<a href="<?=$best_seller?>" class="link-p">
		                    	<img src="<?=$product_image?>" alt="<?=$product_name?>">
		                	</a>
		                    <div class="caption prod-caption">
		                        <h4><a href="<?=$product_detail?>"><?=$product_name?>Product Name</a></h4>
		                        <p><?=$product_description?></p>
		                        <p>
		                        	<div class="btn-group">
			                        	<a href="<?=$add_product?>" class="btn btn-default">$ <?=$product_price?></a>
			                        	<a href="<?=$add_product?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Buy</a>
		                        	</div>
		                        </p>
		                    </div>
		                </div>
		                <div class="thumbnail col-lg-12 col-md-12 col-sm-6 hidden-xs text-center">
		                	<a href="<?=$best_seller?>" class="link-p">
		                    	<img src="<?=$product_image?>" alt="<?=$product_name?>">
		                	</a>
		                    <div class="caption prod-caption">
		                        <h4><a href="<?=$product_detail?>"><?=$product_name?>Product Name</a></h4>
		                        <p><?=$product_description?></p>
		                        <p>
		                        	<div class="btn-group">
			                        	<a href="<?=$add_product?>" class="btn btn-default">$ <?=$product_price?></a>
			                        	<a href="<?=$add_product?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Buy</a>
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
            		<span class="title"><?=$product_name?>Product Name</span>
            	</div>
	            <div class="col-lg-12 col-sm-12 hero-feature">
            		<div class="sp-wrap">
						<a href="<?=$product_image?>"><img src="<?=$product_image?>" alt="<?=$product_name?>"></a>
						<a href="<?=$product_image?>"><img src="<?=$product_image?>" alt="<?=$product_name?>"></a>
						<a href="<?=$product_image?>"><img src="<?=$product_image?>" alt="<?=$product_name?>"></a>
						<a href="<?=$product_image?>"><img src="<?=$product_image?>" alt="<?=$product_name?>"></a>
						<a href="<?=$product_image?>"><img src="<?=$product_image?>" alt="<?=$product_name?>"></a>
					</div>
					<h4><?=$product_name?>Product Name</h4>
					<?=$product_qty?> items in stock
					<hr/>
					<?=$product_desciption?>
					<hr/>
					<h3>$<?=$product_price?></h3>
					<div class="input-qty-detail">
						<input type="text" class="form-control input-qty text-center" value="1">
						<button class="btn btn-primary pull-left">add to cart</button>
					</div>
					<br/>
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
	                	<a href="<?=$product_detail?>" class="link-p">
	                    	<img src="<?=$product_image?>" alt="<?=$product_name?>">
	                	</a>
	                    <div class="caption prod-caption">
	                        <h4><a href="<?=$product_detail?>"><?=$product_name?>Product Name</a></h4>
	                        <p><?=$product_description?></p>
	                        <p>
	                        	<div class="btn-group">
		                        	<a href="<?=$add_product?>" class="btn btn-default">$ <?=$product_price?></a>
		                        	<a href="<?=$add_product?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Buy</a>
	                        	</div>
	                        </p>
	                    </div>
	                </div>
	            </div>
	            <div class="col-lg-4 col-sm-4 hero-feature text-center">
	                <div class="thumbnail">
	                	<a href="d<?=$product_detail?>" class="link-p">
	                    	<img src="<?=$product_image?>" alt="<?=$product_name?>">
	                	</a>
	                    <div class="caption prod-caption">
	                        <h4><a href="<?=$product_detail?>"><?=$product_name?>Product Name</a></h4>
	                        <p><?=$product_description?></p>
	                        <p>
	                        	<div class="btn-group">
	                        		<a href="<?=$add_product?>" class="btn btn-default">$ <?=$product_price?></a>
	                        		<a href="<?=$add_product?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Buy</a>
	                        	</div>
	                        </p>
	                    </div>
	                </div>
	            </div>
	            <div class="col-lg-4 col-sm-4 hero-feature text-center">
	                <div class="thumbnail">
	                	<a href="<?=$product_name?>" class="link-p">
	                    	<img src="<?=$product_image?>" alt="<?=$product_name?>">
	                	</a>
	                    <div class="caption prod-caption">
	                        <h4><a href="<?=$product_detail?>"><?=$product_name?>Product Name</a></h4>
	                        <p><?=$product_description?></p>
	                        <p>
	                        	<div class="btn-group">
	                        		<a href="<?=$add_product?>" class="btn btn-default">$ <?=$product_price?></a>
	                        		<a href="<?=$add_product?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Buy</a>
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