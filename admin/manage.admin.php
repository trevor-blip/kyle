<?php include ('partials/menu.php');?>
<!--My Css for admin page-->
<style type="text/css">
.success{

	color: #4cd137;
	font-weight: bold;
	background: transparent;
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
.tbl_full{
	width: 100%;
	border-spacing: 0 18px;
}
table tr th{
	border-bottom: 2px solid white;
	border-left: 1px solid white;
	border-right: 1px solid white;
	padding: 1px;
	color: white;
	background-color: rgb(45, 45, 73);
	text-align: left;
}
table tr td{
	padding: 1px;
	
}
.btn-primary{
	background-color: rgb(45, 45, 73);
	padding: 1%;
	border-radius: 8px;
	font-weight: bold;
}
.btn-primary:hover{
	background-color: #009432;
}
.btn-secondary{
	color: black;
	background-color: #4cd137;
	padding: 1.5%;
	border-radius: 4px;
	text-decoration: none;
	font-weight: bold;
}
.btn-secondary:hover{
	background-color: #70a1ff;
}
.btn-secondary-1{
	color: white;
	background-color: #e84118;
	padding: 1.5%;
	border-radius: 4px;
	text-decoration: none;
	font-weight: bold;
}
.btn-secondary-1:hover{
	background-color: #FC427B;
</style>

		<!--Main Content Section Starts-->
		<div class="main-content">
			<div class="wrapper">
				<h3>Manage Admin</h3>
				<!--Button to add admin-->
				<br>
				<br>
				<?php if(isset($_SESSION['add']))
				{
					echo $_SESSION['add'];// Displaying session message
					unset($_SESSION['add']);//Removing session message
				}
				?>
				<?php
					if(isset($_SESSION['delete']))
				{
					echo $_SESSION['delete'];// Displaying session message
					unset($_SESSION['delete']);//Removing session message
				}
				if(isset($_SESSION['update']))
				{
					echo $_SESSION['update'];// Displaying session message
					unset($_SESSION['update']);//Removing session message
				}
				if(isset($_SESSION['user-not-found']))
				{
					echo $_SESSION['user-not-found'];// Displaying session message
					unset($_SESSION['user-not-found']);//Removing session message
				}
				if(isset($_SESSION['password-not-match']))
				{
					echo $_SESSION['password-not-match'];// Displaying session message
					unset($_SESSION['password-not-match']);//Removing session message
				}
				if(isset($_SESSION['password_changed']))
				{
					echo $_SESSION['password_changed'];// Displaying session message
					unset($_SESSION['password_changed']);//Removing session message
				}
				if(isset($_SESSION['pass_not_changed']))
				{
					echo $_SESSION['pass_not_changed'];// Displaying session message
					unset($_SESSION['pass_not_changed']);//Removing session message
				}
		?>
				<br>
				<br>
				<br>
				<a href="add-admin.php" class="btn-primary" style="text-decoration: none; color: rgb(196, 219, 228);">Add Admin</a>
				<br>
				<br>
				<br>

				<table class="tbl_full">
					<tr>
						<th>Serial No.</th>
						<th>Full Name</th>
						<th>Username</th>
						<th>Actions</th>
					</tr>
					<?php
						$sql="SELECT * FROM tbl_admin";//Execute the query
						$res=mysqli_query($conn,$sql);
						if($res==TRUE)
						{
							//Count rows to check whether we have data in database or not
							$count=mysqli_num_rows($res);//Function to get all the rows in database
							$sn=1;
							if($count>0)
							{
								//We have data in our database
								while ($rows=mysqli_fetch_assoc($res)) {
									//Using while loop to get the data form the database
									//While loop will run as long as we have data in our database

									//Get individual data
									$id=$rows['id'];
									$full_name=$rows['full_name'];
									$username=$rows['username'];
									//display the values in our table
									?>
									<tr style="align-items: center;">
									<td><?php
									echo $sn++?></td>
									<td><?php
									echo $full_name?></td>
									<td><?php
									echo $username?></td>
									<td><a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
									<a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-secondary-1">Delete Admin</a>
									<a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-secondary">Change Password</a>
								</td>
									
								</tr>
									<?php
								}
							}
						}
					?>
				</table>

			</div>
		</div>
	<!--Main Content Section Ends-->

<?php include ('partials/footer.php');?>