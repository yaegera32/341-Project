<?php
	session_start();
	$link = mysqli_connect("localhost", "root", "security") or die(mysqli_error());

	mysqli_select_db($link, "new_schema") or die(mysqli_error($link));

	$date = $_GET["date"];
	$time = $_GET["time"];
	$endTime = $_GET["endTime"];
	$id = $_GET['id'];
//echo json_encode($date);
	$dateTime = $date." ".$time;
	$endDateTime = $date." ".$endTime;
	
	$query = "SELECT * from Appointments where AppointmentDate = '".$date."'";

	$rs = mysqli_query($link, $query);
	
	$num_results = mysqli_num_rows($rs);
	//echo json_encode($num_results);
	if($num_results == 0){
		//echo json_encode("  if  ");
		$arr = array();
		$rf = mysqli_query($link, "Select EmployeeID from Employees where EmpType = 'Hygienist'");
		$hyg  = mysqli_fetch_row($rf);
		//$hyg = $row['HygienistID'];
		$data = (object)array('hygienist' => $hyg[0], 'id' => $id);
		array_push($arr, $data);
		echo json_encode($arr);
	}
	else{
		//echo json_encode("  else  ");
		//$strSQL1 = "SELECT EmployeeID FROM Employees e natural join Appointments a WHERE(EndTime < '".$dateTime.":00' OR AppointmentTime > '".$endDateTime.":00') AND EmpType = 'Dentist'";
		//echo json_encode($strSQL1);
		$strSQL1 = "Select EmployeeID FROM Employees WHERE EmployeeID NOT IN(SELECT EmployeeID FROM Employees e natural join Appointments a WHERE (('".$endDateTime.":00' between AppointmentTime and EndTime or '".$dateTime.":00' between AppointmentTime and EndTime or AppointmentTime between '".$dateTime.":00' and '".$endDateTime.":00' or EndTime between '".$dateTime.":00' and '".$endDateTime.":00') )) AND EmpType = 'Hygienist'";
		$rt = mysqli_query($link, $strSQL1);
		if (!$rt) {
			printf("Error: %s\n", mysqli_error($link));
			exit();
		}
		$arr = array();
		$row = mysqli_fetch_row($rt);
		$hyg = $row[0];
		//$hyg = $row['HygienistID'];
		$data = (object)array('hygienist' => $hyg, 'id' => $id);
		array_push($arr, $data);

		echo json_encode($arr);
	}


	
	
	
	mysqli_close($link);
?>
