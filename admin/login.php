<!DOCTYPE html>
<?php include('../config/constants.php');?>
<html>
<head>
	<title>Login| Kyle Meats</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<style type="text/css">
		a{
			text-decoration: none;
			color: rgb(103, 216, 239);
		}
		a:hover{
			color: rgb(29, 161, 228);
			font-weight: bold;
		}
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		body{
			color: white;
			width: 100%;
		background: url("../img/bg_bg.jpg");
		background-size: cover;
		background-position: center;
		height: 100vh;

		}
		h1{
			text-transform: uppercase;
			font-size: 2em;
			text-align: center;
			margin-bottom: 1em;
		}
		.control input{
			width: 100%;
			display: block;
			padding: 7px;
			color: black;
			border: none;
			outline: none;
			margin: 1em 0;
			border-radius: 5px;

		}
		.login{
			font-family: serif;
			position: absolute;
		top: 50%;
		left: 50%;
		transform:translate(-50%,-50%);
		background:linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6));
		width: 330px;
		padding: 50px 30px;
		border-radius: 10px;
		box-shadow: 7px 7px 70px black;
		}
input[type="submit"]{
	background:#eb3b5a;
	color: white;
	font-size: 1.3em;
	opacity: 0.8;


}
	.frm-center{

		
	}
	.login-sctn{
		
	}
	.success{

	color: #4cd137;
	font-weight: bold;
	background: transparent;
	background-color: white;
	display:inline-block;
    text-align:center;
    padding: 2px;
	}
	.error{
	color: #e74c3c;
	font-weight: bold;
	background: transparent;
	display:inline-block;
    text-align:center;
    padding: 2px;
    width: 100%;
	}
	.t1{
		
	}
	.me{
		text-align: center;
	}
	.sm{
		text-align: center;
		font-size: 0.8rem;
	}
	</style>
</head>

<body>

	<section class="login-sctn">
	<div class="login">
		<h1 class="text-cr">Login</h1>
		<!--Login form starts here-->
		<form action="" method="POST" class="frm-center">
			<div class="control">
				<label for="username">Username</label>
			<input class="t1" type="text" name="username" placeholder="Enter Username">
			</div>
			<div class="control">
				<label for="password">Password</label>
			<input class="t1" type="password" name="password" placeholder="Enter Password">
			</div>
			<div class="control">
			<input type="submit" name="send" value="Login" class="btn-secondary-a">
			</div>
			<div class="control">
			<?php
			if(isset($_SESSION['login']))
					{
						echo $_SESSION['login'];// Displaying session message
						unset($_SESSION['login']);//Removing session message
					}
			if(isset($_SESSION['no-loggin-message']))
			{
				echo $_SESSION['no-loggin-message'];
				unset($_SESSION['no-loggin-message']);
			}
			?>
			</div>
		</form>
		<br>
		<p class="me"><span>&#169;</span> All right reserved by Kyle Meats.</p><br><p class="sm"> Developed by <a href="#">Komborero Chiweshe</a></p>
		<br>
	</div>
	</section>
</body>
</html>
<?php
//Check whether submit button is clicked or not
if(isset($_POST['send']))
{
	//Process for login
	//Get data from login form
	$username= $_POST['username'];
	$password= md5($_POST['password']);

	//Check whether the username and password exists or not.
	$sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
	//Execute query
	$res=mysqli_query($conn,$sql);

	//count rows to check if user exists
	$count=mysqli_num_rows($res);

	if($count==1)
		{
			//User available
			$_SESSION['login']="<div class='success'>Welcome To Kyle Meats Admin Panel.</div>";
			$_SESSION['user']=$username;// To check wether the user is loged in or not and logout will unset it?
			header("location:".SITEURL.'admin/');

		}else
		{
			//user not available
			$_SESSION['login']="<div class='error'>Invalid username or password.</div>";
			header("location:".SITEURL.'admin/login.php');
		}
 
}
?>