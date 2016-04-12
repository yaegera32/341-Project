<?php
	session_start();
	$link = mysqli_connect("172.31.57.7:3306", "root", "security") or die(mysqli_error());

	mysqli_select_db($link, "new_schema") or die(mysqli_error($link));

	$date = $_GET["date"];
	$time = $_GET["time"];
	$endTime = $_GET["endTime"];

	$rs = mysqli_query($link, "SELECT * from Appointments where AppointmentDate = '".$date."'");
	$num_results = mysqli_num_rows($rs);
	if($num_results == 0){
		$arr = array();
		$rf = mysqli_query($link, "Select EmployeeID from Employees where EmpType = 'Dentist'");
		$dent  = mysqli_fetch_row($rf);
		//$hyg = $row['HygienistID'];
		$data = (object)array('dentist' => $dent[0]);
		array_push($arr, $data);

		echo json_encode($arr);
	}
	else{
		$strSQL1 = "SELECT EmployeeID FROM Employees e natural join Appointments a WHERE(EndTime < '".$time.":00' OR AppointmentTime > '".$endTime.":00') AND EmpType = 'Dentist' AND AppointmentDate = '".$date."'";
		//$strSQL1 = "SELECT EmployeeID FROM Employees e natural join Appointments a WHERE (('".$endTime.":00' between AppointmentTime and EndTime or '".$time.":00' between AppointmentTime and EndTime or AppointmentTime between '".$time.":00' and '".$endTime.":00' or EndTime between '".$time.":00' and '".$endTime.":00') AND AppointmentDate = '".$date."' AND EmpType = 'Dentist')";
		//echo json_encode($strSQL1);
		$rt = mysqli_query($link, $strSQL1);
		if (!$rt) {
			printf("Error: %s\n", mysqli_error($link));
			exit();
		}
		$arr = array();
		$row = mysqli_fetch_row($rt);
		$dent = $row[0];
		//$hyg = $row['HygienistID'];
		$data = (object)array('dentist' => $dent);
		array_push($arr, $data);

		echo json_encode($arr);
	}


	
	
	
	mysqli_close($link);
?>
