<?php

function getPassword($conn){
	$result=$conn->query("select userID, password from shopping.users where email='".$_POST['user']['email']."'");
	return json_encode($result->fetch_assoc());
}

function changePassword($conn){
	$conn->query("update shopping.users set password='".$_POST['password']."' where userID=".$_POST['userID']);
	return "Password updated".$conn->error;
}

function addUser($conn){
	if (getPassword($conn)=="null"){
		$conn->multi_query("insert into shopping.addresses(address, postcode, cityID)
			values('".$_POST['user']['address']."', '".$_POST['user']['zipcode']."', ".$_POST['user']['city'].");");

		$conn->query("insert into shopping.users(firstName, lastName, email, password, addressID) values
		('".$_POST['user']['firstName']."', '".$_POST['user']['lastName']."', '".$_POST['user']['email']."', '".$_POST['user']['password']."', $conn->insert_id)");
		//echo $conn->error. ''. json_encode($addressID);
		return "User added successfully".$conn->error;
	}
	else
		return "User already exists";
}

function changeUser($conn){
	$addressID = $conn->query("select addressID from shopping.users where userID=".
		$_POST['user']['userID'])->fetch_assoc()['addressID'];


	$conn->query("update shopping.addresses set address='".$_POST['user']['address']."', postcode='".
		$_POST['user']['zipcode']."', cityID=".$_POST['user']['city']." where addressID=$addressID");

	$conn->query("update shopping.users set email='".$_POST['user']['email']."', firstName='".
		$_POST['user']['firstName']."', lastName='".$_POST['user']['lastName'].
		"' where userID=".$_POST['user']['userID']);

	return "User updated successfully".$conn->error;
}


function addToCart($conn){
	$result = $conn->query("select * from shopping.cart_item where userID=".$_POST['userID'].
		" and productID=".$_POST['productID']);
	if ($result->num_rows > 0){
		// return "greater than 0";
		$quantity  = $result->fetch_assoc()['quantity'] + $_POST['quantity'];
		$conn->query("update shopping.cart_item set quantity=".$quantity." 
			where userID=".$_POST['userID']." and productID=".$_POST['productID']);
		return "Cart item updated".$conn->error;
	}
	else{
		// return "not greater than 0";
		$conn->query("insert into shopping.cart_item values(".$_POST['productID'].", ".
			$_POST['userID'].", ".$_POST['quantity'].", '".date("Y-m-d H:i:s")."');");
		return "Cart item added".$conn->error;
	}
}
function displayCart($conn){
	$cart = $conn->query(" select * from cart_item join products using (productID) where userID =".$_POST['userID'])->fetch_assoc();
	return json_encode($cart);
}

function deleteUser($conn){
	$conn->query("delete from shopping.users where userID=".$_POST['userID']);
	return "User deleted".$conn->error;
}

function deleteProduct($conn){
	$conn->query("delete from shopping.products where productID=".$_POST['productID']);
	return "Product deleted".$conn->error;
}

function toggleFeatured($conn){
	$conn->query("update shopping.products set featured=not (select featured from shopping.products where productID=".$_POST['productID'].") where productID=".$_POST['productID']);
	return "Featured toggled".$conn->error;
}

function toggleAdmin($conn){
	$conn->query("update shopping.users set isAdmin=not (select isAdmin from shopping.users where userID=".
		$_POST['userID'].") where userID=".$_POST['userID']);
	return "Admin privileges toggled".$conn->error;
}

function removeCategory($conn){
	$conn->query("delete from shopping.categories where categoryID=".$_POST['categoryID']);
	return "Category deleted".$conn->error;
}
function editCategory($conn){
	$conn->query("update shopping.categories set categoryName= '".$_POST['Name']."' where categoryID =".$_POST['categoryID']);
	return "Category edited".$conn->error;
}
function addCategory($conn){
	$conn->query("insert into shopping.categories (categoryName) values ('".$_POST['categoryName']."')");
	return "Category added".$conn->error;
}

function placeOrder($conn){
	$conn->query("insert into shopping.orders(buyerID, amount, billingName, billingAddress, timeCreated)
		values ('".$_POST['order']['buyerID']."', '".$_POST['order']['amount']."', '".$_POST['order']['billingName']."', '".$_POST['order']['billingAddress']."', '".date("Y-m-d H:i:s")."')");
	$orderID = $conn->insert_id;
	
	foreach ($_POST['order']['order_items'] as $key => $product) {
		$conn->query("insert into shopping.order_item values ($orderID, ".$product['productID'].", ".
			$product['quantity'].")");
	}
	$conn->query("delete from shopping.cart_item where userID=".$_POST['order']['buyerID']);
	return "Order placed".$conn->error;
}

function removeFromCart($conn){
	$conn->query("delete from shopping.cart_item where userID=".$_POST['userID']." and productID=".$_POST['productID']);
	return "Removed from cart".$conn->error;
}

if (isset($_POST['func'])){
	if ($_POST['func']=='getPassword'){
		echo getPassword($conn);
	}
	if ($_POST['func']=='changePassword'){
		echo changePassword($conn);
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
	if ($_POST['func']=='addUser'){
		echo addUser($conn);
	}
	if ($_POST['func']=='changeUser'){
		echo changeUser($conn);
	}
	if ($_POST['func']=='addToCart'){
		echo addToCart($conn);
	}
	if ($_POST['func']=='displayCart'){
		echo displayCart($conn);
	}
	if ($_POST['func']=='removeFromCart'){
		echo removeFromCart($conn);
	}
	if ($_POST['func']=='deleteUser'){
		echo deleteUser($conn);
	}
	if ($_POST['func']=='deleteProduct'){
		echo deleteProduct($conn);
	}
	if ($_POST['func']=='toggleFeatured'){
		echo toggleFeatured($conn);
	}
	if ($_POST['func']=='toggleAdmin'){
		echo toggleAdmin($conn);
	}
	if ($_POST['func']=='removeAdmin'){
		echo removeAdmin($conn);
	}
	if ($_POST['func']=='removeCategory'){
		echo removeCategory($conn);
	}
	if ($_POST['func']=='editCategory'){
		echo editCategory($conn);
	}
	if ($_POST['func']=='addCategory'){
		echo addCategory($conn);
	}
	if ($_POST['func']=='placeOrder'){
		echo placeOrder($conn);
	}
}

?>

