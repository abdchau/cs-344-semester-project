<?php

require "connect.php";

$conn = connectDB();

$query = $_GET['query'];

$pro = getProducts($conn);

function getProducts($conn){
	$result = $conn->query("select * from shopping.products WHERE productName like '%".$_GET['query']."%' or productDscrptn like '%".$_GET['query']."%'");
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        $arr[] = $row;
	    }
	}

	return json_encode($arr).$conn->error;
}

closeConnection($conn);

?>

	