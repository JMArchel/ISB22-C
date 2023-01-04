<?php 
include "connection.php";
mysqli_select_db($connection, 'pagination');
$results_per_page = 7;
$sql='SELECT * FROM customer';
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
  <title>CUSTOMER LIST</title>
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
        <div><h2>Customer Information</h2></div>
      </div>
      <div class="col-lg-12">
        <form action="" name="form1" method="post">
          <div class="col-lg-12">
            <div class="form-group col-lg-4">
              <label for="c_first_name" >First Name</label><br>
              <input type="text" class="form-control" name="c_first_name" id="c_first_name" required="required" placeholder="Enter First Name">
            </div>
            <div class="form-group col-lg-4">
              <label for="c_last_name" >Last Name</label><br>
              <input type="text" class="form-control" name="c_last_name" id="c_last_name" required="required" placeholder="Enter Last Name">
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group col-lg-8">
              <label for="c_address" >Email Address</label><br>
              <input type="Email" class="form-control" name="c_address" id="c_address" required="required" placeholder="Enter Email">
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group col-lg-4">
              <label for="c_phone_num" >Contact Number</label><br>
              <input type="text" class="form-control" name="c_phone_num" id="c_phone_num" required="required" placeholder="Enter Phone Number">
            </div>
            <div class="form-group col-lg-4">
              <label for="c_birthday" >Birthday</label><br>
              <input type="date" class="form-control" name="c_birthday" id="c_birthday" max='<?php echo date("Y-m-d");?>' required="required">
            </div>
          </div>
          <div class="col-lg-8">
              <button type="submit" name="insert" class="btn btn-primary col-lg-3">Insert</button>
          </div>
        </form>
      </div>
      <div class="col-lg-12">
        <div class="col-lg-12">
          <center>
            <?php
            for ($page=1;$page<=$number_of_pages;$page++)
            {?>
              <a href="customer_index.php?page=<?php echo $page; ?>"><button type="button" class="btn btn-info"><?php echo $page; ?></button></a>
            <?php } ?>
          </center>
        </div>
        <div class="col-lg-12">
          <div><center><h3>Customer List</h3></center></div>
        </div>
        <div class="col-lg-12">
          <table class="table table-bordered">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Email Address</th>
                <th scope="col">Birthday</th>
                <th scope="col" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $res=mysqli_query($connection,"select * from customer order by customer_id LIMIT $this_page_first_result ,$results_per_page;");
              while ($row=mysqli_fetch_array($res))
              {
                echo "<tr>";
                echo "<td>"; echo $row["customer_id"];  echo "</td>";
                echo "<td>"; echo $row["c_first_name"]; echo "</td>";
                echo "<td>"; echo $row["c_last_name"];  echo "</td>";
                echo "<td>"; echo $row["c_phone_num"];  echo "</td>";
                echo "<td>"; echo $row["c_address"];  echo "</td>";
                echo "<td>"; echo $row["c_birthday"];  echo "</td>";
                echo "<td>"; ?> <a href="customer_edit.php?id=<?php echo $row["customer_id"]; ?>"><button type="button" class="btn btn-success col-lg-12">Edit</button></a> <?php  echo "</td>"; 
                echo "<td>"; ?><a href='customer_delete.php?id=<?php echo $row["customer_id"]; ?>' onClick='return confirm("Are you sure you want to delete?");'><button type="button" class="btn btn-danger col-lg-12">Delete</button></a><?php  echo "</td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </header>
</body>
</html>
<?php 
if (isset($_POST["insert"]))
{
  checkexistingcustomer($_POST['c_first_name'],
    $_POST['c_last_name'],
    $_POST['c_phone_num'],
    $_POST['c_address'],
    $_POST['c_birthday']);
}
?>