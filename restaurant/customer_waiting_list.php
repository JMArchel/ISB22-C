<?php
	require_once("connection.php");
	$id=$_GET["id"];	
	$list=tablecall($id);
	extract($list);

	if(isset($_POST['cancelbutton']))
	{
		cancelreservation($_POST['cancelbutton']);
	}
	if(isset($_POST['movetotable']))
	{
		tablereserved($_POST['movetotable']);
	}
?>

<html>
<head>
	<title>Waiting Customer</title>
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
			<div class="col-lg-12">
				<form  method="post">
					<div><h2>Customer Waiting List for Table <?php echo $id; ?></h2></div>
					<div>
						<table class="table">
							<thead class="thead-dark text-center">
								<tr>
									<th scope="col">#</th>
									<th scope="col">Name</th>
									<th scope="col">Phone Number</th>
									<th scope="col">Email Address</th>
									<th scope="col">Date</th>
									<th scope="col">Time</th>
									<th scope="col">Move to table</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($list as $lists){
								echo "<tr>";
									echo "<td>"; echo $lists["reservation_id"];  echo "</td>";
									echo "<td>"; echo $lists["c_first_name"]; echo " ";echo $lists["c_last_name"];  echo "</td>";
									echo "<td>"; echo $lists["c_phone_num"];  echo "</td>";
									echo "<td>"; echo $lists["c_address"];  echo "</td>";
									echo "<td>"; echo substr($lists["date_time"], 0, 11);  echo "</td>";
									echo "<td>"; echo substr($lists["date_time"], 11, 20);  echo "</td>";
									echo "<td>"; ?><button type="submit" class="btn btn-primary rounded-7 col-lg-12" value="<?php echo $lists['reservation_id'];?>,<?php echo $lists['customer_id'];?>,<?php echo $lists['table_id'];?>" name="movetotable">MOVE TO TABLE</button> <?php echo "</td>"; 
									echo "<td>"; ?><button type="submit" class="btn btn-danger rounded-7 col-lg-12" value="<?php echo $lists['reservation_id'];?>" name="cancelbutton" onClick='return confirm("Are you sure you want to delete?");'>DELETE</button><?php echo "</td>";
								echo "</tr>";} ?>
							</tbody>
						</table>
					</div>
				</form>
			</div>
		</div>
	</header>
</body>
</html>
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