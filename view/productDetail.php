<?php require '../model/interface.php';
	require 'commonElements.php';
	if (!isset($_GET['prd'])) {
		header('Location: 404.php');
	}
	$relatedProds = getRelatedProducts($conn);
	$info = getInfo($conn);
?>

<!doctype html>
<html lang="en">
  	<?php echo loadHeader("ProductDetail"); ?>

  <body ng-app="PageApp">

	<?php echo loadNavbar(getCategories($conn), getUserJson($conn)); ?>
	<div class="container row mx-auto my-5" ng-controller="InfoControl">
		<div class="col-lg-8 mb-5">
			<div class="card-img-top" style="background: url('{{info.imageURL}}'); background-size:contain; background-position: center center;background-repeat:no-repeat; min-height:400px">
			</div>
		</div>
		<div class="col-lg-4">
			<h4 class="d-flex justify-content-between align-items-center mb-3">
				<span class="text-muted">Price</span>
				<span class="badge badge-secondary badge-pill">Rs {{info.price}}</span>
			</h4>
			<div class="card text-white bg-info mb-3">
				<div class="card-header"><h4>Seller</h4></div>
				<div class="card-body">
					<a class="text-decoration-none text-light" href="productsBySeller.php?srd={{info.sellerID}}"><h5 class="card-title">{{info.firstName}} {{info.lastName}}</h5></a>
				</div>
			</div>
			<div class="card border-info mb-3">
				<div class="card-header">{{info.productName}}</div>
				<div class="card-body text-info">
					<h5 class="card-title"></h5>
					<p class="card-text">{{info.productDscrptn}}</p>
				</div>
			</div>
			<div class="mb-3">
				<h3 style="width: 100%">QUANTITY :</h3>
				<div class="quantity">
					<button class="minus-btn stil" type="button" name="button">
						<i class="fas fa-minus-circle" style="font-size:1.4rem"></i>
					</button>
					<input class="font-weight-bold" style="font-size:1.4rem" type="text" name="name" value="1" id="qtty">
					<button class="plus-btn stil" type="button" name="button">
						<i class="fas fa-plus-circle" style="font-size:1.4rem"></i>
					</button>
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit" id="add_to_cart">Add to Cart <i class="fas fa-cart-plus"></i></button>
			</div>
		</div>
	</div>
<div class="container card shadow-lg mb-5" ng-controller="CardControl">
			<div class="form-inline">
				<h3 class="display-4 mb-3 mr-auto">Related Products</h3>
				<a href="category.php?crd={{info.categoryID}}"><button type="button-lg" class="btn btn-outline-primary">Show More</button></a>
			</div>
			<div class="row">

				<div class="col-md-6 col-lg-3" ng-repeat="product in products">
				<a href="productDetail.php?prd={{product.productID}}" class="text-decoration-none">
					<div class="card mb-4 prcard product-info">
					<div class="card-img-top" style="background: url('{{product.imageURL}}'); background-size:contain; background-position: center center;background-repeat:no-repeat; min-height:250px">
					</div>
						<div class="card-body">
						<h5 class="card-title text-secondary">{{product.productName}}</h5>
						<h6 class="text-success">Rs {{product.price}} <span class="text-danger" ng-if="product.stock == 0" style="font-size: 70%; float: right"> *Out of stock</span></h6>
						</div>
					</div>
				</a>
				</div>

			</div>
		</div>
	<?php echo loadCartIcon(); ?>
	<?php echo loadFooter(); ?>
    <!-- Optional JavaScript -->
    <script type="text/javascript">
    	prdInfo = JSON.parse('<?php echo $info ?>');
    	$('.minus-btn').on('click', function(e) {
    		if($('#qtty').val() > 1)
            {
                $('#qtty').val(parseInt($('#qtty').val())-1);
            }
        });

        $('.plus-btn').on('click', function(e) {
        	if(prdInfo.stock == $('#qtty').val())
        		alert('Your quantity has reached our inventory limit');
        	else
            	$('#qtty').val(parseInt($('#qtty').val())+1);
        });
    </script>

    <script>
		  App.controller('CardControl', function ($scope){
    		$scope.products = JSON.parse('<?php echo $relatedProds ?>');
    		console.log($scope.products)
    		$scope.info = prdInfo
    		console.log($scope.info)
  		});
      	App.controller('InfoControl', function ($scope){
        	$scope.info = JSON.parse('<?php echo $info ?>');
    	});
    </script>
	<script>
		$(document).ready(function(){
			$('#add_to_cart').click(function(){
				var userID = '<?php echo $username["userID"] ?>';
				if (userID===""){
					alert('You need to be logged in to access your cart');
					window.location.href = 'signin.php';
				}
				else
					addToCart( userID, parseInt($('#qtty').val()));
			});
		});
	</script>
     </body>
</html>