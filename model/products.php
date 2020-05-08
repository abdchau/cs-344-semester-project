<?php

require "connect.php";

$conn = connectDB();

$mas=json_encode($conn->query("select productName,productDscrptn,price,firstName,lastName from shopping.products,shopping.users where products.sellerID = users.userID and productID = ".$_GET['prd'])->fetch_assoc());

$rel= getRelatedProducts($conn);

function getRelatedProducts($conn){
	$result = $conn->query("select productID,productName,productDscrptn,price from shopping.products where categoryID = (select categoryID from shopping.products where productID = ".$_GET['prd'] .") and productID <> ".$_GET['prd']);
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

	