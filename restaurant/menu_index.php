<?php 
include "connection.php";
mysqli_select_db($connection, 'pagination');
$results_per_page = 5;
$sql='SELECT * FROM menu';
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
  <title>MENU LIST</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script>
    var typeObject = {
      "Food": {
        "Appetizer": [],
        "Soup": [],
        "Salad": [],
        "Main-Pork": [],
        "Main-Chicken": [],
        "Main-Beef": [],
        "Main-Seafood": [],
        "Dessert": []    
      },
      "Drinks": {
        "Cocktail": [],
        "Wine": [],
        "Softdrinks": [],
        "Fruit Juice":[]
      }
    }
    window.onload = function() {
      var typeSel = document.getElementById("type");
      var categorySel = document.getElementById("category");
      for (var x in typeObject) {
        type.options[typeSel.options.length] = new Option(x, x);
      }
      typeSel.onchange = function() {
        //empty Chapters- and Topics- dropdowns
        categorySel.length = 1;
        //display correct values
        for (var y in typeObject[this.value]) {
          categorySel.options[categorySel.options.length] = new Option(y, y);
        }
      }
      categorySel.onchange = function() {
        var z = typeObject[typeSel.value][this.value];
      }
    }
  </script>
</head>
<body>
  <header>
    <div class="container background">
      <div class="col-lg-12">
        <?php echo "&nbsp&nbsp&nbsp" ?>
      </div>
      <div class="col-lg-12 btn-group">
        <button class="btn btn-secondary btn-sm" onclick=" relocate_home()">Main</button>
      </div>
      <div class="col-lg-12">
        <h2>Menu Information</h2>
      </div>
      <div class="col-lg-12">
        <form action="" name="form1" method="post">
          <div class="col-lg-12">
            <div class="form-group col-lg-8">
              <label for="name" >Name</label><br>
              <input type="text" class="form-control" name="name" id="name" required="required" placeholder="Enter Menu Name">
            </div>
          </div>
          <div class="col-lg-12">  
            <div class="form-group col-lg-4">
              <label for="type"> Type </label><br>
              <select class="form-control" name="type" id="type" required="required">
                <option value="" selected="selected" disabled hidden>Please Select...</option>
              </select>
            </div>
            <div class="form-group col-lg-4">
              <label for="category"> Category </label><br>
              <select class="form-control" name="category" id="category" required="required">
                <option value="" selected="selected" disabled hidden>Please Select Type First...</option>
              </select>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group col-lg-8">
              <label for="description" >Description</label><br>
              <textarea name="description" class="form-control col-lg-12" rows="4" id="description" required="required" placeholder="Enter Description"></textarea>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group col-lg-4">
              <label for="price" >Price</label><br>
              <input type="Number" class="form-control" name="price" id="price" required="required" min="0" step="0.01" value="0.00">
            </div>
            <div class="form-group col-lg-4">
              <label for="menu_availability" >Menu Availability</label><br>
              <input type="Number" class="form-control" name="menu_availability" id="menu_availability" required="required" min="0" step="1" value="0">
            </div>
          </div>
          <div class="col-lg-8">
            <button type="submit" name="insert" class="btn btn-primary col-lg-3">Insert</button>
          </div>
        </form>
      </div>
      <div class="col-lg-12">
        <center>
          <?php
          for ($page=1;$page<=$number_of_pages;$page++)
          {?>
            <a href="menu_index.php?page=<?php echo $page; ?>"><button type="button" class="btn btn-info"><?php echo $page; ?></button></a>
          <?php } ?>
        </center>
      </div>
      <div class="col-lg-12"><center><h3>Menu List</h3></center></div>
      <div class="col-lg-12">
        <table class="table table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Type</th>
              <th>Category</th>
              <th>Description</th>
              <th>Price</th>
              <th>Availability</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $res=mysqli_query($connection,"SELECT * FROM `menu` ORDER BY menu_id LIMIT $this_page_first_result ,$results_per_page;");
            while ($row=mysqli_fetch_array($res))
            {
              echo "<tr>";
              echo "<td>"; echo $row["menu_id"];  echo "</td>";
              echo "<td>"; echo $row["name"];  echo "</td>";
              echo "<td>"; echo $row["type"];  echo "</td>";
              echo "<td>"; echo $row["category"];  echo "</td>";
              echo "<td>"; echo $row["description"];  echo "</td>";
              echo "<td>"; echo $row["price"];  echo "</td>";
              echo "<td>"; echo $row["menu_availability"];  echo "</td>";
              echo "<td>"; ?> <a href="menu_edit.php?id=<?php echo $row["menu_id"]; ?>"><button type="button" class="btn btn-success">Edit</button></a> <?php  echo "</td>"; 
              echo "<td>"; ?> <a href="menu_delete.php?id=<?php echo $row["menu_id"]; ?>" onClick='return confirm("Are you sure you want to delete?");'><button type="button" class="btn btn-danger">Delete</button></a> <?php  echo "</td>"; echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </header>
</body>

<?php 
if (isset($_POST["insert"]))
{
  checkexistingmenu($_POST['name'],
    $_POST['type'],
    $_POST['category'],
    $_POST['description'],
    $_POST['price'],
    $_POST['menu_availability']);
}
?>
</html>
<script>
function relocate_home(){
  location.href = "main.php";
} 
</script>