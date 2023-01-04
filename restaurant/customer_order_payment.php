<?php
	require_once("connection.php");
	$id=$_GET["id"];	
	$orderpayment=seecustomertableorderpayment($id);
	extract($orderpayment);
?>
<!DOCTYPE html>
<html>
<head>
	<title>ACTION</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="col-lg-12" style="height: 100%">
		<div class="col-lg-12">
			<?php echo "&nbsp&nbsp&nbsp" ?>
		</div>
		<div class="col-lg-12 btn-group">
			<button class="btn btn-secondary btn-sm" onclick="goBack()">Go Back</button>
			<button class="btn btn-secondary btn-sm" onclick=" relocate_home()">Main</button>
		</div>
		<div class="col-lg-12">
			<?php echo "&nbsp&nbsp&nbsp" ?>
		</div>
		<div class="col-lg-12">
			<form method="post">
				<?php foreach ($orderpayment as $ord){ ?>
					<a href="orderform.php?id=<?php echo $ord["order_id"]; ?>"><button style="padding: 250px;" type="button" class="btn btn-success rounded-0 col-lg-6"><h1>ORDER</h1></button></a>
				<?php } foreach ($orderpayment as $pay){ ?>
					<a href="paymentform.php?id=<?php echo $ord["order_id"]; ?>"><button style="padding: 250px;" type="button" class="btn btn-primary rounded-0 col-lg-6"><h1>BILL</h1></button></a>
				<?php } ?>
			</form>
		</div>
	</div>
</body>
</html>
<script>
function goBack() {
	location.href = "customer_table.php";
}
</script>
<script>
function relocate_home(){
	location.href = "main.php";
} 
</script>