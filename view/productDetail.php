<?php require '../model/products.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Product</title>

    <script src="../controller/jquery.js"></script>
    <script src="../controller/products.js"></script>
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
  </head>
  <body ng-app="productApp">

	<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-faded shadow" style="background-color: #e3f2fd;">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<a class="navbar-brand mx-auto" href="index.html">
			<img src="images\logo.jpg" width="30" height="30" alt=""> Shopoholic
		</a>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		  <ul class="navbar-nav mr-auto">
			<li class="nav-item mx-3">
			  <a class="nav-link" id="home" href="index.php">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item dropdown mx-3">
			    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Categories
			    </a>
			  <div class="dropdown-menu" id="categories_dropdown" aria-labelledby="navbarDropdownMenuLink">
				<a class="dropdown-item" href="category.html">category 1</a>
                <a class="dropdown-item" href="category.html">category 2</a>
                <a class="dropdown-item" href="category.html">category 3</a>
                <a class="dropdown-item" href="category.html">category 4</a>
                <a class="dropdown-item" href="category.html">category 5</a>
                <a class="dropdown-item" href="category.html">category 6</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#">More</a>
			  </div>
            <li class="nav-item mx-3" id="contact_us">
                <a class="nav-link" href="#">Contact Us</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto" id="user_actions">
            <li class="nav-item mx-3">
                <a class="nav-link" id="user_action_1" href="signup.html">Sign Up</a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link" id="user_action_2" href="signin.html">Sign In</a>
            </li>
          </ul>

		  <form class="form-inline my-2 my-lg-0" id="search_form">
			<input class="form-control mr-sm-2" id="search_bar" type="search" placeholder="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" id="search_button" type="submit">Search</button>
		  </form>
		</div>
	</nav>
	<div class="row" style="width:100%" ng-controller="InfoControl">
	<div class="col-md-7 order-md-1" style="padding: 5%; padding-right: 0%">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="border: 5px solid;border-color: #e3f2fd; min-height: 500px; background-image: linear-gradient(to right, darkgray , lightgray, lightgray, lightgray,darkgray);box-shadow: 5px 10px 8px 10px #e3f2fd;">
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
	<div class="quantity" style="padding-bottom: 2%; padding-top: 1%; padding-left: 6%; width: 100%">
      <button class="minus-btn stil" type="button" name="button">
        <img src="images/minus.png" style="max-height: 90%; padding: 3%" alt="" />
      </button>
      <input type="text" name="name" value="1" id="qtty">
      <button class="plus-btn stil" type="button" name="button">
        <img src="images/plus.png" style="max-height: 90%; padding: 3%"alt="" />
      </button>
    </div>
	<button class="btn btn-lg btn-primary btn-block" type="submit" id="signin">Add to Cart</button>
</div>
    </div>
</div>
<div class="container card shadow-lg">
			<div class="form-inline">
				<h3 class="display-4 mb-3 mr-auto">Related Producs</h3>
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


	

	<div  id="promotion" style="position:fixed;bottom:20px;left:90%;" >
        <a href="checkout.html"><img height=80% width=80% src="images/cart.png"></a>
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

    <script src="../controller/angular-1.3.14.js"></script>
        <script>
        	var nameApp = angular.module('productApp', []);
			nameApp.controller('CardControl', function ($scope){
        		$scope.products = JSON.parse('<?php echo $rel ?>');
        		console.log($scope.products)
      		});
	      	nameApp.controller('InfoControl', function ($scope){
	        	$scope.info = JSON.parse('<?php echo $mas ?>');
        	});
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>