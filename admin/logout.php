<?php
	include('../config/constants.php');
	//Destroy session and redirect to login page
	session_destroy();//Unsets $_SESSION['user']
	//Redirection
	header('location:'.SITEURL.'admin/login.php');
 ?>