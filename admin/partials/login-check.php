<?php 
	//Access control
	//Check whether user is logged in or not
	if(!isset($_SESSION['user']))
	{
		//User is not logged in
		$_SESSION['no-loggin-message']="<div class='error'>Please Login To Have Access to Admin Panel</div>";
		header('location:'.SITEURL.'admin/login.php');
	}
?>