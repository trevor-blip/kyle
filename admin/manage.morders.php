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
	border-bottom: 1px solid black;
	border-left: 1px solid black;
	
}
.wrapper{
	width: 98%;
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
}
</style>
		<!--Main Content Section Starts-->
		<div class="main-content">
			<div class="wrapper">
				<h3>Manage Orders</h3>
				<br>
				<br>
				<table class="tbl_full">
					<tr>
						<th>S.N</th>
						<th>Meat</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total</th>
						<th>Order Date</th>
						<th>Status</th>
						<th>Customer Name</th>
						<th>Customer Contact</th>
						<th>Customer Email</th>
						<th>Customer Home Address</th>
						<th>Actions</th>
					</tr>
					<?php
					//Get all the orders from the database
					$sql="SELECT * FROM tbl_order ORDER BY id DESC";
					//Execute the query
					$res=mysqli_query($conn,$sql);
					//Count rows
					$count=mysqli_num_rows($res);
					$sn=1;//serial number
					if($count>0)
					{
						//Order available
						while($row=mysqli_fetch_assoc($res))
						{
							//Get all the order details
							$id=$row['id'];
							$item=$row['meat'];
							$price=$row['price'];
							$quantity=$row['qty'];
							$total=$row['total'];
							$order_date=$row['order_date'];
							$status=$row['status'];
					 		$customer_name=$row['customer_name'];
							$customer_contact=$row['customer_contact'];
							$customer_email=$row['customer_email'];
							$customer_address=$row['customer_address'];
							?>
							<tr style="font-size: 0.8rem;">
							<td><?php echo $sn++;?></td>
							<td><?php echo $item;?></td>
							<td><?php echo "$".$price;?></td>
							<td><?php echo $quantity;?></td>
							<td><?php echo "$".$total;?></td>
							<td><?php echo $order_date;?></td>
							<td><?php echo $status;?></td>
							<td><?php echo $customer_name;?></td>
							<td><?php echo $customer_contact;?></td>
							<td><?php echo $customer_email;?></td>
							<td><?php echo $customer_address;?></td>
							<td><a href="<?php echo SITEURL;?>admin/update-orders.php" class="btn-secondary">Update Order</a>
							</td>
						</tr>
							<?php
						}
					}else
					{
						//Oreder not available
						echo "<tr><td colspan='12' class='error'>Orders Not Available</td></tr>";
					}

					?>
				</table>
			</div>
		</div>
	<!--Main Content Section Ends-->

<?php include ('partials/footer.php');?>