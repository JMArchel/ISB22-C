<?php
	include "connection.php";	
	$table=seetable();
	
?>

<html lang="en">
<head>
  <title>CUSTOMER TABLE</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style type="text/css">
  </style>
</head>
<body>
	<header>
		<div class="container background" style="height: 100%">
			<div class="col-lg-12">
				<?php echo "&nbsp&nbsp&nbsp" ?>
			</div>
			<div class="col-lg-12 btn-group">
				<button class="btn btn-secondary btn-sm" onclick=" relocate_home()">Main</button>
			</div>
			<?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?>
			<div class="col-lg-12 mb-5">
				<form action="" name="form1" method="post">
					<div class="col-lg-8 align-items-center">
						<?php foreach ($table as $tables){ ?>
							<button type="submit" class="btn btn-dark col-lg-5 rounded-pill m-1" value="<?php echo $tables['table_id']; ?>" name="submtbtn">
								<h4><?php echo "Table " .$tables['table_id']; ?></h4>
							</button>
						<?php } ?>
					</div>
					<div class="col-lg-3">
						<center><h1><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br>Customer Table</h1></center>
					</div>
				</form>
			</div>
		</div>
	</header>
</body>
<?php 
	if (isset($_POST["submtbtn"]))
		{
			checkavailable($_POST["submtbtn"]);
		}
?>
</html>
<script>
function relocate_home(){
	location.href = "main.php";
} 
</script>