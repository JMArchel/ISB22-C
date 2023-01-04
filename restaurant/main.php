<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>




<!DOCTYPE html>

<html lang="en">
<head>
	<title>LUCHSHIY DELICATES</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  
</head>
<body>
	<header style="height: 100vh;">
		<div class="col-lg-12">
			<?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br>
		</div>
		<div class="col-lg-12">
			<div class="col-lg-1"><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br></div>
			<div class="col-lg-10 btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
				<div class="dropdown col-lg-12">
					<button class="btn btn-primary dropdown-toggle col-lg-4" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Maintenance List</button>
					<div class="dropdown-menu dropdown-menu-wide" aria-labelledby="dropdownMenu2">
						<a href="employee_index.php"><button type="button" class="dropdown-item">Employee</button></a>
						<a href="table_index.php"><button type="button" class="dropdown-item">Table</button></a>
						<a href="menu_index.php"><button type="button" class="dropdown-item">Menu</button></a>
						<a href="job_index.php"><button type="button" class="dropdown-item">Job</button></a>
						<a href="customer_index.php"><button type="button" class="dropdown-item">Customer</button></a>
					</div>
					<a href="customer_table.php"><button type="button" class="btn btn-primary col-lg-2">Customer Table</button></a>
					<a href="sales_page.php"><button type="button" class="btn btn-primary col-lg-2">Total Sales</button></a>
					<a href="table_waiting_list.php"><button type="button" class="btn btn-primary col-lg-2">Waiting List</button></a>
					<a href="customer_reservation_employee.php"><button type="button" class="btn btn-primary col-lg-2">Add Reservation</button></a>
				</div>
			</div>
			<div class="col-lg-1">
			</div>
		</div>
		<div class="col-lg-12">
			<?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br>
		</div>
		<div class="col-lg-12">
			<div class="col-lg-3">
	    		<?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br>
			</div>
			<div class="col-lg-6 text-white">
				<center>
				<h1 class="display-1">L U C H S H I Y</h1>
				<h2 class="display-2">D E L I C A T E S</h2>
				<div class="col-lg-12">
	    			<?php echo "&nbsp&nbsp&nbsp" ?><br>
				</div>
				<h5>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h5>
					<p>
						<a href="reset-password.php" class="btn btn-warning btn-sm col-lg-6">Reset Your Password</a>
						<a href="logout.php" class="btn btn-danger btn-sm col-lg-6">Sign Out of Your Account</a>
					</p>
				</center>
			</div>
			<div class="col-lg-3">
	    		<?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br>
			</div>
		</div>
	</header>
</body>
</html>
