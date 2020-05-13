<?php

function getPassword($conn){

	$result=$conn->query("select userID, password from shopping.users where email='".$_POST['user']['email']."'");
	return json_encode($result->fetch_assoc());
}

function addUser($conn){
	if (getPassword($conn)=="null"){
		$conn->multi_query("insert into shopping.addresses(address, postcode, cityID)
			values('".$_POST['user']['address']."', '".$_POST['user']['zipcode']."', ".$_POST['user']['city'].");");

		$conn->query("insert into shopping.users(firstName, lastName, email, password, addressID) values
		('".$_POST['user']['firstName']."', '".$_POST['user']['lastName']."', '".$_POST['user']['email']."', '".$_POST['user']['password']."', $conn->insert_id)");
		//echo $conn->error. ''. json_encode($addressID);
		return "User added successfully";
	}
	else
		return "User already exists";
}

function addToCart($conn){
	$conn->query("insert into shopping.cart_item values(".$_POST['productID'].", ".$_POST['userID'].", ".$_POST['quantity'].", '".date("Y-m-d H:i:s")."');");
	return "Cart item added".$conn->error;
}
function displayCart($conn){
	$cart = $conn->query(" select * from cart_item join products using (productID) where userID =".$_POST['userID'])->fetch_assoc();
	return json_encode($cart);
}


if (isset($_POST['func'])){
	if ($_POST['func']=='getPassword'){
		echo getPassword($conn);
	}
	if ($_POST['func']=='addUser'){
		echo json_encode(array_keys($_POST));
		echo (json_encode(array_keys($_POST['user'])));
		echo addUser($conn);
	}
	if ($_POST['func']=='resetDB'){
		echo resetDB($conn);
		echo fillDummyData($conn);
	}
	if ($_POST['func']=='addToCart'){
		echo addToCart($conn);
	}
	if ($_POST['func']=='displayCart'){
		echo displayCart($conn);
	}
}

?>

