<?php
	require_once("connection.php");
	$id=$_GET["id"];
	$payment=customerorder($id);
	$ordercustomer= customertable($id);
	extract($payment);
	extract($ordercustomer);
	$sql=mysqli_query($connection,"SELECT `total_price` FROM `orders` WHERE `order_id`=$id");
	$row=mysqli_fetch_array($sql);
	$totalbill=$row['total_price'];
?>
<html lang="en">
<head>
	<title>ORDER OF CUSTOMER</title>
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
				<center><h3> Order List </h3></center>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-6">
					First Name: <?php echo $ordercustomer['c_first_name']; ?><br>
					Last Name: <?php echo $ordercustomer['c_last_name']; ?>
				</div>
				<div class="col-lg-6">
					Employee Name: <?php echo $ordercustomer['payment_id']; ?><br>
					Table <?php echo $ordercustomer['table_id']; ?>
				</div>
			</div>
			<div class="col-lg-12">
				<table class="table table-bordered col-lg-12">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Menu Name</th>
							<th scope="col">Price</th>
							<th scope="col">Quantity</th>
							<th scope="col">Total Price</th>
						</tr>
					</thead>
					<tbody>	
						<?php 
						foreach ($payment as $pros)
						{ ?><tr>
							<td><?php echo $pros['name']; ?></td>
							<td><?php echo $pros['price']; ?></td>
							<td><?php echo $pros['quantity']; ?></td>
							<td><?php echo $pros['total_price']; ?></td>
						<?php } ?>
						</tr>
						<tr>
							<td colspan="4"></td>
						</tr>
						<tr>
							<td colspan="3"><h4><strong>Total Payment</strong><h4></td>
							<td><h4><strong><?php echo $totalbill ?></strong></h4></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-lg-12">
				<form action="" name="form1" method="POST">
					<div class="col-lg-7">
						<div class="form-group form-check">
							<input type="radio" id="method1" name="method" value="CASH" required>
							<label class="form-check-label" for="method1">CASH</label>
							<input type="radio" id="method2" name="method" value="CARD">
							<label class="form-check-label" for="method2">CARD</label>
						</div>
					</div>
					<div class="col-lg-5">
						<button type="submit" class="btn btn-primary col-lg-10" name="submitbtn">Click to Pay</button>
					</div>
				</form>
			</div>
		</div>
	</center>
</header>
</body>
<?php 
if (isset($_POST['submitbtn']))
	{
		payment($id,
		$_POST['method']);
	}
?>
</html>