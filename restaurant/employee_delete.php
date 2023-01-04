<?php 
include "connection.php";
$id=$_GET["id"];
mysqli_query($connection, "DELETE from `employee` where `employee_id`=$id"); 
?>



<script type="text/javascript">
window.location="employee_index.php";
</script>