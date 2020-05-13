<?php 

require 'connect.php';

$conn = connectDB();

require 'helper.php';

$username = checkCookie($conn);


require '../model/category.php';
require 'products.php';
require '../model/users.php';

?>