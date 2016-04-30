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
	$username = $_POST["username"];
	
	if($day < 10){
		$day = "0" . $day;
	}
	
	if($month < 10){
		$month = "0" . $month;
	}
	if($username!=null){
		$strSQL1 = "Select PatientID from Usernames where Username = '".$username."'";
		$result = mysqli_query($link, $strSQL1) or die(mysqli_error($link));
		while($patientID = mysqli_fetch_row($result)){
			if(!$patientID) exit();
			$pat = $patientID[0];
			//echo json_encode($patientID[0]);
		}
	}
	else exit();
	$date = $year . "-" . $month . "-" . $day;
	
	$time = $date. " " .$start . ":00";
	$endTime = $date. " " .$end . ":00";

	$strSQL = "INSERT INTO Appointments(";
			
	$strSQL = $strSQL . "AppointmentDate, AppointmentTime, DentistID, HygienistID, EndTime, PatientID, AppointmentType)";
	$strSQL = $strSQL . "VALUES('".$date."', '".$time."', '".$dent."', '".$hyg."', '".$endTime."', '".$pat."', '".$type."')";
	mysqli_query($link, $strSQL) or die(mysqli_error($link));
	
	header('Location: /calendar.php');
?>