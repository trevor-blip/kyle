<?php
include('../config/constants.php');
//Get admin ID to be deleted
$id=$_GET['id'];
//Create sql query to Delete admin
$sql="DELETE FROM tbl_admin WHERE id = $id";
//Execute Query
$res=mysqli_query($conn,$sql);
//check whether the query executed successfully
if($res==TRUE)
{
	//Query executed successfully admin Deleted
	$_SESSION['delete']= "<div class='success'>Admin Deleted Succesfully.</div>";
	header("location:".SITEURL.'admin/manage.admin.php');
}else
{
	$_SESSION['delete']= "<div class='error'>Failed To Delete Admin.</div>";
	header("location:".SITEURL.'admin/manage.admin.php');
}
//Redirect to Manage admin page with message(success/error)

?>