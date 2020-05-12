<?php 

require 'connect.php';

$conn = connectDB();

require '../model/category.php';
require 'helper.php';
require 'products.php';
require '../model/users.php';


function checkCookie($conn){
	$username = 'Sign Up';
	if (isset($_COOKIE['userID'])){
		$username = $conn->query('select firstName from shopping.users where userID='.$_COOKIE['userID'])
								->fetch_assoc()['firstName'];
	}

	return $username;
}

$username = checkCookie($conn);

?>