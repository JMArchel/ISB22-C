<?php 
	require_once("connection.php");
	$id=$_GET["id"];
	$products = customerorder($id);
	$ordercustomer= jointables($id);
	$menulist= seeMenu();
	extract ($products);
	extract ($ordercustomer);
	extract($menulist);
	$sql=mysqli_query($connection,"SELECT reservation.table_id FROM orders INNER JOIN reservation ON orders.customer_id=reservation.customer_id WHERE `order_id`=$id") or die(mysql_error());
	$row=mysqli_fetch_array($sql);
	$tableid=$row['table_id'];
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
				<?php echo "&nbsp&nbsp&nbsp" ?>
			</div>
			<div class="col-lg-12 btn-group">
				<button class="btn btn-secondary btn-sm" onclick="goBack(id)" id="<?php echo $tableid ?>">Go Back</button>
				<button class="btn btn-secondary btn-sm" onclick=" relocate_home()">Main</button>
			</div>
			<div class="col-lg-12">
				<center><h1> Order of Customer </h1></center>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-4">
					<h2> Additional </h2>
				</div>
			</div>
			<div class="col-lg-12">
				<form action="" name="form1" method="POST">
					<div class="col-lg-4">
						<div class="form-group col-lg-12">
							<label for="menu_id"> Menu </label>
							<select class="form-group form-control" name="menu_id" required="required">
								<option disabled selected hidden>Select...</option>
								<?php
									foreach ($menulist as $list) 
									{
									?>
										<option value="<?php echo $list['menu_id']; ?>, <?php echo $list['price']; ?>"><?php echo $list['name'] ?></option>
									<?php } ?>
							</select>
						</div>
						<div class="form-group col-lg-12">
							<label for="quantity"> Quantity </label>
							<input class="form-control" type="number" min="1" name="quantity" placeholder="How Many did the Customer Order?" required="required"> 
						</div>
					</div>
					<div class="col-lg-8">
						<div class="form-group col-lg-9">
							<label for="style"> Style </label>
							<textarea name="style" class="form-control" rows="3" id="style" required="required" placeholder="Customer's cooking preference"></textarea>
						</div>
						<div class="col-lg-12">
							<button type="submit" class="btn btn-primary col-lg-3" name="submitbtn">ADD</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-lg-12">
				<center><h3> Order List </h3></center>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-6">
					First Name: <?php echo $ordercustomer['c_first_name']; ?><br>
					Last Name: <?php echo $ordercustomer['c_last_name']; ?>
				</div>
				<div class="col-lg-6">
					Employee Name: <?php echo $ordercustomer['e_first_name']; ?> <?php echo $ordercustomer['e_last_name']; ?><br>
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
							<th scope="col">Style</th>
							<th scope="col" colspan="2">Action</th>
						</tr>
					</thead>
					<tbody>	
						<?php 
						foreach ($products as $pros)
						{ ?><tr>
							<td><?php echo $pros['name']; ?></td>
							<td><?php echo $pros['price']; ?></td>
							<td><?php echo $pros['quantity']; ?></td>
							<td><?php echo $pros['style']; ?></td>
							<td><a href="order_edit.php?id=<?php echo $pros["order_detail_id"]; ?>"><button type="button" class="btn btn-success col-lg-12">Edit</button></a></td>
							<td><a href="order_delete.php?id=<?php echo $pros["order_detail_id"]; ?>" onClick='return confirm("Are you sure you want to delete?");'><button type="button" class="btn btn-danger col-lg-12">Delete</button></a></td></tr>
						<?php } ?>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</center>
</header>
</body>

<?php 
if (isset($_POST['submitbtn']))
	{
		addorder($id,
		$_POST['menu_id'],
		$_POST['quantity'],
		$_POST['style']);
	}
?>
</html>
<script>
function goBack(id) {
  location.href = "customer_order_payment.php?id="+id;
}
</script>
<script>
function relocate_home(){
	location.href = "main.php";
} 
</script>
