<?php

require 'connect.php';


$conn = connectDB();

function getCategories($conn){
	$cats = $conn->query("select * from shopping.categories");

	if ($cats->num_rows > 0){
	    // output data of each row
	    while($category = $cats->fetch_assoc()){

	        $prods = $conn->query("select * from shopping.products where categoryID=".$category['categoryID']);
	        $category['products'] = array();
			if ($prods->num_rows > 0){
				while($product = $prods->fetch_assoc()){
					$category['products'][] = $product;
				}
			}
			else
				$category['products'] = $prods->fetch_assoc();

	        $categories[] = $category;
	    }
	}
	else
		$categories = $cats->fetch_assoc();
	array_walk($categories, function(&$v, $k){
		if(is_string($v) && strpos($v, '"') !== false){
			$v = addslashes(str_replace("\\", '/', $v));
		}
	});
	$ret = json_encode($categories).$conn->error;
	closeConnection($conn);

	return $ret;
}



?>