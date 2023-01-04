<?php 
include "connection.php";
$id=$_GET["id"];
mysqli_query($connection, "DELETE from `job` where `job_id`=$id"); 
?>

<script type="text/javascript">
window.location="job_index.php";
</script>
