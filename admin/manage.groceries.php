<?php include ('partials/menu.php');?>
<style type="text/css">

.tbl_full{
	width: 100%;
	border-spacing: 0 18px;
}
table tr th{
	border-bottom: 2px solid black;
	border-left: 1px solid black;
	border-right: 1px solid black;
	padding: 1px;
	background-color: rgb(171, 222, 185);
	text-align: left;
}
table tr td{
	padding: 1px;
	
}
img{
	border-radius: 10px;
}
.wrapper{
	width: 95%;
	padding: 1%;
	margin: 0 auto;
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
				<h3>Manage Grocery</h3>
				<br>
				<br>
				<?php 
					if(isset($_SESSION['add-items']))
							{
								echo $_SESSION['add-items'];// Displaying session message
								unset($_SESSION['add-items']);//Removing session message
							}
							if(isset($_SESSION['remove']))
					{
					echo $_SESSION['remove'];// Displaying session message
					unset($_SESSION['remove']);//Removing session message
					}
					if(isset($_SESSION['delete']))
					{
					echo $_SESSION['delete'];// Displaying session message
					unset($_SESSION['delete']);//Removing session message
					}
					if(isset($_SESSION['no-item']))
					{
					echo $_SESSION['no-item'];// Displaying session message
					unset($_SESSION['no-item']);//Removing session message
					}
					if(isset($_SESSION['up-item']))
					{
					echo $_SESSION['up-item'];// Displaying session message
					unset($_SESSION['up-item']);//Removing session message
					}
					if(isset($_SESSION['fail-remove-img']))
					{
					echo $_SESSION['fail-remove-img'];// Displaying session message
					unset($_SESSION['fail-remove-img']);//Removing session message
					}		
					?>
					<br><br>
				<a href="<?php echo SITEURL;?>admin/add-items.php" class="btn-primary" style="text-decoration: none; color: rgb(196, 219, 228);">Add Item</a>
				<br>
				<br>
				<br>

				<table class="tbl_full">
					<tr>
						<th>Serial No.</th>
						<th>Title</th>
						<th>Price</th>
						<th>Image</th>
						<th>Featured</th>
						<th>Active</th>
						<th>Actions</th>
					</tr>
					<?php
						$sql="SELECT * FROM tbl_grocery";
						$res=mysqli_query($conn,$sql);
						$count=mysqli_num_rows($res);
						//Create serial number variable
						$sn=1;

						if($count>0)
						{
							//We have data in the database
							//Get the data and display it in table
							while($row =mysqli_fetch_assoc($res)){
								$id=$row['id'];
								$title=$row['title'];
								$price=$row['price'];
								$image_name=$row['image_name'];
								$featured=$row['featured'];
								$active=$row['active'];
								?>
								<tr>
						<td><?php echo $sn++;?></td>
						<td><?php echo $title;?></td>
						<td><?php echo "$ ".$price;?></td>

						<td><?php
						//Check whether image name is available or not
						if($image_name!="")
							{
								//Display the image
								?>
								<img src="<?php echo SITEURL;?>images/items/<?php echo $image_name;?>" width=" 150px">
								<?php
							} else
						{
							//Display the message
							echo "<div class='error'>Image Not Added.</div>";

						}
						 ?></td>

						<td><?php echo $featured; ?></td>
						<td><?php echo $active; ?></td>

						<td><a href="<?php echo SITEURL;?>admin/update-items.php?id=<?php echo $id;?>" class="btn-secondary">Update Item</a>
						<a href="<?php echo SITEURL;?>admin/delete-items.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-secondary-1">Delete Item</a></td>
					</tr>

								<?php
							}

						}else
						{
						//We do not have data
						//We will display the data inside the table
							?>
							<tr>
								<td colspan="6"><div class="error">No Grocery Added.</div></td>
							</tr>
							<?php
						}

					?>
					
				</table>
			</div>
		</div>
	<!--Main Content Section Ends-->

<?php include ('partials/footer.php');?>