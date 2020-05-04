<?php

function createTable($conn, $tableName, $columns) {
	$conn->query("drop table if exists shopping.".$tableName);
	$conn->query("create table if not exists shopping.".$tableName.'('.implode(',', $columns).')');
}

function createAllTables($conn){
	createTable($conn, "cities", [
		"cityID int primary key",
		"cityName varchar(20)"
	]);
	createTable($conn, "addresses", [
		"addressID int primary key",
		"address varchar(80)",
		"postcode varchar(5)",
		"cityID int, foreign key (cityID) references shopping.cities(cityID)"
	]);
	createTable($conn, "users", [
		"firstName varchar(20)",
		"lastName varchar(20)",
		"email varchar(20) primary key",
		"password varchar(20)",
		"addressID int, foreign key(addressID) references shopping.addresses(addressID)"
	]);
}

function fillDummyData($conn){

	insertIntoTable($conn, "users", ["asdf@a.a","asdf"]);
	insertIntoTable($conn, "users", ["abchau","123"]);
}

function insertIntoTable($conn, $tableName, $values) {
	$conn->query("insert into shopping.".$tableName.' values ("'.implode('","', $values).'")');
}


?>

	