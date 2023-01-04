<?php 
include "connection.php";
mysqli_select_db($connection, 'pagination');
$results_per_page = 6;
$sql='SELECT * FROM tables';
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
      <div class="col-lg-12">
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
      <div class="col-lg-12">
        <div class="col-lg-4">
          <form action="" name="form1" method="post">
            <div class="form-group">
              <label for="max_capacity">Maximum Capacity</label>
              <input type="text" class="form-control" id="max_capacity" placeholder="Enter Capacity" name="max_capacity">
            </div>
            <button type="submit" name="insert" class="btn btn-primary col-lg-6">Insert</button>
          </form>
        </div>
        <div class="col-lg-8">
          <table class="table table-bordered">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Table Availability</th>
                <th scope="col">Max Capacity</th>
                <th scope="col" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $res=mysqli_query($connection,"select * from tables ORDER BY table_id LIMIT $this_page_first_result ,$results_per_page;");
              while ($row=mysqli_fetch_array($res))
              {
                echo "<tr>";
                echo "<td>"; echo $row["table_id"];  echo "</td>";

                echo "<td>";
                if($row["table_availability"]==0)
                {
                  echo "Not Occupied";
                }
                else
                {
                  echo "Currently Occupied";
                }
                echo "</td>";
                echo "<td>"; echo $row["max_capacity"];  echo "</td>";
                echo "<td>"; ?> <a href="table_edit.php?id=<?php echo $row["table_id"]; ?>"><button type="button" class="btn btn-success">Edit</button></a> <?php  echo "</td>"; 
                echo "<td>"; ?> <a href="table_delete.php?id=<?php echo $row["table_id"]; ?>" onClick='return confirm("are you sure you want to delete??");'><button type="button" class="btn btn-danger">Delete</button></a> <?php  echo "</td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
          <center>
            <div class="col-lg-12">
              <?php
              for ($page=1;$page<=$number_of_pages;$page++)
              {?>
                <a href="table_index.php?page=<?php echo $page; ?>"><button type="button" class="btn btn-info"><?php echo $page; ?></button></a>
              <?php } ?>
            </div>
          </center>
        </div>
      </div>
    </div>
  </header>
</body>

<?php 
if (isset($_POST["insert"]))
{
  mysqli_query ($connection,"insert into tables values(NULL,'0','$_POST[max_capacity]')");

?>

  <script type="text/javascript">
  window.location.href=window.location.href;
  </script>

  <?php
}
?>
</html>
<script>
function relocate_home(){
  location.href = "main.php";
} 
</script>
