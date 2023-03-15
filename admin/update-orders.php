<?php include('partials/menu.php');?>
<!--Css for Add admin page "Inline"-->
<style type="text/css">

	.frm-main{
		border:1px solid black;
		padding: 1%;
		width:80%; 
		background-color: rgb(227, 244, 231);
	}

	.tbl-30{
		width: 50%;
		border-spacing: 0 18px;
	}
	.t1{
		font-weight: bold;
		padding: 0 19px;
	}
	.btn-secondary-a{
	color: black;
	background-color: #4cd137;
	padding: 1.5%;
	border-radius: 4px;
	text-decoration: none;
	font-weight: bold;
}
.btn-secondary-a:hover{
	background-color: #70a1ff;
}
</style>

<div class="main-content">
	<div class="wrapper">
		<h2>Update Order</h2>
		<br> 
		<br>
		<?php

		if(isset($_GET['id']))
		{
				//Get ID of selected Admin
				$id=$_GET['id'];
		
		}
		
		?>
		<form action="" method="POST" class="frm-main">
			<table class="tbl-30">
				<tr>
					<td class="t1">Current Password</td>
					<td><input type="password" name="current_password" placeholder="Current Password"></td>
				</tr>
				<tr>
					<td class="t1">New Password</td>
					<td><input type="password" name="new_password" placeholder="New Password"></td>
				</tr>
				<tr>
					<td class="t1">Confirm Password</td>
					<td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id?>">
						<input type="submit" name="send" value="Change Password"class="btn-secondary-a">
					</td>
				</tr>
			</table>
		</form>
		<br>
		<br>
	</div>
	
</div>
<?php
	//Check whether submit button has been clicked or not
	if(isset($_POST['send']))
	{
			//Get All values from form to change password.
			$id=$_POST['id'];
			$current_password=md5($_POST['current_password']);
			$new_password=md5($_POST['new_password']);
			$confirm_password=md5($_POST['confirm_password']);

			//Check whether the user with current ID and Current password exist or not
			$sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
			//Execute the query
			$res=mysqli_query($conn,$sql);

			if($res==TRUE)
			{
				//check whether data is available or not
				$count=mysqli_num_rows($res);


				if($count==1)
				{
					//User exists and password can be changed
					//Check whether the current and new password match
					if($new_password==$confirm_password)
					{
						//Update password

						$sql2="UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
						//Execute the query
						$res2=mysqli_query($conn,$sql2);
						if($res2==TRUE)
						{
							//Redirect to Manage Admin Page
							$_SESSION['password_changed']="<div class='success'>Password Successfully Changed</div>";
							header("location:".SITEURL.'admin/manage.admin.php');
						}else
						{
							//Redirect to Manage Admin Page
							$_SESSION['pass_not_changed']="<div class='error'>Failed To Change Password</div>";
							header("location:".SITEURL.'admin/manage.admin.php');
						}
						

					
					}else
					{
						//Redirect to Manage Admin Page
						$_SESSION['password-not-match']="<div class='error'>Passwords Did Not Match!</div>";
					header("location:".SITEURL.'admin/manage.admin.php');
					}

				}else
				{
					//User does not exist set message and redirect
					$_SESSION['user-not-found']="<div class='error'>User Not Found!</div>";
					header("location:".SITEURL.'admin/manage.admin.php');
				}
			}

			//Check whether the current and new password match


			//Change password if all above is true
			//Create Sql query to Update Admin
		}
?>
<?php include('partials/footer.php');?>