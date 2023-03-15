<?php include('partials/menu.php');
//Process value from form and save it in database.
if(isset($_SESSION['add']))
					{
					echo $_SESSION['add'];// Displaying session message
					unset($_SESSION['add']);//Removing session message
					}

//Check whether submit button is clicked or not
if(isset($_POST['send'])){
	//Get data from form
	$location=$_POST['pname'];
	$lat=$_POST['lat'];
	$long=$_POST['long'];
	//SQL Querry to save the data into the database
	$sql="INSERT INTO location SET pname='$location', coordinates= POINT($lat, $long)";
  //Executing query and  savin
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
  // Check whether(Query is executed) data is inserted or not, display appropriate message
	if($res==TRUE){
		//echo "Data Inserted";
		//Create a variable to display
		$_SESSION['add']="<div class='success'>Location Added Succesfully.</div>";
		header("location:".SITEURL.'admin/manage.locations.php');
	}else
	{
		//echo "Data not inserted";
		//Create a variable to display
		$_SESSION['add']="<div class='error'>Failed To Add Location.</div>";
		header("location:".SITEURL.'admin/manage.locations.php');
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
		<h2>Add Location</h2>
		<br>

		<form action="" method="POST" class="frm-main">
			<table class="tbl-30">
				<tr>
					<td class="t1">Place Name</td>
					<td><input type="text" name="pname" placeholder="Enter Place Name"></td>
				</tr>
				<tr>
					<td class="t1">Latitude</td>
					<td><input type="text" name="lat" placeholder="Enter Your Latitude"></td>
				</tr>
				<tr>
					<td class="t1">Longitude</td>
					<td><input type="text" name="long" placeholder="Enter Your Longitude"></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="send" value="Add Location" class="btn-secondary-a">
					</td>
				</tr>
			</table>
		</form>
		<br>
		<br>
	</div>
	
</div>
<?php include('partials/footer.php');?>