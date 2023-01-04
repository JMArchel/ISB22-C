<?php 
include "connection.php";
$id=$_GET["id"];
mysqli_query($connection, "DELETE from `menu` where `menu_id`=$id"); 
?>

<script type="text/javascript">
window.location="menu_index.php";
</script>