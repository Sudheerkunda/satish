<?php
	include '../database/conn.php';
	$Connection = new Connection();
	$con        = $Connection->db_connect();
	date_default_timezone_set("Asia/Calcutta");
	date_default_timezone_get();
	$logout_date     = date('Y-m-d H:i:s', time ());
	
	$up  = "update MB_Admin set Last_Logout_Date='$logout_date' where Status='Active'";
	$up_res = mysqli_query($con,$up);
	
	session_start();
	// remove all session variables
	session_unset(); 
	// destroy the session 
	session_destroy();
	header("Location:index.php");
	exit;
?>
