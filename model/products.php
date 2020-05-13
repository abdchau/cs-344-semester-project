<?php

function getInfo($conn)
{
	return json_encode($conn->query("select productName,productDscrptn,categoryID,price,firstName,lastName, imageURL from
		shopping.products,shopping.users where products.sellerID = users.userID and productID = ".$_GET['prd'])->fetch_assoc());
}

function getFeaturedProducts($conn){
	$result = $conn->query("select * from shopping.products where featured = true");
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        $arr[] = $row;
	    }
	}

	return json_encode($arr).$conn->error;
}

function getRelatedProducts($conn){
	$result = $conn->query("select * from shopping.products where categoryID = (select categoryID from shopping.products where productID = ".$_GET['prd'] .") and productID <> ".$_GET['prd']);
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        $arr[] = $row;
	    }
	}

	return json_encode($arr).$conn->error;
}

function searchProducts($conn){
	$query = $_GET['query'];

	$result = $conn->query("select * from shopping.products WHERE productName like '%".$_GET['query']."%' or productDscrptn like '%".$_GET['query']."%'");
	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	        $arr[] = $row;
	    }
	}
	else
		return json_encode(null);

	return json_encode($arr).$conn->error;
}

function getCart($conn, $username){
	if ($username=='Sign up')
		header('Location: signin.php');
	else{
		$result=$conn->query("select * from ((select * from shopping.cart_item where userID=".$username['userID'].")A natural join shopping.products);");
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		        $arr[] = $row;
		    }
		}
		else
			$arr=null;
		return json_encode($arr).$conn->error;
	}
}

?>