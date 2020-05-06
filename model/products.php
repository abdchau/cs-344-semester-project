<?php

require "connect.php";

$conn = connectDB();

echo json_encode($conn->query("select * from shopping.products where productID = '".$_POST['productID']."'")->fetch_assoc());


closeConnection($conn);

?>

	