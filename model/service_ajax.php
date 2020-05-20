<?php

function verifyUser($conn){
	$result=$conn->query("select * from shopping.users where email='".$_POST['user']['email']."'")->fetch_assoc();

	if (isset($result['password'])) {
		if ($result['password']==md5($_POST['user']['password'])) {
			$_SESSION['userID'] = $result['userID'];
			return "{\"userID\":".$result['userID'].",\"res\":1}";
		}
		else
			return "{\"res\":-1}";
	}
	else
		return "{\"res\":0}";
}

function signOut(){
	session_unset();
	session_destroy();
	return "Signed out yay";
}

function changePassword($conn){
	$password=$conn->query("select password from shopping.users where userID=".$_POST['userID'])
							->fetch_assoc()['password'];

	$oldPassword = md5($_POST['oldPassword']);
	if ($password==$oldPassword) {
		$conn->query("update shopping.users set password=md5('".$_POST['password']."') where userID=".$_POST['userID']);
		return "{\"res\":1}";
	}
	return "{\"res\":0}";

}

function addUser($conn){
	if (!isset(verifyUser($conn)['password'])){
		$conn->multi_query("insert into shopping.addresses(address, postcode, cityID)
			values('".$_POST['user']['address']."', '".$_POST['user']['zipcode']."', ".$_POST['user']['city'].");");

		$conn->query("insert into shopping.users(firstName, lastName, email, password, addressID) values
		('".$_POST['user']['firstName']."', '".$_POST['user']['lastName']."', '".$_POST['user']['email']."', md5('".$_POST['user']['password']."'), $conn->insert_id)");
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
function editStock($conn){
	$conn->query("update shopping.products set stock= '".$_POST['stock']."' where productID =".$_POST['productID']);
	return "Stock edited".$conn->error;
}
function addCategory($conn){
	$conn->query("insert into shopping.categories (categoryName) values ('".$_POST['categoryName']."')");
	return "Category added".$conn->error;
}

function removeCity($conn){
	$conn->query("delete from shopping.cities where cityID=".$_POST['cityID']);
	return "City deleted".$conn->error;
}

function addCity($conn){
	$conn->query("insert into shopping.cities (cityName) values ('".$_POST['cityName']."')");
	return "City added".$conn->error;
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

function deleteOrder($conn){
	$conn->query("delete from shopping.order_item where productID = ".
			$_POST['productID']." and orderID=".$_POST['orderID']);
	return "Order deleted".$conn->error;
}

function completeOrder($conn){
	$product = $conn->query("select stock, quantity, userID, productsSold from shopping.products natural join 
			(select * from shopping.order_item where orderID=".$_POST['orderID'].
			" and productID=".$_POST['productID'].")A join shopping.users on sellerID=userID")->fetch_assoc();

	$quantity = $product['stock']-$product['quantity'];
	$conn->query("update shopping.products set stock=$quantity where productID = ".
		$_POST['productID']);
	$conn->query("delete from shopping.order_item where productID = ".$_POST['productID'].
			" and orderID=".$_POST['orderID']);

	$productsSold = $product['productsSold']+$product['quantity'];
	$conn->query("update shopping.users set productsSold=$productsSold where userID=".$product['userID']);

	return "Order completed".$conn->error;
}

function removeFromCart($conn){
	$conn->query("delete from shopping.cart_item where userID=".$_POST['userID']." and productID=".$_POST['productID']);
	return "Removed from cart".$conn->error;
}

function storeMessage($conn){
	$conn->query("insert into shopping.messages(questionID, name, email, phone, description) values(".
		$_POST['question'].", '".$_POST['name']."', '".$_POST['email']."', '".
		$_POST['phone']."', '".$_POST['description']."')");

	return "Message saved.".$conn->error;
}

function removeMessage($conn){
	$conn->query("delete from shopping.messages where messageID=".$_POST['messageID']);
	return "Message deleted".$conn->error;
}

if (isset($_POST['func'])){
	switch ($_POST['func']) {
		case 'verifyUser':
			echo verifyUser($conn);
			break;
		case 'signOut':
			echo signOut();
			break;
		case 'changePassword':
			echo changePassword($conn);
			break;
		case 'addUser':
			echo addUser($conn);
			break;
		case 'resetDB':
			echo resetDB($conn);
			echo fillDummyData($conn);
			break;
		case 'addUser':
			echo addUser($conn);
			break;
		case 'changeUser':
			echo changeUser($conn);
			break;
		case 'addToCart':
			echo addToCart($conn);
			break;
		case 'displayCart':
			echo displayCart($conn);
			break;
		case 'removeFromCart':
			echo removeFromCart($conn);
			break;
		case 'deleteUser':
			echo deleteUser($conn);
			break;
		case 'deleteProduct':
			echo deleteProduct($conn);
			break;
		case 'deleteOrder':
			echo deleteOrder($conn);
			break;
		case 'completeOrder':
			echo completeOrder($conn);
			break;
		case 'toggleFeatured':
			echo toggleFeatured($conn);
			break;
		case 'toggleAdmin':
			echo toggleAdmin($conn);
			break;
		case 'removeAdmin':
			echo removeAdmin($conn);
			break;
		case 'removeCategory':
			echo removeCategory($conn);
			break;
		case 'editCategory':
			echo editCategory($conn);
			break;
		case 'editStock':
			echo editStock($conn);
			break;
		case 'addCategory':
			echo addCategory($conn);
			break;
		case 'addCity':
			echo addCity($conn);
			break;
		case 'removeCity':
			echo removeCity($conn);
			break;
		case 'placeOrder':
			echo placeOrder($conn);
			break;
		case 'storeMessage':
			echo storeMessage($conn);
			break;
		case 'removeMessage':
			echo removeMessage($conn);
			break;
		default:
			echo "No function specified";
			break;
	}
}

?>

