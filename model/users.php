<?php

require "connect.php";

function insertIntoTable($conn, $tableName, $values) {
	$conn->query("insert into shopping.".$tableName.' values ("'.implode('","', $values).'")');
}

function queryTable($conn, $tableName, $column='*') {
	return $conn->query("select ".$column." from shopping.".$tableName);
}

function getPassword($conn) {
	// createTable($conn, "users", ["username varchar(20) primary key", "password varchar(20)"]);

	// insertIntoTable($conn, "users", ["asdf@a.a","asdf"]);
	// insertIntoTable($conn, "users", ["abchau","123"]);

	$result=$conn->query("select password from shopping.users where username='".$_POST['username']."'");
	return json_encode($result->fetch_assoc());
}

function addUser($conn) {
	if (getPassword($conn)=="null"){
		insertIntoTable($conn, "users", [$_POST['username'], $_POST['password']]);
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

	