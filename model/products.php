<?php

require "connect.php";

$conn = connectDB();

$mas=json_encode($conn->query("select * from shopping.products where productID = ".$_GET['prd'])->fetch_assoc());


closeConnection($conn);

?>

	