<?php 
include "connection.php";
$id=$_GET["id"];

$e_first_name="";
$e_last_name="";
$e_address="";
$e_phone_num="";
$e_birthday="";
$schedule="";
$job_id="";
$hire_date="";
$full_part_time="";
$password="";

$res=mysqli_query ($connection,"SELECT * FROM `employee` WHERE `employee_id`=$id");
while ($row=mysqli_fetch_array($res))
{
  $e_first_name=$row['e_first_name'];
  $e_last_name=$row['e_last_name'];
  $e_address=$row['e_address'];
  $e_phone_num=$row['e_phone_num'];
  $e_birthday=$row['e_birthday'];
  $schedule=$row['schedule'];
  $job_id=$row['job_id'];
  $hire_date=$row['hire_date'];
  $full_part_time=$row['full_part_time'];
  //print_r($row);
}

$choosen = seejob1 ($id);
$change = seejob2 ($id);
extract($choosen);
extract ($change);
?>

<html lang="en">
<head>
  <title>EMPLOYEE EDIT</title>
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
		<div class="container background" style="height: 100%">
			<div class="col-lg-12">
				<?php echo "&nbsp&nbsp&nbsp" ?>
			</div>
			<div class="col-lg-12 btn-group">
				<button class="btn btn-secondary btn-sm" onclick="goBack()">Go Back</button>
				<button class="btn btn-secondary btn-sm" onclick=" relocate_home()">Main</button>
			</div>
			<div class="col-lg-12"><h2>Employee Information</h2></div>
			<div class="col-lg-12">
				<form action="" name="form1" method="post">
					<div class="col-lg-12">
						<div class="form-group col-lg-4">
							<label for="e_first_name">First Name</label>
							<input type="text" class="form-control" id="e_first_name" placeholder="Enter firstname" name="e_first_name" value="<?php echo $e_first_name ?>">
						</div>
						<div class="form-group col-lg-4">
							<label for="e_last_name">Last Name</label>
							<input type="text" class="form-control" id="e_last_name" placeholder="Enter lastname" name="e_last_name" value="<?php echo $e_last_name?>">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group col-lg-8">
							<label for="e_address">Email</label>
							<input type="email" class="form-control" id="e_address" placeholder="Enter email" name="e_address" value="<?php echo $e_address ?>">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group col-lg-4">
							<label for="e_phone_num">Contact</label>
							<input type="text" class="form-control" id="e_phone_num" placeholder="Enter contact" name="e_phone_num" value="<?php echo $e_phone_num ?>">
						</div>
						<div class="form-group col-lg-4">
							<label for="e_birthday">Birthday</label>
							<input type="date" class="form-control" id="e_birthday" name="e_birthday" max='<?php echo date("Y-m-d",);?>' required="required" value="<?php echo $e_birthday ?>">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group col-lg-4">
							<label for="job_id">Job</label><br>
							<select class="form-control" name="job_id">
							<option value="<?php echo $choosen['job_id'];?>"><?php echo $choosen['title'];?></option>;
					  			<?php
					  			foreach ($change as $chan)
					  			{
					  			?>
									<option value="<?php echo $chan['job_id']; ?>"><?php echo $chan['title']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-lg-4">
							<label for="hire_date">Hire Date</label>
							<input type="date" class="form-control" id="hire_date" max='<?php echo date("Y-m-d",);?>' required="required" placeholder="When were you hired?" name="hire_date" value="<?php echo $hire_date ?>">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group form-check col-lg-4">
							<label>Employment Status</label><br>
							<?php 
							$isselected='checked="checked"';
							{ ?>
								<input type="radio" value="FULL" <?php echo $full_part_time=="FULL"? $isselected:""; ?> id="full_part_time" name="full_part_time">
								<label for="full_part_time" >FULL TIME</label><br>
								<input type="radio" value="PART" <?php echo $full_part_time=="PART"? $isselected:""; ?> id="full_part_time" name="full_part_time">
								<label for="full_part_time">PART TIME</label>
							<?php
							}
							?>
						</div>
						<div class="form-group form-check col-lg-4">
							<label>Schedule</label><br>
							<?php
							$isselected='checked="checked"';
							?>
							<input type="radio" value="LUNCH" <?php echo $schedule=="LUNCH"? $isselected:""; ?> id="schedule1" name="schedule">
							<label for="schedule1">LUNCH</label><br>
							<input type="radio" value="DINNER" <?php echo $schedule=="DINNER"? $isselected:""; ?> id="schedule2" name="schedule" value="<?php echo $schedule ?>">
							<label for="schedule2">DINNER</label>
						</div>
					</div>
					<div class="col-lg-8">
						<button type="submit" name="update" class="btn btn-primary col-lg-3">Update</button>
					</div>
				</form>
			</div>
		</div>
	</header>
</body>
</html>

<?php 
if (isset($_POST["update"]))
{
	mysqli_query($connection, "update `employee` SET e_first_name='$_POST[e_first_name]', e_last_name='$_POST[e_last_name]', e_address='$_POST[e_address]', e_phone_num='$_POST[e_phone_num]', e_birthday='$_POST[e_birthday]', schedule='$_POST[schedule]', job_id='$_POST[job_id]', hire_date='$_POST[hire_date]', full_part_time='$_POST[full_part_time]' where employee_id=$id");
?>
  <script type="text/javascript">
  window.location="employee_index.php";
  </script>
  <?php  
} ?>
<script>
function goBack() {
  window.history.back();
}
</script>
<script>
function relocate_home(){
	location.href = "main.php";
} 
</script>