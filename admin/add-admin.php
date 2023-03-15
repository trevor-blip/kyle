<?php include('partials/menu.php');
//Process value from form and save it in database.
//Check whether submit button is clicked or not
if(isset($_POST['send'])){
	//Get data from form
	$full_name=$_POST['full_name'];
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	//SQL Querry to save the data into the database
	$sql="INSERT INTO tbl_admin SET full_name='$full_name', username='$username', password='$password'";
  //Executing query and  savin
	$res=mysqli_query($conn,$sql)or die(mysqli_error());
  // Check whether(Query is executed) data is inserted or not, display appropriate message
	if($res==TRUE){
		//echo "Data Inserted";
		//Create a variable to display
		$_SESSION['add']="<div class='success'>Admin Added Succesfully.</div>";
		header("location:".SITEURL.'admin/manage.admin.php');
	}else
	{
		//echo "Data not inserted";
		//Create a variable to display
		$_SESSION['add']="<div class='error'>Failed To Add Admin.</div>";
		header("location:".SITEURL.'admin/manage.admin.php');
	}

}
?>
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
		<h2>Add Admin</h2>
		<br>

		<form action="" method="POST" class="frm-main">
			<table class="tbl-30">
				<tr>
					<td class="t1">Full Name</td>
					<td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
				</tr>
				<tr>
					<td class="t1">Username</td>
					<td><input type="text" name="username" placeholder="Enter Your Username"></td>
				</tr>
				<tr>
					<td class="t1">Password</td>
					<td><input type="password" name="password" placeholder="Enter Your Password"></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="send" value="Add Admin" class="btn-secondary-a">
					</td>
				</tr>
			</table>
		</form>
		<br>
		<br>
	</div>
	
</div>
<?php include('partials/footer.php');?>