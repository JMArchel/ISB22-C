<?php 
include "connection.php";
$id=$_GET["id"];

$name="";
$type="";
$category="";
$description="";
$price="";
$menu_availability="";


$res=mysqli_query ($connection,"SELECT * FROM `menu` WHERE `menu_id`=$id");
while ($row=mysqli_fetch_array($res)) 
{
  $name=$row['name'];
  $type=$row['type'];
  $category=$row['category'];
  $description=$row['description'];
  $price=$row['price'];
  $menu_availability=$row['menu_availability'];
}
?>

<html lang="en">
<head>
  <title>Customer Edit</title>
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
      $(document).ready(function () 
    {
      var TypeSel = document.getElementById("typ").value;
      var CatSel = document.getElementById("cat").value;
      $("#type").val(TypeSel).change();
      $("#category").val(CatSel).change();
    });
  </script>
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
        <h2>Customer Information</h2>
      </div>
      <div class="col-lg-12">
        <form action="" name="form1" method="post">
          <div class="col-lg-12">
            <div class="form-group col-lg-8">
              <label for="name" >Name</label><br>
              <input type="text" class="form-control" name="name" id="name" required="required" placeholder="Enter Name" value="<?php echo $name; ?>">
              <input type="hidden" class="form-control" name="typ" id="typ"  value="<?php echo $type; ?>">
              <input type="hidden" class="form-control" name="cat" id="cat"  value="<?php echo $category; ?>">
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group col-lg-4">
              <label for="type" >Type</label><br>
              <select class="form-control" name="type" id="type" required="required">
                <option value="<?php echo $type; ?>" disabled hidden><?php echo $type; ?></option>
              </select>
            </div>
            <div class="form-group col-lg-4">
              <label for="category" >Category</label><br>
              <select class="form-control" name="category" id="category" required="required">
                <option value="<?php echo $category; ?>" disabled hidden><?php echo $category; ?></option>
              </select>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group col-lg-8">
              <label for="description" >Description</label><br>
              <textarea class="form-control" name="description" id="description" rows="4" required="required" placeholder="Enter Description"><?php echo $description; ?></textarea>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group col-lg-4">
              <label for="price" >Price</label><br>
              <input type="Number" class="form-control" name="price" id="price" max='<?php echo date("Y-m-d");?>' required="required" value="<?php echo $price; ?>">
            </div>
            <div class="form-group col-lg-4">
              <label for="menu_availability" >Availability</label><br>
              <input type="Number" class="form-control" name="menu_availability" id="menu_availability" max='<?php echo date("Y-m-d");?>' required="required" value="<?php echo $menu_availability; ?>">
            </div>
          </div>
          <button type="submit" name='update' class="btn btn-primary col-lg-3">Update</button>
        </form>
      </div>
    </div>
  </header>
</body>
</html>

<?php 
if (isset($_POST["update"]))
{
  $name='$_POST[name]';
  $type='$_POST[type]';
  $category='$_POST[category]';
  $description='$_POST[description]';
  $price='$_POST[price]';
  $menu_availability='$_POST[menu_availability]';
  echo "$name"."$type"."$category"."$description"."$price"."$menu_availability";
  //mysqli_query($connection, "update `menu` SET `name`='$_POST[name]',`type`='$_POST[type]',`category`='$_POST[category]',`description`='$_POST[description]',`price`='$_POST[price]',`menu_availability`='$_POST[menu_availability]' where menu_id=$id");
  
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