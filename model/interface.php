<?php 
require 'connect.php';

$conn = connectDB();


require 'helper.php';

if (!checkDB($conn)){
	resetDB($conn);
	fillDummyData($conn);
}
$username=null;
if (isset($_SESSION['userID'])) {
	$username = checkUser($conn);
}

require '../model/category.php';
require 'products.php';
require '../model/service_ajax.php';

?>