<?php
	session_start();
	$link = mysqli_connect("localhost", "root", "security") or die(mysqli_error());

	mysqli_select_db($link, "new_schema") or die(mysqli_error($link));
		
	$id = $_GET["id"];
	$month = $_GET["month"];
	$day = $_GET["day"];
	$year = $_GET["year"];

	$date = $year."-".$month."-".$day;
	$strSQL = "DELETE from Appointments WHERE DentistID = ".$id." AND AppointmentDate = '".$date."'";
	echo json_encode($strSQL);
	mysqli_query($link, $strSQL);

	
	mysqli_close($link);
?>