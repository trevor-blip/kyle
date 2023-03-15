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
		<h2>Update Meat</h2>
		<br>
		<?php  
		if(isset($_SESSION['add-item']))
				{
					echo $_SESSION['add-item'];// Displaying session message
					unset($_SESSION['add-item']);//Removing session message
				}	
		?>
		<?php
	//Check whether id is set or not
		if(isset($_GET['id']))
		{
			//Get the id and all other details
			$id=$_GET['id'];
			//Create sql query to get all the details.
			$sql="SELECT * FROM tbl_grocery WHERE id=$id";
			//Execute the query
			$res=mysqli_query($conn,$sql);

			//Count the rows to check if data is available
			$count=mysqli_num_rows($res);

			if($count==1)
			{
				//Get all the data
				$row=mysqli_fetch_assoc($res);
				$title=$row['title'];
				$description=$row['description'];
				$price=$row['price'];
				$current_image=$row['image_name'];
				$current_category=$row['category_id'];
				$featured=$row['featured'];
				$active=$row['active'];

			}else
			{
				//Redirect to manage grocery with error message
				$_SESSION['no-item']="<div class='error'>Item Not Found</div>";
				//Redirect to manage meat page
				header("location:".SITEURL.'admin/manage.groceries.php');

			}

		}else
		{
			//redirect to manage grocery page
			header("location:".SITEURL.'admin/manage.groceries.php');
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
					<td class="t1">Description</td>
					<td><textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea></td>
				</tr>
				<tr>
					<td class="t1">Price</td>
					<td><input type="decimal" name="price" value="<?php echo $price;?>"></td>
				</tr>
				<tr>
					<td class="t1">Current Image</td>
					<td>
						<?php 
						if($current_image!="")
						{
							//Display the image
							?>
							<img src="<?php echo SITEURL;?>images/items/<?php echo $current_image;?>" width="150px">
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
					<td class="t1">Category:</td>
					<td><select name="category">
						<?php
						
						//Create SQL to get all active categories from database
						$sql1="SELECT * FROM tbl_category WHERE active='Yes'";

						$res=mysqli_query($conn,$sql1);
						//Check the number of rows to check if data if available or not
						$count=mysqli_num_rows($res);
						if($count>0)
						{
							//We have categories
							while($rows=mysqli_fetch_assoc($res))
							{
								//Get the details of the availablecategory
								$category_id=$rows['id'];
								$category_title=$rows['title'];
								?>
								<option <?php 
								if($current_category==$category_id)
									{echo "selected";}?> value="<?php echo $category_id;?>"> <?php echo $category_title;?></option>
								<?php
							}
						}else
						{
							//We do not have categories
							?>
							<option>No Category Found</option>
							<?php
						}

						//Displaying categories from database.



						?>
						
					</select></td>
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
						<input type="submit" name="send" value="Update Item" class="btn-secondary-a">
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
				$description=$_POST['description'];
				$price=$_POST['price'];
				$current_images=$_POST['current_image'];
				$category=$_POST['category'];
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
					$image_name="item--".rand(000,999).'.'.$ext;


					$source_path=$_FILES['image']['tmp_name'];
					$destination_path="../images/items/".$image_name;
					//Finaly upload the image
					$upload=move_uploaded_file($source_path,$destination_path);
					//Check if the image is uploaded or not
					//If the image is not uploaded then we we stop the process with error message
					if($upload==FALSE){
						$_SESSION['add-item']="<div class='error'>Failed To Upload Image.</div>";
						header("location:".SITEURL.'admin/update-items.php');
						die();
					}
						//B..Remove the current image if available
					if($current_images!="")
					{

						$remove_path="../images/items/".$current_images;

					$remove=unlink($remove_path);
					}else
					{
						$image_name=$current_images;
						//Check whether image is removed or not
						if($remove==FALSE)
						{
							$_SESSION['fail-remove-img']="<div class='error'>Failed To Remove Current Image.</div>";
							header("location:".SITEURL.'admin/manage.groceries.php');
							die();//Stop the process

						}

					}

					}else
					{
						$image_name=$current_images;
					}

				}else
				{
					$image_name=$current_images;
				}


				//Update the database
				$sql2="UPDATE tbl_grocery SET title='$title',description='$description',price='$price', image_name='$image_name',category_id='$category', featured='$featured', active='$active' WHERE id=$id";
				//Execute the query
				$res2=mysqli_query($conn,$sql2);
				//Redirect to manage grocery with message

				//Check wether query executed or not
				if($res2==TRUE)
				{
					//Category Updated
					$_SESSION['up-item']="<div class='success'>Item Successfully Updated</div>";
					//Redirect to manage grocery page
					header("location:".SITEURL.'admin/manage.groceries.php');
				}else
				{
					//Failed to update Item
					$_SESSION['up-item']="<div class='error'>Failed To Update Meat</div>";
					//Redirect to manage grocery page
					header("location:".SITEURL.'admin/manage.groceries.php');
				}

			}
		?>
		<br>
		<br>
	</div>
	
</div>
<?php include('partials/footer.php')?>