<?php
	session_start();
	$link = mysqli_connect("localhost", "root", "security") or die(mysqli_error());

	mysqli_select_db($link, "new_schema") or die(mysqli_error($link));
	
	$id = $_POST["id"];
	
	$strSQL = "DELETE from Appointments WHERE AppointmentID = ".$id;

	mysqli_query($link, $strSQL);

	
	mysqli_close($link);
?>