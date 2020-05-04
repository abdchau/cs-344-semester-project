<?php

require "connect.php";
require "helper.php";

function queryTable($conn, $tableName, $column='*') {
	return $conn->query("select ".$column." from shopping.".$tableName);
}

function getPassword($conn) {

	$result=$conn->query("select password from shopping.users where email='".$_POST['email']."'");
	return json_encode($result->fetch_assoc());
}

function addUser($conn) {
	if (getPassword($conn)=="null"){
		insertIntoTable($conn, "users", [$_POST['email'], $_POST['password']]);
		echo $conn->error;
		echo "User added successfully";
	}
	else
		echo "User already exists";
}

$conn = connectDB();

if (isset($_POST['func'])) {
	if ($_POST['func']=='getPassword') {
		echo getPassword($conn);
	}
	if ($_POST['func']=='addUser') {
		echo addUser($conn);
	}
}
else
	echo "No function specified";

closeConnection($conn);

?>

	