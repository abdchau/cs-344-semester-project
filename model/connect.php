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

$userID='Sign Up';
if (isset($_COOKIE['userID'])){
	$username = $_COOKIE['userID'];
}

?>