  
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

function createTable($conn, $tableName, $columns) {
	$conn->query("drop table if exists shopping.".$tableName);
	$conn->query("create table if not exists shopping.".$tableName.'('.implode(',', $columns).')');
}

?>

	