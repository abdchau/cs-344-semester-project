<?php

function resetDB($conn){
	$query = file_get_contents('table_creations.txt');

	$conn->multi_query($query);
	while(mysqli_next_result($conn));
	return "Database initialized ".$conn->error;
}

function fillDummyData($conn){
	$conn->query("insert into shopping.cities(cityName) values ('Islamabad'), ('Lahore'), ('Faisalabad')");
	$conn->query("insert into shopping.addresses(address, postcode, cityID) values
		('St 96, H69', '44000', 1), ('Model Town', '23432', 2), ('Siall', '63453', 3)");
	$conn->query("insert into shopping.users(firstName, lastName, email, password, addressID) values 
		('Abdullah', 'Chaudhry', 'abc@edu.pk', '123', 1), 
		('Ahmad', 'Jarrar', 'ajk@edu.pk', 'jarrar', 3), 
		('Shariq', 'Pervaiz', 'spv@edu.pk', 'shariq', 2)");
	$conn->query("insert into shopping.categories(categoryName) values('Mobiles'),('Tablets'),('Home Appliances')");
	$conn->query("insert into shopping.products(categoryID, productName, productDscrptn, 
		price, imageURL, stock, sellerID) values
		(1, 'Samsung Galaxy A2', 'Terrible phone doesnt work at all', 199, '../view/images/products/Samsung-Galaxy-A2-Core-1.jpg', 2, 1),
		(1, 'Samsung Galaxy S5', 'Very nice phone touch', 399, '../view/images/products/samsung_galaxy_s5-1.jpg', 23, 1),
		(2, 'Samsung Galaxy Tab', 'Sleek and smart masti', 499, '../view/images/products/samsung_galaxy_tab.jpg', 3, 2),
		(3, 'Sony Microwave A10', 'Nice warm food', 1299, '../view/images/products/sony_microwave.jpeg', 4, 3),
		(2, 'Apple iPad 3', 'Big screen looks nice 10.5-inch', 399, '../view/images/products/Apple-iPad-mini-3.jpg', 5, 3),
		(3, 'Samsung SmartTV', '40-inch screen parental controls and other features', 1199, '../view/images/products/samsung_smart_tv.jpg', 6, 2),
		(1, 'Samsung Galaxy S8', 'Has edge round metal finish', 599, '../view/images/products/samsung_galaxy_s8.jpeg', 3, 1),
		(2, 'Xaomi Mi Pad 4', 'Has MIUI status symbol', 559, '../view/images/products/xaomi_mi_tab_4.jpg', 7, 3),
		(3, 'Orient Fridge', 'Keeps your food nice and acool', 549, '../view/images/products/orient_fridge.jpg', 12, 2)");
	while(mysqli_next_result($conn));

	return "Dummy data filled ".$conn->error;
}

?>

	