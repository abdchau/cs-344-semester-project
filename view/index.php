<?php require '../model/interface.php';
	require 'commonElements.php';
	$categories = getCategoriesWithProds($conn);
	$featured = getFeaturedProducts($conn);
?>

<!doctype html>
<html lang="en">
<?php echo loadHeader("Home Page"); ?>

  <body ng-app="PageApp">
	<?php echo loadNavbar(getCategories($conn), getUserJson($conn)); ?>

	<div id="carouselIndicators" ng-controller="carousel-ctrl" class="container my-4">
		<div class="carousel slide carouselIndex " data-ride="carousel">
			<ol class="carousel-indicators">
			  <li data-target="#carouselIndicators" data-slide-to="{{$index}}" class="active" ng-repeat="ft in featured" ng-if="ft == featured[0]"></li>
			  <li data-target="#carouselIndicators" data-slide-to="{{$index}}" ng-repeat="ft in featured" ng-if="ft != featured[0]"></li>
			</ol>
			<div class="carousel-inner">
				<div data-interval="4000" class="carousel-item active" ng-repeat="ft in featured" ng-if="ft == featured[0]">
					<div>
						<div class="card-img-top" style="background: url('{{ft.imageURL}}'); background-size:contain; background-position: center center;background-repeat:no-repeat; min-height:500px">
							<div class="badge badge-pill badge-primary float-right m-3">Featured</div>
							<div class="carousel-caption d-md-block">
									<h5 class="mx-4">
									<a href="productDetail.php?prd={{ft.productID}}" class="text-decoration-none text-white">
									{{ft.productName}}
									</a>
								</h5>
							</div>
						</div>
					</div>
				</div>
				<div data-interval="4000" class="carousel-item" ng-repeat="ft in featured" ng-if="ft != featured[0]">
					<div>
						<div class="card-img-top" style="background: url('{{ft.imageURL}}'); background-size:contain; background-position: center center;background-repeat:no-repeat; min-height:500px">
							<div class="badge badge-pill badge-primary float-right m-3">Featured</div>
							<div class="carousel-caption d-md-block">
								<h5 class="mx-4">
									<a href="productDetail.php?prd={{ft.productID}}" class="text-decoration-none text-white">
									{{ft.productName}}
									</a>
								</h5>

							</div>
						</div>
					</div>
				</div>
			</div>
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
					<div class="col-md-6 col-lg-3" ng-repeat="product in category.products">
					<a href="productDetail.php?prd={{product.productID}}" class="text-decoration-none">
						<div class="card mb-4 product-info prcard">
							<div class="card-img-top" style="background: url('{{product.imageURL}}'); background-size:contain; background-position: center center;background-repeat:no-repeat; min-height:250px">
							</div>
							<div class="card-body">
							<h5 class="card-title text-secondary">{{product.productName}}</h5>
							<h6 class="text-success">Rs {{product.price}} <span class="text-warning" ng-if="product.stock > 0 && product.stock <11" style="font-size: 70%; float: right"> *Limited stock</span><span class="text-danger" ng-if="product.stock == 0" style="font-size: 70%; float: right"> *Out of stock</span></h6>
							</div>
						</div>
					</a>
					</div>

				</div>
			</div>
		</div>

	</div>
	<?php echo loadCartIcon(); ?>
	<?php echo loadFooter(); ?>


	<script type="text/javascript">
        App.controller('main_body_controller', ['$scope', '$http', function ($scope, $http) {
        	$scope.categories = JSON.parse('<?php echo $categories ?>');
        }]);
		App.controller('carousel-ctrl', ['$scope', '$http', function ($scope, $http) {
        	$scope.featured = JSON.parse('<?php echo $featured ?>');
        }]);
    </script>
  </body>
</html>