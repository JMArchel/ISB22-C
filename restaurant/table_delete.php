<?php 
include "connection.php";
$id=$_GET["id"];
mysqli_query($connection, "DELETE from `tables` where `table_id`=$id"); 
?>

<script type="text/javascript">
window.location="table_index.php";
</script>