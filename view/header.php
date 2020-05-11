<?php
	$categories_list = getCategories($conn);

echo
	'<nav ng-app="header" ng-controller="navbar_controller" class="navbar sticky-top navbar-expand-lg navbar-light bg-faded shadow" style="background-color: #e3f2fd;">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>

		<a class="navbar-brand mx-auto" href="index.php">
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
			<a ng-repeat="category in categories" class="dropdown-item" href="category.php?crd={{category.categoryID}}">{{category.categoryName}}</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#">More</a>
			</div>
				<li class="nav-item mx-3" id="contact_us">
					<a class="nav-link" href="contact.html">Contact Us</a>
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

		<div class="form-inline my-2 my-lg-0">
		<input ng-model="query" class="form-control mr-sm-2" id="search_bar" type="search" placeholder="Search">
		<a href="searchResult.php?query={{query}}"><button  class="btn btn-outline-success my-2 my-sm-0" id="search_button" type="submit">Search</button></a>
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
		var categories = JSON.parse(\''.$categories_list.'\');

		angular.module("header", [])
		.controller("navbar_controller", ["$scope", "$http", function ($scope, $http) {
		$scope.categories = categories;
		}]);

		var username = "'.$username.'";
		$(document).ready(function (){
			$("#user_action_1").text(username);
		});
		});
	</script>';
?>