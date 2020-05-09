<?php

function connectDB($dbName='shopping') {
	$servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password);

	if ($conn->connect_error)
		die("Connection failed: " . $conn->connect_error);

	return $conn;
}

function closeConnection($conn) {
	$conn->close();
}

function checkCookie($conn){
	$username = 'Sign Up';
	if (isset($_COOKIE['userID'])){
		$username = $conn->query('select firstName from shopping.users where userID='.$_COOKIE['userID'])
								->fetch_assoc()['firstName'];
	}

	return $username;
}

$username = checkCookie(connectDB());

?>