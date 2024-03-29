<?php
    require 'includes/header.inc.php';
?>

<!-- Best Seller -->
			<!--	<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="no-padding">
	            		<span class="title">BEST SELLER</span>
	            	</div>
		                <div class="thumbnail col-lg-12 col-md-12 col-sm-6 text-center">
		                	<a href="detail.html" class="link-p">
		                    	<img src="images/product-8.jpg" alt="">
		                	</a>
		                    <div class="caption prod-caption">
		                        <h4><a href="detail.html">Penn State College T-Shirt</a></h4>
		                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut, minima!</p>
		                        <p>
		                        	<div class="btn-group">
			                        	<a href="#" class="btn btn-default">$ 528.96</a>
			                        	<a href="#" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Buy</a>
		                        	</div>
		                        </p>
		                    </div>
		                </div>
		                <div class="thumbnail col-lg-12 col-md-12 col-sm-6 visible-sm text-center">
		                	<a href="detail.html" class="link-p">
		                    	<img src="images/product-9.jpg" alt="">
		                	</a>
		                    <div class="caption prod-caption">
		                        <h4><a href="detail.html">Ohio State College T-Shirt</a></h4>
		                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut, minima!</p>
		                        <p>
		                        	<div class="btn-group">
			                        	<a href="#" class="btn btn-default">$ 924.25</a>
			                        	<a href="#" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Buy</a>
		                        	</div>
		                        </p>
		                    </div>
		                </div>
				</div>
				<!-- End Best Seller -->

        	</div>

        	<div class="clearfix visible-sm"></div>

			<!-- Cart -->
        	<div class="col-lg-9 col-md-9 col-sm-12">
        		<div class="col-lg-12 col-sm-12">
            		<span class="title">SHOPPING CART</span>
            	</div>
	            <div class="col-lg-12 col-sm-12 hero-feature">
					<table class="table table-bordered tbl-cart">
						<thead>
                            <tr>
                                <td class="hidden-xs">Image</td>
                                <td>Product Name</td>
                                <!-- <td>Size</td>
                                <td>Color</td> -->
                                <td class="td-qty">Quantity</td>
                                <td>Unit Price</td>
                                <td>Sub Total</td>
                                <td>Remove</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="hidden-xs">
                                    <a href="detail.html">
                                        <img src="images/game-of-thrones_season1.jpg" alt="Age Of Wisdom Tan Graphic Tee" title="" width="47" height="47" />
                                    </a>
                                </td>
                                <td><a href="#">Game of Thrones: Season 1</a>
                                </td>
                                <!-- <td>
                                    <select name="">
                                        <option value="" selected="selected">S</option>
                                        <option value="">M</option>
                                    </select>
                                </td>
                                <td>-</td> -->
                                <td>
                                    <input type="text" name="" value="1" class="input-qty form-control text-center" />
                                </td>
                                <td class="price">$ 34.99</td>
                                <td>$ 34.99</td>
                                <td class="text-center">
                                    <a href="#" class="remove_cart" rel="2">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="hidden-xs">
                                    <a href="detail.html">
                                        <img src="images/Fullmetal_Alchemist.jpg" alt="Adidas Men Red Printed T-shirt" title="" width="47" height="47" />
                                    </a>
                                </td>
                                <td><a href="#">Fullmetal Alchemist: Brotherhood Collection</a>
                                </td>
                                <!--<td>
                                    <select name="">
                                        <option value="">S</option>
                                        <option value="" selected="selected">M</option>
                                    </select>
                                </td>
                                <td>
                                	<select name="">
                                        <option value="" selected="selected">Red</option>
                                        <option value="">Blue</option>
                                    </select>
                                </td> -->
                                <td>
                                    <input type="text" name="" value="2" class="input-qty form-control text-center" />
                                </td>
                                <td class="price">$ 29.99</td>
                                <td>$ 59.98</td>
                                <td class="text-center">
                                    <a href="#" class="remove_cart" rel="1">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" align="right">Total</td>
                                <td class="total" colspan="2"><b>$ 64.98</b>
                                </td>
                            </tr>
                        </tbody>
					</table>
					<div class="btn-group btns-cart">
						<button type="button" class="btn btn-primary" onclick="window.location='catalogue.html'"><i class="fa fa-arrow-circle-left"></i> Continue Shopping</button>
						<button type="button" class="btn btn-primary">Update Cart</button>
						<button type="button" class="btn btn-primary" onclick="window.location='checkout.php'">Checkout <i class="fa fa-arrow-circle-right"></i></button>
					</div>

	            </div>
        	</div>
        	<!-- End Cart -->
            
<?php
    require 'includes/footer.inc.php';
?>