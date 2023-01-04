<?php 
include "connection.php";
$id=$_GET["id"];
mysqli_query($connection, "DELETE from `customer` where `customer_id`=$id"); 
?>

<script type="text/javascript">
window.location="customer_index.php";
</script>
