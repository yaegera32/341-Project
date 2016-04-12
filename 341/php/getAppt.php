<?php
	session_start();
	$link = mysqli_connect("172.31.57.7:3306", "root", "security") or die(mysqli_error());

	mysqli_select_db($link, "new_schema") or die(mysqli_error($link));
	
	$strSQL = "";
	
	if($_SESSION['Username'] == 'admin' || $_SESSION['Username'] == 'Admin'){
		$strSQL = "SELECT * FROM Appointments";
	}
	else{
		$strSQL = "SELECT * FROM Appointments WHERE " . $_SESSION['UserType'] . "ID = " . $_SESSION["ID"];
	}
	$rs = mysqli_query($link, $strSQL);
	$arr = array();
	
	while($row = mysqli_fetch_array($rs)){
		$getDentName = mysqli_query($link, "Select firstname, lastname from Employees where EmployeeID = '".$row['DentistID']."'");
		$getHygName = mysqli_query($link, "Select firstname, lastname from Employees where EmployeeID = '".$row['HygienistID']."'");
		$getPatName = mysqli_query($link, "Select firstname, lastname from Patients where PatientID = '".$row['PatientID']."'");
		$date = $row['AppointmentDate'];
		$time = $row['AppointmentTime'];
		while($nrow = mysqli_fetch_array($getDentName)){
				$dent = $nrow['firstname']. " " .$nrow['lastname'];
		}
		while($nrow = mysqli_fetch_array($getHygName)){
				$hyg = $nrow['firstname']. " " .$nrow['lastname'];
		}
		while($nrow = mysqli_fetch_array($getPatName)){
				$pat = $nrow['firstname']. " " .$nrow['lastname'];
		}
		//$hyg = $row['HygienistID'];
		//$pat = $row['PatientID'];
		$type = $row['AppointmentType'];
		$id = $row['AppointmentID'];
		$data = (object)array('date' => $date, 'time' => $time, 'dentist' => $dent, 'hygienist' => $hyg, 'patient' => $pat, 'id' => $id, 'type' => $type);
		array_push($arr, $data);
	}
	
	echo json_encode($arr);
	
	mysqli_close($link);
?>
