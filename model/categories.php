<?php

if (isset($_GET['func'])){
	if ($_POST['func']=='getCategories'){
        $category->id = 1;
        $category->name = "John";
	    return json_encode($category);
	}
}
else
	echo "No function specified";
?>

