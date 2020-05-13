<?php require '../model/interface.php';
	require 'commonElements.php';
	$categories = getCategoriesWithProds($conn);
?>

<!doctype html>
<html lang="en">
<?php echo loadHeader("Home Page"); ?>

  <body ng-app="PageApp">

	<?php echo loadNavbar(getCategories($conn), $username); ?>

	<div class="container my-4">
		<div class="carousel slide carouselIndex " data-ride="carousel">
			<ol class="carousel-indicators">
			  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner">
			  <div class="carousel-item active">
				<img src="" class="d-block w-100" alt="...">
			  </div>
			  <div class="carousel-item">
				<img src="" class="d-block w-100" alt="...">
			  </div>
			  <div class="carousel-item">
				<img src="" class="d-block w-100" alt="...">
			  </div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			  <span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			  <span class="carousel-control-next-icon" aria-hidden="true"></span>
			  <span class="sr-only">Next</span>
			</a>
		</div>
	</div>


	<div ng-controller="main_body_controller" class="container-fluid mx-0 px-0" >
		<div class="album py-5 bg-light" ng-repeat="category in categories">
			<div class="container card shadow-lg">
				<div class="form-inline">
					<h3 class="display-4 mb-3 mr-auto">{{category.categoryName}}</h3>
					<a href="category.php?crd={{category.categoryID}}"><button type="button-lg" class="btn btn-outline-primary">Show More</button></a>
				</div>
				<div class="row">
					<div class="col-lg-3" ng-repeat="product in category.products">
					<a href="productDetail.php?prd={{product.productID}}" class="text-decoration-none">
						<div class="card mb-4 product-info prcard">
							<div class="card-img-top" style="background: url('{{product.imageURL}}'); background-size:contain; background-position: center center;background-repeat:no-repeat; min-height:250px">
							</div>
							<div class="card-body">
							<h5 class="card-title text-secondary">{{product.productName}}</h5>
							<h6 class="card-title text-success">Rs {{product.price}}</h6>
							</div>
						</div>
					</a>
					</div>

				</div>
			</div>
		</div>

	</div>
	<div  id="cartIcon" style="position:fixed;bottom:20px;left:90%;" >
        <a href=checkout.php><img height=80% width=80% src="images/cart.png"></a>
</div>

	<script type="text/javascript">
    	var categories = JSON.parse('<?php echo $categories ?>');
        App.controller('main_body_controller', ['$scope', '$http', function ($scope, $http) {
			console.log(categories)
        	$scope.categories = categories;
        }]);
    </script>
  </body>
</html>