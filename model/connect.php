<?php

function connectDB($dbName='shopping') {
	$servername = "localhost";
	$username = "pma";
	$password = "";

	$conn = new mysqli($servername, $username, $password);

	if ($conn->connect_error)
		die("Connection failed: " . $conn->connect_error);

	return $conn;
}

function closeConnection($conn) {
	$conn->close();
}

?>

	