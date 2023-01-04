<?php
	require_once("connection.php");
	$sales=sales();
	$salestotal=salestotal();
	extract($sales);
	extract($salestotal);

	$totalsales=0;
	foreach ($salestotal as $pro)
	{ 
		$totalsales=$totalsales+$pro['total_price']; 
	}

?>
<html lang="en">
<head>
	<title>MENU LIST</title>
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
				<button class="btn btn-secondary btn-sm" onclick="goBack()">Go Back</button>
			</div>
			<div class="col=lg-12">
				<center><h2> Sales </h2></center>
			</div>
			<div class="col-lg-12 table-wrapper-scroll-y my-custom-scrollbar">
				<table class="table table-bordered">
					<thead class="thead-dark">
						<tr>
							<th scope="col"><center>#</center></th>
							<th scope="col"><center>Order ID</center></th>
							<th scope="col"><center>Method</center></th>
							<th scope="col"><center>Total Price</center></th>
						</tr>
					</thead>
					<tbody>	
						<?php 
						foreach ($sales as $pros)
						{ ?>
						<tr>
							<td><center><?php echo $pros['payment_id']; ?></center></td>
							<td><center><?php echo $pros['order_id']; ?></center></td>
							<td><center><?php echo $pros['method']; ?></center></td>
							<td><center><?php echo $pros['total_price']; ?></center></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<div class="col-lg-12">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td colspan="3"><h4><strong>Total Sales</strong><h4></td>
							<td><h4><strong><center><?php echo $totalsales ?></center></strong></h4></td>
						</tr>
					</tbody>
				</table>
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