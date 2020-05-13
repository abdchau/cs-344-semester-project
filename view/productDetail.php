<?php require '../model/interface.php';
	require 'commonElements.php';
	$relatedProds = getRelatedProducts($conn);
	$info = getInfo($conn);
?>

<!doctype html>
<html lang="en">
  	<?php echo loadHeader("ProductDetail"); ?>

  <body ng-app="PageApp">

	<?php echo loadNavbar(getCategories($conn), getUserJson($conn)); ?>

	<div class="row" style="width:100%" ng-controller="InfoControl">
	<div class="col-md-7 order-md-1"style="padding: 5%;">
		<img class="image-fluid" src="{{info.imageURL}}" style="max-width:100%">
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
<div class="container card shadow-lg " ng-controller="CardControl">
			<div class="form-inline">
				<h3 class="display-4 mb-3 mr-auto">Related Products</h3>
				<a href="category.php?crd={{info.categoryID}}"><button type="button-lg" class="btn btn-outline-primary">Show More</button></a>
			</div>
			<div class="row">

				<div class="col-lg-3" ng-repeat="product in products">
				<a href="productDetail.php?prd={{product.productID}}" class="text-decoration-none">
					<div class="card mb-4 prcard product-info">
					<div class="card-img-top" style="background: url('{{product.imageURL}}'); background-size:contain; background-position: center center;background-repeat:no-repeat; min-height:250px">
					</div>
						<div class="card-body">
						<h5 class="card-title text-secondary">{{product.productName}}</h5>
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
    		$scope.info = JSON.parse('<?php echo $info ?>');
    		console.log($scope.info)
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