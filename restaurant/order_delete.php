<?php 
	require_once("connection.php");
	//show($_GET);
	if (isset($_GET['id']))
	{
		deleteorder($_GET['id']);
	}
?>