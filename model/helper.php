<?php

function resetDB($conn){
	$query = file_get_contents('../model/table_creations.txt');

	$conn->multi_query($query);
	while(mysqli_next_result($conn));
	return "Database initialized ".$conn->error;
}

function fillDummyData($conn){
	$query = file_get_contents('../model/dummy_data.txt');

	$conn->multi_query($query);
	while(mysqli_next_result($conn));

	return "Dummy data filled ".$conn->error;
}

function checkUser($conn){
	$username = null;
	if (isset($_SESSION['userID'])){
		$username = $conn->query('select * from (select * from shopping.users where userID='.$_SESSION['userID'].')A natural join shopping.addresses natural join shopping.cities;')->fetch_assoc();
	}

	return $username;
}

function getUserJSON($conn, $userID=-1){
	if ($userID==-1 && !isset($_SESSION['userID'])) {
		return 'null';
	}
	if (isset($_SESSION['userID']) and $userID==-1)
		$userID=$_SESSION['userID'];
	$username = $conn->query('select * from (select * from shopping.users where userID='.$userID.')A natural join shopping.addresses natural join shopping.cities;')->fetch_assoc();
	return json_encode($username);
}

function getUsers($conn){
	$result = $conn->query("select * from shopping.users");
	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	        $arr[] = $row;
	    }
	    return json_encode($arr);
	}
	else
		return json_encode(null);
}

function getCities($conn){
	$result = $conn->query("select * from shopping.cities");
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        $arr[] = $row;
	    }
	    return json_encode($arr).$conn->error;
	}
	else
		return json_encode(null);
}

function checkDB($conn){
	$result = $conn->query("select schema_name from information_schema.schemata where schema_name = 'shopping'");
	if ($result->num_rows > 0)
		return true;
	else
		return false;
}

function getQuestions($conn){
	$result = $conn->query("select * from shopping.question_type");
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        $arr[] = $row;
	    }
	    return json_encode($arr).$conn->error;
	}
	else
		return json_encode(null);
}

function getMessages($conn){
	$result = $conn->query("select * from shopping.messages natural join shopping.question_type");
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        $arr[] = $row;
	    }
	    return json_encode($arr).$conn->error;
	}
	else
		return json_encode(null);
}

?>