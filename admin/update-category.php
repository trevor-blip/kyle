<?php include('partials/menu.php')?>
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
		<h2>Update Category</h2>
		<br>
		<?php  

		if(isset($_SESSION['update-cat']))
				{
					echo $_SESSION['update-cat'];// Displaying session message
					unset($_SESSION['update-cat']);//Removing session message
				}	
		if(isset($_SESSION['upload']))
				{
					echo $_SESSION['upload'];// Displaying session message
					unset($_SESSION['upload']);//Removing session message
				}	
		?>
		<?php

			//Check whether id is set or not
		if(isset($_GET['id']))
		{
			//Get the id and all other details
			$id=$_GET['id'];
			//Create sql query to get all the details.
			$sql="SELECT * FROM tbl_category WHERE id=$id";
			//Execute the query
			$res=mysqli_query($conn,$sql);

			//Count the rows to check if data is available
			$count=mysqli_num_rows($res);

			if($count==1)
			{
				//Get all the data
				$row=mysqli_fetch_assoc($res);
				$title=$row['title'];
				$current_image=$row['image_name'];
				$featured=$row['featured'];
				$active=$row['active'];

			}else
			{
				//Redirect to main category with error message
				$_SESSION['no-cat']="<div class='error'>Category Not Found</div>";
				//Redirect to manage category page
				header("location:".SITEURL.'admin/manage.categories.php');

			}

		}else
		{
			//redirect to manage category
			header("location:".SITEURL.'admin/manage.categories.php');
		}

		?>
		<br>

		<form action="" method="POST" enctype="multipart/form-data" class="frm-main">
			<table class="tbl-30">
				<tr>
					<td class="t1">Title</td>
					<td><input type="text" name="title" value="<?php echo $title;?>"></td>
				</tr>
				<tr>
					<td class="t1">Current Image</td>
					<td>
						<?php 
						if($current_image!="")
						{
							//Display the image
							?>
							<img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="150px">
							<?php
						}else
						{
							//Send error message
							echo "<div class='error'>Image Not Added</div>";
						}
						?>
					</td>
				</tr>
				<tr>
					<td class="t1">New Image</td>
					<td><input type="file" name="image"></td>
				</tr>
				<tr>
					<td class="t1">Featured</td>
					<td><input <?php 
					if($featured=="Yes"){
						echo "checked";
					}
					?> type="radio" name="featured" value="Yes"> Yes
					<input <?php 
					if($featured=="No"){
						echo "checked";
					}
					?>  type="radio" name="featured" value="No"> No
					</td>
				</tr>
				<tr>
					<td class="t1">Avtive</td>
					<td><input <?php 
					if($active=="Yes"){
						echo "checked";
					}
					?> type="radio" name="active" value="Yes"> Yes
					<input <?php 
					if($active=="No"){
						echo "checked";
					}
					?> type="radio" name="active" value="No"> No</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="hidden" name="current_image" value="<?php echo $current_image;?>">
						<input type="hidden" name="id" value="<?php echo $id;?>">
						<input type="submit" name="send" value="Update Category" class="btn-secondary-a">
					</td>
				</tr>
			</table> 
		</form>
		<?php
		if(isset($_POST['send']))
			{
				//Get all the values from our form
				$id=$_POST['id'];
				$title=$_POST['title'];
				$current_image=$_POST['current_image'];
				$featured=$_POST['featured'];
				$active=$_POST['active'];

				//Updating new image
				//Check whether image is selected or not
				if(isset($_FILES['image']['name']))
				{
					//Get the image details
					$image_name=$_FILES['image']['name'];
					//Check if image is available or not
					if($image_name!="")
					{
						//Image available
						//A...Upload the new image
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
					if($upload==FALSE){
						$_SESSION['add-cat']="<div class='error'>Failed To Upload Image.</div>";
						header("location:".SITEURL.'admin/update-category.php');
						die();
					}
						//B..Remove the current image if available
					if($current_image!="")
					{

						$remove_path="../images/category/".$current_image;

					$remove=unlink($remove_path);
					}else
					{
						$image_name=$current_image;
						//Check whether image is removed or not
						if($remove==FALSE)
						{
							$_SESSION['fail-remove-img']="<div class='error'>Failed To Remove Current Image.</div>";
							header("location:".SITEURL.'admin/manage.categories.php');
							die();//Stop the process

						}

					}

					}else
					{
						$image_name=$current_image;
					}

				}else
				{
					$image_name=$current_image;
				}


				//Update the database
				$sql2="UPDATE tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active' WHERE id=$id";
				//Execute the query
				$res2=mysqli_query($conn,$sql2);
				//Redirect to manage category with message

				//Check wether query executed or not
				if($res2==TRUE)
				{
					//Category Updated
					$_SESSION['up-cat']="<div class='success'>Category Successfully Updated</div>";
					//Redirect to manage category page
					header("location:".SITEURL.'admin/manage.categories.php');
				}else
				{
					//Failed to update category
					$_SESSION['up-cat']="<div class='error'>Failed To Update Category</div>";
					//Redirect to manage category page
					header("location:".SITEURL.'admin/manage.categories.php');
				}

			}
		?>
		<br>
		<br>
	</div>
	
</div>
<?php include('partials/footer.php')?>