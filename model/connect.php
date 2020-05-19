<?php

session_start();

function connectDB($dbName='shopping') {
	$servername = "localhost:3306";
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

?>