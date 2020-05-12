<?php require '../model/interface.php'; 
	require 'commonElements.php';
	$relatedProds = getRelatedProducts($conn);
	$info = getInfo($conn);
?>

<!doctype html>
<html lang="en">
  	<?php echo loadHeader("ProductDetail"); ?>
<<<<<<< HEAD
  
  </head>
=======
    <style type="text/css">

    	.quantity {
		  padding-top: 20px;
		  margin-right: 60px;
		}
		.quantity input {
		  border: none;
		  text-align: center;
		  width: 32px;
		  font-size: 16px;
		  color: #43484D;
		  font-weight: 300;
		}
		 .stil {
		 	background-color: white;
		 	width: 30px;
		  height: 30px;
		  border-radius: 6px;
		  border: none;
		 }

		button:focus,
		input:focus {
		  outline:0;
		}
    </style>
>>>>>>> d11782a75e41427fe82abfc835b96ea96ccde37f
  <body ng-app="PageApp">

	<?php echo loadNavbar(getCategories($conn), $username); ?>

	<div class="row" style="width:100%" ng-controller="InfoControl">
	<div class="col-md-7 order-md-1" style="padding: 5%; padding-right: 0%">
	<div id="carouselExampleIndicator" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
		  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
		  <div class="carousel-item active">
			<img src="" class="d-block w-100 h-100">
		  </div>
		  <div class="carousel-item">
			<img src="..." class="d-block w-100" alt="...">
		  </div>
		  <div class="carousel-item">
			<img src="..." class="d-block w-100" alt="...">
		  </div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		  <span class="sr-only" style="">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		  <span class="carousel-control-next-icon" aria-hidden="true"></span>
		  <span class="sr-only">Next</span>
		</a>
	  </div>

	</div>
	<div class="col-md-5 order-md-2 mb-4"  style="padding: 5%;">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Price</span>
        <span class="badge badge-secondary badge-pill">Rs {{info.price}}</span>
      </h4>
      <div class="card text-white bg-info mb-3" style="width: 100%">
  <div class="card-header">Owner of the Product</div>
  <div class="card-body">
    <h5 class="card-title">{{info.firstName}} {{info.lastName}}</h5>
  </div>
</div>
<div class="card border-info mb-3" style="width: 100%">
  <div class="card-header">{{info.productName}}</div>
  <div class="card-body text-info">
    <h5 class="card-title"></h5>
    <p class="card-text">{{info.productDscrptn}}</p>
  </div>
</div>
<div class="row" style="padding: 5%">
      <h3 style="width: 100%">QUANTITY :   </h3>
	<div class="quantity">
      <button class="minus-btn stil" type="button" name="button">
        <img src="images/minus.png" style="max-height: 90%; padding: 3%" alt="" />
      </button>
      <input type="text" name="name" value="1" id="qtty">
      <button class="plus-btn stil" type="button" name="button">
        <img src="images/plus.png" style="max-height: 90%; padding: 3%"alt="" />
      </button>
    </div>
	<button class="btn btn-lg btn-primary btn-block" type="submit" id="add_to_cart">Add to Cart</button>
</div>
    </div>
</div>
<div class="container card shadow-lg">
			<div class="form-inline">
				<h3 class="display-4 mb-3 mr-auto">Related Products</h3>
				<button type="button-lg" class="btn btn-outline-primary">Show More</button>
			</div>
			<div class="row" ng-controller="CardControl">

				<div class="col-lg-3" ng-repeat="product in products">
				<a href="productDetail.php?prd={{product.productID}}" class="text-decoration-none">
					<div class="card mb-4 shadow-sm product-info">
						<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
						<div class="card-body">
						<h5 class="card-title text-secondary">{{product.productName}}</h5>
						<p class="card-text text-body">{{product.productDscrptn}}</p>
						<h6 class="card-title text-success">{{product.price}}</h6>
						</div>
					</div>
				</a>
				</div>

			</div>
		</div>
	<div  id="cartIcon" style="position:fixed;bottom:20px;left:90%;" >
        <a href=checkout.php><img height=80% width=80% src="images/cart.png"></a>
	</div>
    <!-- Optional JavaScript -->
    <script type="text/javascript">
    	$('.minus-btn').on('click', function(e) {
    		if($('#qtty').val() != 1)
            {
                $('#qtty').val(parseInt($('#qtty').val())-1);
            }
        });

        $('.plus-btn').on('click', function(e) {
            $('#qtty').val(parseInt($('#qtty').val())+1);
        });


    </script>

    <script>
		App.controller('CardControl', function ($scope){
    		$scope.products = JSON.parse('<?php echo $relatedProds ?>');
    		console.log($scope.products)
  		});
      	App.controller('InfoControl', function ($scope){
        	$scope.info = JSON.parse('<?php echo $info ?>');
    	});
    </script>
    <script>
    	$(document).ready(function(){
    		$('#add_to_cart').click(function(){
    			addToCart( '<?php echo $username["userID"] ?>', parseInt($('#qtty').val()));
    		});
    	});
    </script>

    

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     </body>
</html>