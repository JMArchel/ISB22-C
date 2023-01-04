<?php 
include "connection.php";
$id=$_GET["id"];

$table_id="";
$max_capacity="";

$res=mysqli_query ($connection,"SELECT * FROM `tables` WHERE `table_id`=$id");
while ($row=mysqli_fetch_array($res)) 
{
  $table_id=$row['table_id'];
  $max_capacity=$row['max_capacity'];
}
?>

<html lang="en">
<head>
  <title>TABLE</title>
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
        <div><h2>Job Information</h2></div>
      </div>
      <div class="col-lg-12">
          <div class="col-lg-4">
            <form action="" name="form1" method="post">
            <div class="form-group">
              <label for="pwd">Maximum Capacity (Table <?php echo $table_id; ?>)</label>
              <input type="number" class="form-control" id="max_capacity" placeholder="Maximum Capacity" name="max_capacity" value="<?php echo $max_capacity ?>">
            </div>
            <button type="submit" name='update' class="btn btn-primary col-lg-6">Update</button>
            </form>
          </div>
      </div>
    </div>
  </header>
</body>
</html>

<?php 
if (isset($_POST["update"]))
{
  mysqli_query($connection, "update `tables` SET max_capacity='$_POST[max_capacity]' where table_id=$id");
  ?>
  <script type="text/javascript">
  window.location="table_index.php";
  </script>
  <?php  
}?>
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