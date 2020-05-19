<?php

function loadHeader($title){

	return '
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="style.css">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
		<script src="..\controller\all.js"></script>
		<script src="..\controller\angular-1.3.14.js"></script>
		<script src="..\controller\ajax_requests.js"></script>
		<script src="https://cdn.tiny.cloud/1/zwbn6qqqealuplt84tnh9jxqtnbs4a3lnd02e6wzz98y2pc3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

		<title>'.$title.'</title>
  	</head>';
}


function loadNavbar($categories_list, $user){
	return
	'<nav ng-controller="navbar_ctrl" class="navbar sticky-top navbar-expand-md navbar-light bg-faded shadow" style="background-color: #e3f2fd;">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<a class="navbar-brand mx-auto" href="index.php">
			<img src="images\logo.jpg" width="30" height="30" alt=""> Shopoholic
		</a>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item dropdown mx-3">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Categories
					</a>
					<div class="dropdown-menu" id="categories_dropdown" aria-labelledby="navbarDropdownMenuLink">
						<a ng-repeat="category in categories" class="dropdown-item" href="category.php?crd={{category.categoryID}}">{{category.categoryName}}</a>
					</div>
				</li>
				<li class="nav-item mx-3" id="contact_us">
					<a class="nav-link" href="contact.php">Contact Us</a>
				</li>
			</ul>

			<div class="navbar-nav p-0" ng-if="user != null" id="user_actions">
				<a class="nav-link p-0 mr-4" id="user_action_1" href="profile.php"><i class="fas fa-user-circle" style="font-size:1.7rem"></i><span class="nav-item" id="label"> {{user.firstName}}</span></a>
				<a class="nav-link p-0 mr-3" id="user_action_2" href="#"><i class="fas fa-sign-out-alt" style="font-size:1.7rem"></i><span class="nav-item" id="label"> Sign Out</span></a>
    		</div>
			<div class="navbar-nav p-0" ng-if="user == null" id="user_actions">
				<a class="nav-link p-0 mr-4" id="user_action_1" href="signup.php"><i class="fas fa-user-plus" style="font-size:1.7rem"></i><span class="nav-item" id="label"> Sign Up</span></a>
				<a class="nav-link p-0 mr-3" id="user_action_2" href="signin.php"><i class="fas fa-sign-in-alt" style="font-size:1.7rem"></i><span class="nav-item" id="label"> Sign In</span></a>
    		</div>

			<div class="input-group my-2 col-md-4" id="search">
				<input ng-model="query" class="form-control mr-1" id="search_bar" type="search" placeholder="Search">
				<div class="input-group-append">
					<a href="searchResult.php?query={{query}}">
						<button  class="btn btn-outline-success" id="search_button" type="submit"><i class="fas fa-search"></i></button>
					</a>
				</div>
    		</div>
		</div>
	</nav>


	<script type="text/javascript">
		// Search on pressing enter
		var input = document.getElementById("search_bar");
		input.addEventListener("keyup", function(event) {
			if (event.keyCode === 13) {
				event.preventDefault();
				document.getElementById("search_button").click();
			}
		});
		var categories = JSON.parse(\''.$categories_list.'\');

		$(document).ready(function(){
			$("#user_action_2").click(function(){
				signOut();
			})
		})

		var App = angular.module(\'PageApp\', []);

		App.controller(\'navbar_ctrl\', function ($scope){
			$scope.categories = categories;
			$scope.user = JSON.parse(\''.$user.'\');
		});
	</script>';
}

function loadCartIcon(){
	echo '
	<div  id="cartIcon">
        <a href=checkout.php><img height=80% width=80% src="images/cart.png"></a>
	</div>';
}

function loadFooter(){
	echo '
	<footer class="footer mt-auto pt-4 pb-2 bg-light text-muted text-center text-small">
    <p class="mb-1">© 2020-Present Shopoholic</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="contact.php">Support</a></li>
    </ul>
  </footer>';
}
?>