<?php

require "connect.php";

$conn = connectDB();

$mas= json_encode($conn->query("select categoryName from shopping.categories where categoryID = ".$_GET['crd'])->fetch_assoc());


closeConnection($conn);

?>