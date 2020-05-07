<?php

require 'connect.php';

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

$conn = connectDB();
$post = json_decode(file_get_contents('php://input'));
// header('Content-Type: application/json');
if (isset($post)){
	if ($post->func=='getCategories'){

		echo getCategories($conn);
	}
}
else
	echo "No function specified".$post->func;
// echo getCategories($conn);

?>