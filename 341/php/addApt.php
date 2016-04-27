<?php
	$link = mysqli_connect("localhost", "root", "security") or die(mysqli_error());
			
	mysqli_select_db($link, "new_schema") or die(mysqli_error($link));

	$day = $_POST["day"];
	$month = $_POST["month"];
	$year = $_POST["year"];
	$start = $_POST["start"];
	$dent = $_POST["dentist"];
	$hyg = $_POST["hygienist"];
	$pat = $_POST["patient"];
	$type = $_POST["type"];
	$end = $_POST["end"];
	
	if($day < 10){
		$day = "0" . $day;
	}
	
	if($month < 10){
		$month = "0" . $month;
	}
	
	$date = $year . "-" . $month . "-" . $day;
	
	$time = $date. " " .$start . ":00";
	$endTime = $date. " " .$end . ":00";

	$strSQL = "INSERT INTO Appointments(";
			
	$strSQL = $strSQL . "AppointmentDate, AppointmentTime, DentistID, HygienistID, EndTime, PatientID, AppointmentType)";
	$strSQL = $strSQL . "VALUES('".$date."', '".$time."', '".$dent."', '".$hyg."', '".$endTime."', '".$pat."', '".$type."')";
	//echo json_encode($strSQL);
	mysqli_query($link, $strSQL) or die(mysqli_error($link));
	
	header('Location: /calendar.php');
?>