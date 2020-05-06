<?php

require "connect.php";
require "helper.php";

function queryTable($conn, $tableName, $column='*'){
	return $conn->query("select ".$column." from shopping.".$tableName);
}

function getPassword($conn){

	$result=$conn->query("select password from shopping.users where email='".$_POST['email']."'");
	return json_encode($result->fetch_assoc());
}

function addUser($conn){
	if (getPassword($conn)=="null"){
		$conn->query("insert into shopping.addresses(address, postcode, cityID) 
			values('".$_POST['address']."', '".$_POST['zipcode']."', ".$_POST['city'].");");
		$addressID = $conn->query("	select last_insert_id();");
		echo $conn->error. ''. json_encode($addressID);
		return "User added successfully";
	}
	else
		return "User already exists";
}

$conn = connectDB();

if (isset($_POST['func'])){
	if ($_POST['func']=='getPassword'){
		echo getPassword($conn);
	}
	if ($_POST['func']=='addUser'){
		echo addUser($conn);
	}
	if ($_POST['func']=='resetDB'){
		echo resetDB($conn);
		echo fillDummyData($conn);
	}
}
else
	echo "No function specified";

closeConnection($conn);

?>

	