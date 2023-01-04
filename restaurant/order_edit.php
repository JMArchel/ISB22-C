<?php 
		require_once("connection.php");
		//print_r($_POST); 

		$id=$_GET['id'];

		$orderinfo=seeorder($id);
		$menucheck=menucheck($orderinfo['menu_id']);
		$menu_id=$menucheck['menu_id'];
		$price=$menucheck['price'];

		extract($orderinfo);
		if (isset($_POST['submitbtn']))
		{
			editorder($id,
			$menu_id,
			$price,
			$_POST['quantity'],
			$_POST['style']);
		}

 ?>

<!DOCTYPE html>
 <html>
 <head>
 <center>
 	<title> Order Details </title>
 	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 </head>
 <body>
 	<div class="container">
 		<div class="col-lg-12">
			<?php echo "&nbsp&nbsp&nbsp" ?>
		</div>
		<div class="col-lg-12 btn-group">
			<button class="btn btn-secondary btn-sm" onclick="goBack()">Go Back</button>
			<button class="btn btn-secondary btn-sm" onclick=" relocate_home()">Main</button>
		</div>
		<div class="col-lg-12">
			<center><h1>Order Detail of Customer</h1></center>
		</div>
		<div class="col-lg-12">
			<form action="" name="form1" method="POST">
				<div class="col-lg-4">
					<div class="form-group col-lg-12">
						<label for="menu_id"> Menu </label>
						<input type="text" class="form-control" value="<?php echo $menucheck['name']; ?>" disabled>

					</div>
					<div class="form-group col-lg-12">
						<label for="quantity"> Quantity </label>
						<input class="form-control" type="number" min="1" name="quantity" placeholder="How Many did the Customer Order?" required="required" value="<?php echo $orderinfo['quantity']?>"> 
					</div>
				</div>
				<div class="col-lg-8">
					<div class="form-group col-lg-9">
						<label for="style"> Style </label>
						<textarea name="style" class="form-control" rows="2" id="style" required="required" placeholder="Customer's cooking preference"><?php echo $orderinfo['style']?></textarea>
					</div>
					<div class="col-lg-12">
						<button type="submit" class="btn btn-primary col-lg-3" name="submitbtn">SUBMIT</button>
					</div>
				</div>
			</form>
		</div>
	</div>
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