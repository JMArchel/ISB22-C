<?php 
include "connection.php";
mysqli_select_db($connection, 'pagination');
$results_per_page = 8;
$sql='SELECT * FROM job';
$result = mysqli_query($connection, $sql);
$number_of_results = mysqli_num_rows($result);
$number_of_pages = ceil($number_of_results/$results_per_page);
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}
$this_page_first_result = ($page-1)*$results_per_page;
?>

<html lang="en">
<head>
  <title>JOB LIST</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div>
  <header>
    <div class="container background" style="height: 100%">
      <div class="col-lg-12">
        <?php echo "&nbsp&nbsp&nbsp" ?>
      </div>
      <div class="col-lg-12 btn-group">
        <button class="btn btn-secondary btn-sm" onclick=" relocate_home()">Main</button>
      </div>
      <div class="col-lg-12">
        <div class="col-lg-4">
          <h2>Job Information</h2>
        </div>
        <div class="col-lg-8">
          <center><h3>Job List</h3></center>
        </div>
      </div>
      <div class="col-lg-4">
        <form action="" name="form1" method="post">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" required="required" class="form-control" id="title" placeholder="Enter Title" name="title">
            </div>
            <div class="form-group">
              <label for="min_salary">Minimum Salary</label>
              <input type="number" required="required" class="form-control" id="min_salary" placeholder="Enter Min. Salary" name="min_salary">
            </div>
            <div class="form-group">
              <label for="max_salary">Maximum Salary</label>
              <input type="number" required="required" class="form-control" id="max_salary" placeholder="Enter Max. Salary" name="max_salary">
            </div>
            <div class="form-group">
              <label for="pt_salary">Part time salary </label>
              <input type="number" required="required" class="form-control" id="pt_salary" placeholder="Enter Part Time salary" name="pt_salary">
            </div>
            <button type="submit" name="insert" class="btn btn-primary col-lg-6">Insert</button>
        </form>
      </div>
      <div class="col-lg-8">
        <table class="table table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Minimum Salary</th>
              <th scope="col">Maximum Salary</th>
              <th scope="col">Part Time Salary</th>
              <th scope="col" colspan="2">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $res=mysqli_query($connection,"select * from job LIMIT $this_page_first_result ,$results_per_page;");
            while ($row=mysqli_fetch_array($res))
            {
              echo "<tr>";
              echo "<td>"; echo $row["job_id"];  echo "</td>";
              echo "<td>"; echo $row["title"];  echo "</td>";
              echo "<td>"; echo $row["min_salary"];  echo "</td>";
              echo "<td>"; echo $row["max_salary"];  echo "</td>";
              echo "<td>"; echo $row["pt_salary"];  echo "</td>";
              echo "<td>"; ?> <a href="job_edit.php?id=<?php echo $row["job_id"]; ?>"><button type="button" class="btn btn-success">Edit</button></a> <?php  echo "</td>"; 
              echo "<td>"; ?> <a href="job_delete.php?id=<?php echo $row["job_id"]; ?>" onClick='return confirm("Are you sure you want to delete?");'><button type="button" class="btn btn-danger">Delete</button></a> <?php  echo "</td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="col-lg-4 text-white">.</div>
      <div class="col-lg-8">
        <center>
          <?php
          for ($page=1;$page<=$number_of_pages;$page++)
          {?>
            <a href="job_index.php?page=<?php echo $page; ?>"><button type="button" class="btn btn-info"><?php echo $page; ?></button></a>
          <?php } ?>
        </center>
      </div>
    </div>
  </header>
</body>
<?php 
if (isset($_POST["insert"]))
{
  checkexistingjob($_POST['title'],
    $_POST['min_salary'],
    $_POST['max_salary'],
    $_POST['pt_salary']);
}
?>
</html>
<script>
function relocate_home(){
  location.href = "main.php";
} 
</script>

