<?php

require "connect.php";

$conn = connectDB();

$mas= json_encode($conn->query("select categoryName from shopping.categories where categoryID = ".$_GET['crd'])->fetch_assoc());

$pro= getProducts($conn);

function getProducts($conn){
	$result = $conn->query("select productID,productName,productDscrptn,price from shopping.products where categoryID = ".$_GET['crd']);
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