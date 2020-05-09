<?php require '../model/category.php';
  $categoryName = getCategoryName($conn);
  $products = getProdsByCategory($conn);
  closeConnection($conn);
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
	<title>Category</title>
  </head>
  <body ng-app="categoryApp">
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


	<div class="album py-5 bg-light" ng-controller="CategoryInfoControl">
		<div class="container card shadow-lg">
			<h3 class="display-4 mb-5 mr-auto">{{category.categoryName}}</h3>
            <div class="row">

                <div class="col-lg-3" ng-repeat="product in products">
                <a href="productDetail.php?prd={{product.productID}}" class="text-decoration-none">
                    <div class="card mb-4 shadow-sm product-info">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                        <div class="card-body">
                        <h5 class="card-title text-secondary">{{product.productName}}</h5>
                        <p class="card-text text-body">{{product.productDscrptn}}</p>
                        <h6 class="card-title text-success">Rs{{product.price}}</h6>
                        <!-- <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Add to wishlist</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Buy</button>
                            </div>
                            <small class="text-muted">In stock</small>
                        </div> -->
                        </div>
                    </div>
                </a>
                </div>

            </div>
            <nav class="mx-auto">
                <ul class="pagination">
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
        </div>
	</div>

	<div  id="promotion" style="position:fixed;bottom:20px;left:90%;" >
        <a href="checkout.html"><img height=80% width=80% src="images/cart.png"></a>
    </div>
	<!-- Optional JavaScript -->

    <script src="../controller/angular-1.3.14.js"></script>
    <script>
      var nameApp = angular.module('categoryApp', []);

      nameApp.controller('CategoryInfoControl', function ($scope){
      $scope.category = JSON.parse('<?php echo $categoryName ?>');
      $scope.products = JSON.parse('<?php echo $products ?>');  
      });
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>