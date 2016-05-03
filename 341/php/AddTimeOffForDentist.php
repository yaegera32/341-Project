<?php
	session_start();
	$link = mysqli_connect("localhost", "root", "security") or die(mysqli_error());

	mysqli_select_db($link, "new_schema") or die(mysqli_error($link));

	$day = $_POST["day"];
	$month = $_POST["month"];
	$year = $_POST["year"];
	$dent = $_POST["dentist"];
	
	if($day < 10){
		$day = "0" . $day;
	}
	
	if($month < 10){
		$month = "0" . $month;
	}
	
	$date = $year . "-" . $month . "-" . $day;
	
	$time = $date. " 8:00:00";
	$endTime = $date. " 17:00:00";

	$strSQL = "DELETE from Appointments WHERE DentistID = ".$dent." AND AppointmentDate = '".$date."'";
	echo json_encode($strSQL);
	mysqli_query($link, $strSQL);

	$strSQL = "INSERT INTO Appointments(";
			
	$strSQL = $strSQL . "AppointmentDate, AppointmentTime, DentistID, HygienistID, EndTime, PatientID, AppointmentType) ";
	$strSQL = $strSQL . "VALUES('".$date."', '".$time."', '".$dent."', null, '".$endTime."', null, 'Time Off')";
	echo json_encode($strSQL);
	mysqli_query($link, $strSQL) or die(mysqli_error($link));
	
	header('Location: /calendarAdmin.php');

	mysqli_close($link);
?>
