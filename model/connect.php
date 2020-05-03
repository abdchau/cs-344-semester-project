  
<?php

function insertIntoTable($conn, $tableName, $values) {
	$conn->query("insert into shopping.".$tableName.' values ("'.implode('","', $values).'")');
}

function queryTable($conn, $tableName, $column='*') {
	return $conn->query("select ".$column." from shopping.".$tableName);
}

function createTable($conn, $tableName) {
	$conn->query("drop table if exists shopping.".$tableName);
	$conn->query("create table shopping.".$tableName."(username varchar(20) primary key,password varchar(20))");
}

function connectDB($dbName='shopping') {
	$servername = "localhost";
	$username = "pma";
	$password = "";

	$conn = new mysqli($servername, $username, $password);

	if ($conn->connect_error)
		die("Connection failed: " . $conn->connect_error);

	createTable($conn, 'users');
	echo $conn->error;

	return $conn;
}


$conn = connectDB();
insertIntoTable($conn, "users", ["asdf@a.a","asdf"]);
insertIntoTable($conn, "users", ["abchau","123"]);

// $result = queryTable($conn, "users", "username");
$result=$conn->query("select password from shopping.users where username='".$_POST['user']['username']."'");
echo json_encode($result->fetch_assoc());


$conn->close();
?>

	