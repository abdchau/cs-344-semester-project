<?php 

require 'connect.php';

$conn = connectDB();

function checkCookie($conn){
	$username = 'Sign Up';
	if (isset($_COOKIE['userID'])){
		$username = $conn->query('select * from (select * from shopping.users where userID='.$_COOKIE['userID'].')A natural join shopping.addresses natural join shopping.cities;')
								->fetch_assoc();
	}

	return $username;
}

$username = checkCookie($conn);

function getUserJSON($conn){
	if (checkCookie($conn)=='Sign Up')
		return json_encode(null);
	else{
		return json_encode(checkCookie($conn));
	}
}

require '../model/category.php';
require 'helper.php';
require 'products.php';
require '../model/users.php';

?>