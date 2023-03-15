<?php include('partials/menu.php');?>
<!--Css for Add admin page "Inline"-->
<style type="text/css">

	.frm-main{
		border:1px solid black;
		padding: 1%;
		width:95%; 
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
		<h2>Add Item</h2>
		<br>
		<br>
		<?php 
		if(isset($_SESSION['img-upload']))
				{
					echo $_SESSION['img-upload'];// Displaying session message
					unset($_SESSION['img-upload']);//Removing session message
				}		
		?>

		<form action="" method="POST" enctype="multipart/form-data" class="frm-main">
			<table class="tbl-30">
				<tr>
					<td class="t1">Title</td>
					<td><input type="text" name="title" placeholder="Title Of The Item"></td>
				</tr>
				<tr>
					<td class="t1">Description</td>
					<td><textarea name="description" cols="30" rows="5" placeholder="Description Of The Item"></textarea></td>
				</tr>
				<tr>
					<td class="t1">Price</td>
					<td><input type="decimal" name="price"></td>
				</tr>
				<tr>
					<td class="t1">Select Image</td>
					<td><input type="file" name="image"></td>
				</tr>
				<tr>
					<td class="t1">Category:</td>
					<td><select name="category">
						<?php
						
						//Create SQL to get all active categories from database
						$sql="SELECT * FROM tbl_category WHERE active='Yes'";

						$res=mysqli_query($conn,$sql);
						//Check the number of rows to check if data if available or not
						$count=mysqli_num_rows($res);
						if($count>0)
						{
							//We have categories
							while($rows=mysqli_fetch_assoc($res))
							{
								//Get the details of the category
								$id=$rows['id'];
								$title=$rows['title'];
								?>
								<option value="<?php echo $id ;?>"><?php echo $title ;?></option>
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
					<td><input type="radio" name="featured" value="Yes"> Yes
						<input type="radio" name="featured" value="No"> No</td>
				</tr>
				<tr>
					<td class="t1">Active</td>
					<td><input type="radio" name="active" value="Yes"> Yes
						<input type="radio" name="active" value="No"> No</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="send" value="Add Item" class="btn-secondary-a">
					</td>
				</tr>
			</table>
		</form>
		<?php
		//Check whether the button is clicked or not
		if(isset($_POST['send']))
		{
			//Add food in database
			//Get data from form
			$title=$_POST['title'];
			$description=$_POST['description'];
			$price=$_POST['price'];
			$category=$_POST['category'];
			//Check whether radio button is checked or not
			if(isset($_POST['featured']))
			{
				$featured=$_POST['featured'];
			}else
			{
				$featured="No";
			}
			if(isset($_POST['active']))
			{
				$active=$_POST['active'];
			}else
			{
				$active="No";
			}
			//Upload the image if selected
			if (isset($_FILES['image']['name']))
			{
					//Get the details of the selected image
					$image_name=$_FILES['image']['name'];
					//Check whether image is selected or not, upload only if image is selected
					if($image_name!="")
					{
						//Image is selected
						//Rename the image
						//Get the extension of the image
						$ext=end(explode('.',$image_name));
						//Rename the image
						$image_name="Item-".rand(000,999).'.'.$ext;


						$src=$_FILES['image']['tmp_name'];
						$dest="../images/items/".$image_name;
						//Finaly upload the image
						$upload=move_uploaded_file($src,$dest);
						//Check if the image is uploaded or not
						//If the image is not uploaded then we we stop the process with error message
						if($upload==FALSE)
						{
							$_SESSION['img-upload']="<div class='error'>Failed To Upload Image.</div>";
							header("location:".SITEURL.'admin/add-items.php');
							die();
						//Upload the image
						}
					}

			}else
				{
					$image_name="";
				}
				//Insert into database
				//Create sql to insert data into database
				$sql2= "INSERT INTO tbl_grocery SET 
				title= '$title', 
				description='$description', 
				price=$price, 
				image_name='$image_name', 
				category_id=$category, 
				featured='$featured', 
				active='$active'
				";
				//Execute Query
				$res2=mysqli_query($conn,$sql2);
				//Redirect to manage butchery with message
				if($res2==true)
				{
				$_SESSION['add-items']="<div class='success'>Item Added Succesfully.</div>";
				header("location:".SITEURL.'admin/manage.groceries.php');
				}else
				{
					$_SESSION['add-items']="<div class='error'>Failed To Add Item.</div>";
				header("location:".SITEURL.'admin/manage.groceries.php');

				}
		}

		?>

		<br>
		<br>
	</div>
	
</div>
<?php include('partials/footer.php');?>