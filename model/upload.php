<?php

require 'interface.php';

	$productID = $conn->query("select auto_increment from information_schema.tables where table_schema='shopping' and table_name='products'")->fetch_assoc();
	$target_dir = "../view/images/products/";
	$target_file = $target_dir.$username['userID'].'_'.$productID['auto_increment'].'_'.basename($_FILES["image"]["name"]);
	$uploadOk = 1;

	echo $target_file;

	// Check if image file is a actual image or fake image
	$check = getimagesize($_FILES["image"]["tmp_name"]);
	if($check !== false) {
		echo "File is an image - " . $check["mime"];
		move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
		$conn->query("insert into shopping.products(categoryID, productName, productDscrptn,
		price, imageURL, stock, sellerID) values
		(".$_POST['categoryID'].", '".$_POST['productName']."', '".$_POST['description']."', ".$_POST['price'].", '".$target_file."', ".$_POST['stock'].", ".$username['userID'].")");
		echo $_POST['price'].$conn->error;
		header("Location: ../view/profile.php");
	}
	else
		echo "File is not an image.";

?>

