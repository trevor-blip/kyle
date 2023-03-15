<?php include ('partials/menu.php');?>
<style type="text/css">

	.success{

	color: #4cd137;
	font-weight: bold;
	background: transparent;
	display:inline-block;
    text-align:center;
    padding: 2px;
	}
	.error{
	color: #e74c3c;
	font-weight: bold;
	background: transparent;
	display:inline-block;
    text-align:center;
    padding: 2px;
    width: 100%;
	}
</style>
		<!--Main Content Section Starts-->
		<div class="main-content">
			<div class="wrapper">
				<h3>DASHBOARD</h3>
				<br>
				<?php
					if(isset($_SESSION['login']))
						{
						echo $_SESSION['login'];// Displaying session message
						unset($_SESSION['login']);//Removing session message
						}
				?>
				<br>

				<div class="col-4">
					<h1>3</h1>
					<br>
					Categories
				</div>
				<div class="col-4">
					<h1>3</h1>
					<br>
					Categories
				</div>
				<div class="col-4">
					<h1>3</h1>
					<br>
					Categories
				</div>
				<div class="col-4">
					<h1>3</h1>
					<br>
					Categories
				</div>
				<div class="clearfix"></div>

			</div>
		</div>
<?php include ('partials/footer.php');?>	