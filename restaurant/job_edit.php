<?php 
include "connection.php";
$id=$_GET["id"];

$title="";
$max_salary="";
$min_salary="";
$pt_salary="";


$res=mysqli_query ($connection,"SELECT * FROM `job` WHERE `job_id`=$id");
while ($row=mysqli_fetch_array($res)) 
{
  $title=$row['title'];
  $max_salary=$row['max_salary'];
  $min_salary=$row['min_salary'];
  $pt_salary=$row['pt_salary'];
}
?>

<html lang="en">
<head>
  <title>JOB EDIT</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
</body>
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
        <div class="col-lg-4">
          <h2>Job Information</h2>
        </div>
      </div>
      <div class="col-lg-4">
        <form action="" name="form1" method="post">
          <div class="form-group">
            <label for="email">Title</label>
            <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" value="<?php echo $title; ?>">
          </div>
          <div class="form-group">
            <label for="pwd">Minimum Salary</label>
            <input type="number" class="form-control" id="min_salary" placeholder="Enter Min. Salary" name="min_salary" value="<?php echo $min_salary; ?>">
          </div>
          <div class="form-group">
            <label for="pwd">Maximum Salary</label>
            <input type="number" class="form-control" id="max_salary" placeholder="Enter Max. Salary" name="max_salary" value="<?php echo $max_salary; ?>">
          </div>
          <div class="form-group">
            <label for="pwd">Part Time salary </label>
            <input type="number" class="form-control" id="pt_salary" placeholder="Enter Part Time salary" name="pt_salary" value="<?php echo $pt_salary; ?>">
          </div>
          <button type="submit" name='update' class="btn btn-primary col-lg-6">Update</button>
        </form>
      </div>
    </div>
  </header>
</body>
</html>

<?php 
if (isset($_POST["update"]))
{

  mysqli_query($connection, "update `job` SET title='$_POST[title]', max_salary='$_POST[min_salary]', min_salary='$_POST[max_salary]', pt_salary='$_POST[pt_salary]' where job_id=$id");
?>
  <script type="text/javascript">
  window.location="job_index.php";
  </script>
  <?php  
}  ?>
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