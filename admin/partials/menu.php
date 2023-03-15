<!DOCTYPE html>
<?php include('../config/constants.php');?>
<?php include('login-check.php');?>
<html>
<head>
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home| Kyle Meats-Admin</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<style type="text/css">
		.ullogo{
	width: 140px;
	float: left;
	text-align: center;
	line-height: 60px;
	margin-top: 13px;
	}
	li#me a img{
		width: 145px;
		background-color: white;
		margin-left: 10px;
		border-radius: 20px;
		padding: 2px;
	}
	li#me a{
		background-color: rgb(45, 45, 73);
		border: none;
	}
	li#me a img:hover{
		width: 143px;	
	}
	nav{
		background-color: rgb(45, 45, 73);
		height: 70px;
		width: 100%;
		border-bottom: 1px solid black;
	}
	nav ul{
	float: right;
	margin-right: 20px;
	}
	nav ul li{
	display: inline-block;
	line-height: 73px;
	margin: 0 4px;

	}
	nav ul li a{
	text-decoration: none;
	font-weight: bold;
	color: white;
	background-color: rgb(45, 45, 73);
	font-size: 1rem;
	border-radius: 1px;
	font-family: sans-serif;
	}
	nav ul li a:hover{
		color: rgb(82, 154, 179);
	}
	</style>
</head>
<body>
		<!--Menu Section Starts-->
		<div class="menu">
			<nav>
				<ul class="ullogo">
					<li id="me"><a href="../admin/index.php"><img src="../images/logo.png"alt="Klye Meats Logo" ></li>
				</ul>
				<ul class="nav">
					<li><a href="index.php">Home</a></li>
					<li><a href="manage.admin.php">Admin</a></li>
					<li><a href="manage.categories.php">Category</a></li>
					<li><a href="manage.meat.php">Butchery</a></li>
					<li><a href="manage.groceries.php">Grocery</a></li>
					<li><a href="manage.morders.php">Orders</a></li>
					<li><a href="manage.locations.php">Locations</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</nav>
			
		</div>
		<br>
	<!--Menu Section Ends-->