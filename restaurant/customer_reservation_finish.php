<?php
	require_once("connection.php");
	if (isset($_POST['submitbtn']))
	{
		header('Location:'.' customer_reservation.php');
	}
	if (isset($_POST['submitbutton']))
	{
		header('Location:'.' cover.php');
	}
?>
<html>
<head>
	<title>RESERVATION</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<header>
		<form  method="post">
			<div class="container" style="height: 100%">
				<div class="col-lg-12"><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br></div>
				<div class="col-lg-3"><?php echo "&nbsp&nbsp&nbsp" ?></div>
				<div class="col-lg-6 background rounded">
					<div class="well-lg"><center><h3>RESERVATION</h3></center></div>
					<div class="alert alert-success"><center>Your Reservation has been made. Thank you for having us.</center></div>
					<div class="sub"><center>You will be contacted via email and mobile number to remind you of your reservation.</center></div>
					<div class="sub"><center>If you wish to Cancel or Move your reservation, contact the RESTAURANT NAME tel.no #(035)422-5882 or mobile num. 0916 647 9302</center></div>
					<div><center><button  value="Submit" name="submitbtn" class="btn btn-primary btn-block">Book another Reservation</button></center></div>
					<div class="col-lg-12"><?php echo "&nbsp&nbsp&nbsp" ?><?php echo "&nbsp&nbsp&nbsp" ?></div>
					<div><center><button  value="Submit" name="submitbutton" class="btn btn-primary btn-block">Back to Home Page</button></center></div>
					<div class="col-lg-12"><?php echo "&nbsp&nbsp&nbsp" ?><?php echo "&nbsp&nbsp&nbsp" ?></div>
				</div>
				<div class="col-lg-3"><?php echo "&nbsp&nbsp&nbsp" ?></div>
			</div>
		</form>
	</header>
</body>
</html>