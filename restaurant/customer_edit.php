<?php 
include "connection.php";
$id=$_GET["id"];

$c_first_name="";
$c_last_name="";
$c_phone_num="";
$c_address="";
$c_birthday="";


$res=mysqli_query ($connection,"SELECT * FROM `customer` WHERE `customer_id`=$id");
while ($row=mysqli_fetch_array($res)) 
{
  $c_first_name=$row['c_first_name'];
  $c_last_name=$row['c_last_name'];
  $c_phone_num=$row['c_phone_num'];
  $c_address=$row['c_address'];
  $c_birthday=$row['c_birthday'];
}
?>

<html lang="en">
<head>
  <title>CUSTOMER EDIT</title>
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
      <div><h2 class="hfont">Customer Information</h2></div>
    </div>
    <div>
      <form action="" name="form1" method="post">
        <div class="col-lg-12">
          <div class="form-group col-lg-4">
            <label for="c_first_name" >First Name</label><br>
            <input type="text" class="form-control" name="c_first_name" id="c_first_name" required="required" placeholder="Enter First Name" value="<?php echo $c_first_name; ?>">
          </div>
          <div class="form-group col-lg-4">
            <label for="c_last_name" >Last Name</label><br>
            <input type="text" class="form-control" name="c_last_name" id="c_last_name" required="required" placeholder="Enter Last Name" value="<?php echo $c_last_name; ?>">
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group col-lg-8">
            <label for="c_address" >Email Address</label><br>
            <input type="Email" class="form-control" name="c_address" id="c_address" required="required" placeholder="Enter Email" value="<?php echo $c_address; ?>">
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group col-lg-4">
            <label for="c_phone_num" >Contact Number</label><br>
            <input type="text" class="form-control" name="c_phone_num" id="c_phone_num" required="required" placeholder="Enter Phone Number" value="<?php echo $c_phone_num; ?>">
          </div>
          <div class="form-group col-lg-4">
            <label for="c_birthday" >Birthday</label><br>
            <input type="date" class="form-control" name="c_birthday" id="c_birthday" max='<?php echo date("Y-m-d");?>' required="required" value="<?php echo $c_birthday; ?>">
          </div>
        </div>
        <div class="col-lg-8">
          <button type="submit" name='update' class="btn btn-primary col-lg-3">Update</button>
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
  mysqli_query($connection, "update `customer` SET `c_first_name`='$_POST[c_first_name]',`c_last_name`='$_POST[c_last_name]',`c_phone_num`='$_POST[c_phone_num]',`c_address`='$_POST[c_address]',`c_birthday`='$_POST[c_birthday]' where customer_id=$id");
  ?>
  <script type="text/javascript">
  window.location="customer_index.php";
  </script>
  <?php  
}  
