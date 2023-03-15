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
		<h2>Add Category</h2>
		<br>
		<?php  

		if(isset($_SESSION['add-cat']))
				{
					echo $_SESSION['add-cat'];// Displaying session message
					unset($_SESSION['add-cat']);//Removing session message
				}	
		if(isset($_SESSION['upload']))
				{
					echo $_SESSION['upload'];// Displaying session message
					unset($_SESSION['upload']);//Removing session message
				}	
		?>
		<br>

		<form action="" method="POST" enctype="multipart/form-data" class="frm-main">
			<table class="tbl-30">
				<tr>
					<td class="t1">Title</td>
					<td><input type="text" name="title" placeholder="Category Title"></td>
				</tr>
				<tr>
					<td class="t1">Select Image</td>
					<td><input type="file" name="image"></td>
				</tr>
				<tr>
					<td class="t1">Featured</td>
					<td><input type="radio" name="featured" value="Yes"> Yes
					<input type="radio" name="featured" value="No"> No
					</td>
				</tr>
				<tr>
					<td class="t1">Avtive</td>
					<td><input type="radio" name="active" value="Yes"> Yes
					<input type="radio" name="active" value="No"> No</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="send" value="Add Category" class="btn-secondary-a">
					</td>
				</tr>
			</table>
		</form>
	<?php
		if(isset($_POST['send']))
		{
			//Get data from form
			$title=$_POST['title'];
			//For radio input type we need to check whether the button is selected or not
			if(isset($_POST['featured']))
			{
				//Get the value from form	
				$featured=$_POST['featured'];
			}else
			{
				//Get the default value
				$featured="No";
			}
			if(isset($_POST['active']))
			{
				//Get the value from form
				$active=$_POST['active'];
			}else
			{
				//Get the default value
				$active="No";
			}
			//Check whether image is selected or not and set the image name accordingly
			//print_r($_FILES['image']);//die();
			if(isset($_FILES['image']['name']))
			{
				//Upload the image
				//Upload image we need source path and destination path
				$image_name=$_FILES['image']['name'];
				//Upload image only if image is selected
				if($image_name!="")
				{
					//Create a session to auto rename our image
					//Get the extension of our image
					$ext=end(explode('.', $image_name));
					//Rename the image
					$image_name="meat_category_".rand(000,999).'.'.$ext;


					$source_path=$_FILES['image']['tmp_name'];
					$destination_path="../images/category/".$image_name;
					//Finaly upload the image
					$upload=move_uploaded_file($source_path,$destination_path);
					//Check if the image is uploaded or not
					//If the image is not uploaded then we we stop the process with error message
					if($upload==FALSE)
					{
						$_SESSION['add-cat']="<div class='error'>Failed To Upload Image.</div>";
						header("location:".SITEURL.'admin/add-category.php');
						die();
					}
				}

			}else
			{
			//Don't upload image and set name value to blank
			$image_name="";
			}
				//Create sql to insert category into database
				$sql="INSERT INTO tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active'";
				//Execute query and save into database
				$res=mysqli_query($conn,$sql);
				//Check whether sql is executed or not
				if($res==TRUE)
				{
				$_SESSION['add-cat']="<div class='success'>Category Added Succesfully.</div>";
				header("location:".SITEURL.'admin/manage.categories.php');
				}else
				{
					$_SESSION['add-cat']="<div class='error'>Failed To Add Category.</div>";
				header("location:".SITEURL.'admin/manage.categories.php');

				}
		}

	?>
		<br>
		<br>
	</div>
	
</div>
<?php include('partials/footer.php');?>
