<?php
	require_once("connection.php");		
	extract($_POST);
	$table=seetable();
	extract($table);

	if (isset($_POST['submitbtn']))
	{
		if(availabilitycheck($_POST['date'],$_POST['time'],$_POST['table_id'])==TRUE)
		{
			echo '<script type="text/javascript"> alert("The table you have selected has been reserved at the same time and date. Please choose another one and try again."); </script>';
		}
		else
		{
			addreservationcustomer($_POST['isonline'],
				$_POST['date'],
				$_POST['time'],
				$_POST['table_id'],
				$_POST['c_first_name'],
				$_POST['c_last_name'],
				$_POST['c_phone_num'],
				$_POST['c_address'],
				$_POST['c_birthday']);
		}
	}
?>

<html>
<head>
	<title>RESERVATION</title>
	<title>CUSTOMER LIST</title>
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
		<div class="container">
		<form  method="post">
			<div class="col-lg-2">
				<?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?>
			</div>
			<dir class="col-lg-8 background">
				<div class="col-lg-12">
					<?php echo "&nbsp&nbsp&nbsp" ?>
				</div>
				<div class="col-lg-12 btn-group">
					<button class="btn btn-secondary btn-sm" onclick="goBack()">Go Back</button>
				</div>
				<div class="col-lg-12"><center><h3>RESERVATION<h3></center></div>
				<div class="col-lg-12"><center><h4>Reserve Details<h4></center></div>
				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<input type="hidden" name="isonline" id="isonline" value="1">
						<label for="date" >Date</label>
						<input class="form-control" type="date" name="date" id="date" min='<?php echo date("Y-m-d",strtotime('2 days'));?>' max='<?php echo date("Y-m-d",strtotime('2 months'));?>' required="required">
					</div>
					<div class="form-group col-lg-6">
						<label for="time">Time</label>
						<select class="form-control" id="time" name="time" required="required">
							<option class="c" value="" disabled selected hidden>Select Time</option>
							<option disabled>-LUNCH-</option>
							<option disabled></option>
							<option value="10:00:00">10:00 AM</option>
							<option value="11:00:00">11:00 AM</option>
							<option value="12:00:00">12:00 PM</option>
							<option value="13:00:00">01:00 PM</option>
							<option disabled></option>
							<option disabled>-DINNER-</option>
							<option disabled></option>
							<option value="17:00:00">05:00 PM</option>
							<option value="18:00:00">06:00 PM</option>
							<option value="19:00:00">07:00 PM</option>
							<option value="20:00:00">08:00 PM</option>
						</select>
					</div>		
				</div>
				<div class="col-lg-12">
					<div class="form-group toolbar "><center>
						<div>
							<?php foreach ($table as $tables) { ?>
								<input class="form-control" type="radio" id="table_id<?php echo $tables['table_id']; ?>" name="table_id" value="<?php echo $tables['table_id']; ?>" onclick="check()" required>
								<label for="table_id<?php echo $tables['table_id']; ?>">Table <?php echo $tables['table_id']; ?><br>(For <?php echo $tables['max_capacity']; ?> max)</label>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="col-lg-12"><center><h4>Contact Details<h4></center></div>
				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<label for="c_first_name" >First Name</label><br>
						<input class="form-control" type="text" name="c_first_name" id="c_first_name" required="required" placeholder="Enter First Name">
					</div>
					<div class="form-group col-lg-6">
						<label for="c_last_name" >Last Name</label><br>
						<input class="form-control" type="text" name="c_last_name" id="c_last_name" required="required" placeholder="Enter Last Name">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<label for="c_address" >Email Address</label><br>
						<input class="form-control" type="Email" name="c_address" id="c_address" required="required" placeholder="Enter Email">
					</div>
					<div class="form-group col-lg-6">
						<label for="c_phone_num" >Contact Number</label><br>
						<input class="form-control" type="text" name="c_phone_num" id="c_phone_num" required="required" placeholder="Enter Phone Number">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<label for="c_birthday" >Birthday</label><br>
						<input class="form-control" type="date" name="c_birthday" id="c_birthday" max='<?php echo date("Y-m-d");?>' required="required">
					</div>
				</div>
				<div>
					<button value="Submit" name="submitbtn" class="btn btn-primary col-lg-12">Book a Reservation</button>
				</div>
				<div class="col-lg-2">
				<?php echo "&nbsp&nbsp&nbsp" ?><br>
				</div>
			</div>
		</form>
	</header>
</body>
</html>
<script>
function goBack(){
	location.href = "cover.php";
} 
</script>