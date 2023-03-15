<?php
//Include constants file
include('../config/constants.php');
	//Check whether the values are passed or not
	if(isset($_GET['id']) AND isset($_GET['image_name']))
	{
		//Get the values and delete
		$id=$_GET['id'];
		$image_name=$_GET['image_name'];
		//Remove the physical file if it exists
		if($image_name!="")
		{
			
			$path="../images/category/".$image_name;
			//Remove the image
			$remove= unlink($path);

			//If fails to remove image
			if($remove==FALSE)
			{
				//Set Session message
				$_SESSION['remove']="<div class='error'>Failed To Remove Category Image.</div>"; 
				//Redirect to manage category page
				header("location:".SITEURL.'admin/manage.categories.php');
				//Stop the process
				die();
			}
		}
		//Delete the data from the database
		$sql="DELETE FROM tbl_category WHERE id=$id";
		//Execute the query
		$res=mysqli_query($conn,$sql);
		//Check wether the data has been deleted from the database
		if($res==true){
			//Set success message
			$_SESSION['delete']="<div class='success'>Category Deleted Successfully</div>";
			//Redirect to manage category page
			header("location:".SITEURL.'admin/manage.categories.php');

		}else
		{
			//Set error message
			$_SESSION['delete']="<div class='error'>Failed To Delete Category</div>";
		//Redirect to manage category page
			header("location:".SITEURL.'admin/manage.categories.php');
		}

	}else
	{
		//Redirect to manage category page
		header("location:".SITEURL.'admin/manage.categories.php');
	}
?>