<?php

function getCategoryName($conn){
	return json_encode($conn->query("select categoryName from shopping.categories where categoryID = ".$_GET['crd'])->fetch_assoc());
}

function getProdsByCategory($conn){
	$result = $conn->query("select * from shopping.products where categoryID = ".$_GET['crd']);
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}

	return json_encode($arr).$conn->error;
}

function getCategories($conn){
	$result = $conn->query("select * from shopping.categories");
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        $arr[] = $row;
	    }
	}

	return json_encode($arr).$conn->error;
}

function getCategoriesWithProds($conn, $limit=4){
	$cats = $conn->query("select * from shopping.categories");

	if ($cats->num_rows > 0){
	    while($category = $cats->fetch_assoc()){
	        $prods = $conn->query("select * from shopping.products where categoryID=".$category['categoryID']." limit $limit");
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

	return $ret;
}

?>