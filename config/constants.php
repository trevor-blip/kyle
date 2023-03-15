<?php
	//Start Session
session_start();

	//Constants to store non repeating values
define('SITEURL','http://localhost/kyle-meats-backup/');
	define('LOCALHOST','localhost');
	define('DB_USERNAME','root');
	define('DB_PASSWORD','');
	define('DB_NAME','meat-order');

	$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD)or die(mysqli_error());//Database connection
	$db_select=mysqli_select_db($conn,DB_NAME)or die(mysqli_error());//Selecting database
?>