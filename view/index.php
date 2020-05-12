<?php require '../model/interface.php';
	$categories = getCategoriesWithProds($conn);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="..\controller\jquery.js"></script>
	<script src="..\controller\effects.js"></script>
	<script src="..\controller\angular-1.3.14.js"></script>
	<script src="..\controller\angular_controllers.js"></script>
	<title>Homepage</title>

    <script type="text/javascript">
    	var categories = JSON.parse('<?php echo $categories ?>');
    	console.log(categories);


    	angular.module('Homepage', [])
    	.controller('navbar_controller', ['$scope', '$http', function ($scope, $http) {
    		$scope.categories = categories;
        }])
        .controller('main_body_controller', ['$scope', '$http', function ($scope, $http) {
        	$scope.categories = categories;
        }]);

        var username = '<?php echo $username ?>';
        console.log(username);
        $(document).ready(function (){
        	$('#user_action_1').text(username);
        });

    </script>

  </head>
  <body ng-app="Homepage">

	<?php include("header.php") ?>

	<div class="container my-4">
		<div class="carousel slide" data-ride="carousel" style="background-color: grey; min-height: 500px;">
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
					<a href="category.php?crd={{category.categoryID}}"><button type="button-lg" class="btn btn-outline-primary">Show More</button>
				</div>
				<div class="row">
					<div class="col-lg-3" ng-repeat="product in category.products">
					<a href="#" class="text-decoration-none">
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
		</div>

	</div>

	<div  id="promotion" style="position:fixed;bottom:20px;left:90%;" >
        <a href=checkout.html><img height=80% width=80% src="images/cart.png"></a>
	</div>
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>