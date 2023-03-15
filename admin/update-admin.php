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
		width: 40%;
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
		<h2>Update Admin</h2>
		<br>
		<br>
		<?php
			//Get ID of selected Admin
		$id=$_GET['id'];
			//Create sql to get the details 
		$sql="SELECT * FROM tbl_admin WHERE id=$id";
		//Execute query
		$res=mysqli_query($conn,$sql);
		//Check whether query is executed or not
		if($res==TRUE)
		{
			//Check if data is available
			$count=mysqli_num_rows($res);
			//Check wether we have admin data or not
			If($count==1)
			{
				//Get Admin Details
				$row=mysqli_fetch_assoc($res);
				$full_name=$row['full_name'];
				$username=$row['username'];
			}else
			{
				//Redirect to Manage Admin Page
				header("location:".SITEURL.'admin/manage.admin.php');
			}
		}
		?>
		<form action="" method="POST" class="frm-main">
			<table class="tbl-30">
				<tr>
					<td class="t1">Full Name</td>
					<td><input type="text" name="full_name" value="<?php echo $full_name?>"></td>
				</tr>
				<tr>
					<td class="t1">Username</td>
					<td><input type="text" name="username" value="<?php echo $username?>"></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id;?>">
						<input type="submit" name="send" value="Update Admin" class="btn-secondary-a">
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
	if(isset($_POST['send'])){
		//Get All values from form to update
		$id=$_POST['id'];
		$full_name=$_POST['full_name'];
		$username=$_POST['username'];

		//Create Sql query to Update Admin
		$sql="UPDATE tbl_admin SET full_name='$full_name', username='$username' WHERE id=$id";
		//Execute the query
		$res=mysqli_query($conn,$sql);
		//Check whether query is executed successfully or not
		if($res==TRUE)
		{
			$_SESSION['update']="<div class='success'>Admin Successfully Updated.</div>";
			header("location:".SITEURL.'admin/manage.admin.php');

		}else
		{
			$_SESSION['update']="<div class='error'>Failed To Add Admin.</div>";
			header("location:".SITEURL.'admin/manage.admin.php');

		}
	}
?>
<?php include('partials/footer.php');?>