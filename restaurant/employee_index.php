<?php 
include "connection.php";
mysqli_select_db($connection, 'pagination');
$results_per_page = 8;
$sql='SELECT * FROM employee';
$result = mysqli_query($connection, $sql);
$number_of_results = mysqli_num_rows($result);
$number_of_pages = ceil($number_of_results/$results_per_page);
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}
$this_page_first_result = ($page-1)*$results_per_page;
$output = seejob ();
?>


<html lang="en">
<head>
	<title>EMPLOYEE LIST</title>
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
	<div class="container background">
		<div class="col-lg-12">
			<?php echo "&nbsp&nbsp&nbsp" ?>
		</div>
		<div class="col-lg-12">
			<button class="btn btn-secondary btn-sm" onclick=" relocate_home()">Main</button>
		</div>
		<div class="col-lg-12"><h2>Employee Information</h2></div>
		<div class="col-lg-12">
			<form action="" name="form1" method="post">
				<div class="col-lg-12">
					<div class="form-group col-lg-4">
						<label for="e_first_name">First Name</label>
						<input type="text" class="form-control" id="e_first_name" placeholder="Enter firstname" name="e_first_name">
					</div>
					<div class="form-group col-lg-4">
						<label for="e_last_name">Last Name</label>
						<input type="text" class="form-control" id="e_last_name" placeholder="Enter lastname" name="e_last_name">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-8">
						<label for="e_address">Email</label>
						<input type="Email" class="form-control" id="e_address" placeholder="Enter email" name="e_address">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-4">
						<label for="e_phone_num">Contact</label>
						<input type="text" class="form-control" id="e_phone_num" placeholder="Enter contact" name="e_phone_num">
					</div>
					<div class="form-group col-lg-4">
						<label for="e_birthday">Birthday</label>
						<input type="date" class="form-control" id="e_birthday" name="e_birthday" max='<?php echo date("Y-m-d",);?>' required="required">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-4">
						<label for="job_id">Job</label><br>
						<select class="form-group form-control" name="job_id">
							<option hidden>Select...</option>
							<?php
								foreach ($output as $rows) 
								{
								?>
									<option value="<?php echo $rows['job_id']; ?>"><?php echo $rows['title']; ?></option>
								<?php } ?>
						</select>
					</div>
					<div class="form-group col-lg-4">
						<label for="hire_date">Hire Date</label>
						<input type="date" class="form-control" id="hire_date" placeholder="When were you hired?" name="hire_date" max='<?php echo date("Y-m-d",);?>' required="required">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group form-check col-lg-3">
						<label>Employment Status</label><br>
						<input type="radio" value="FULL" id="full_part_time1" name="full_part_time">
						<label class="form-check-label" for="full_part_time1">Full Time</label><br>
						<input type="radio" value="PART" id="full_part_time2" name="full_part_time">
						<label class="form-check-label" for="full_part_time2">Part Time</label>
					</div>
					<div class="form-group form-check col-lg-4">
						<label>Schedule</label><br>
						<input value="LUNCH" type="radio" id="schedule1" name="schedule">
						<label class="form-check-label" for="schedule1">Lunch</label><br>
						<input value="DINNER" type="radio" id="schedule2" name="schedule">
						<label class="form-check-label" for="schedule2">Dinner</label>
					</div>
				</div>
				<div class="col-lg-8">
					<button type="submit" name="insert" class="btn btn-primary col-lg-3">Insert</button><br>
				</div>
			</form>
		</div>
		<div class="col-lg-12">
			<center>
				<?php
				for ($page=1;$page<=$number_of_pages;$page++)
				{?>
					<a href="employee_index.php?page=<?php echo $page; ?>"><button type="button" class="btn btn-info"><?php echo $page; ?></button></a>
				<?php } ?>
			</center>
		</div>
		<div class="col-lg-12"><center><h3>Employee List</h3></center></div>
		<div class="col-lg-12 tab">
			<table class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>#</th>
						<th scope="col">Firstname</th>
						<th scope="col">Lastname</th>
						<th scope="col">Email</th>
						<th scope="col">Contact</th>
						<th scope="col">Birthday</th>
						<th scope="col">Schedule</th>
						<th scope="col">Job</th>
						<th scope="col">Employeed</th>
						<th scope="col">Status</th>
						<th scope="col" colspan="2"> Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$res=mysqli_query($connection,"select employee.employee_id, employee.e_first_name, employee.e_last_name, employee.e_phone_num, employee.e_address, employee.e_birthday, employee.schedule, job.title, employee.hire_date, employee.full_part_time FROM employee INNER JOIN job ON employee.job_id=job.job_id LIMIT $this_page_first_result ,$results_per_page;");
					while ($row=mysqli_fetch_array($res))
					{
					echo "<tr>";
					echo "<td>"; echo $row["employee_id"];  echo "</td>";
					echo "<td>"; echo $row["e_first_name"];  echo "</td>";
					echo "<td>"; echo $row["e_last_name"];  echo "</td>";
					echo "<td>"; echo $row["e_address"];  echo "</td>";
					echo "<td>"; echo $row["e_phone_num"];  echo "</td>";
					echo "<td>"; echo $row["e_birthday"];  echo "</td>";
					echo "<td>"; echo $row["schedule"];  echo "</td>";
					echo "<td>"; echo $row["title"];  echo "</td>";
					echo "<td>"; echo $row["hire_date"];  echo "</td>";
					echo "<td>"; echo $row["full_part_time"];  echo "</td>";
					echo "<td>"; ?> <a href="employee_edit.php?id=<?php echo $row["employee_id"]; ?>"><button type="button" class="btn btn-success">Edit</button></a> <?php  echo "</td>"; 
					echo "<td>"; ?> <a href="employee_delete.php?id=<?php echo $row["employee_id"]; ?>" onClick='return confirm("Are you sure you want to delete?");'><button type="button" class="btn btn-danger">Delete</button></a> <?php  echo "</td>";
					echo "</tr>";
					}
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
	</header>
</body>
</html>

<?php 
if (isset($_POST["insert"]))
{
  insertemployee ($_POST['e_first_name'],
    $_POST['e_last_name'],
    $_POST['e_phone_num'],
    $_POST['e_address'],
    $_POST['e_birthday'],
    $_POST['schedule'],
    $_POST['job_id'],
    $_POST['hire_date'],
    $_POST['full_part_time']);
}
?>
</html>
<script>
function relocate_home(){
	location.href = "main.php";
} 
</script>
