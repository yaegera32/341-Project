<?php
	session_start();
	$link = mysqli_connect("localhost", "root", "security") or die(mysqli_error());

	mysqli_select_db($link, "new_schema") or die(mysqli_error($link));

	$result = mysqli_query($link, "select EmployeeID, lastname from Employees where EmpType = 'Dentist'");
    $arr = array();
	while($row = mysqli_fetch_array($result)){
		$name = $row['lastname'];
		$id = $row['EmployeeID'];
		$data = (object)array('name' => $name, 'id' => $id);
		array_push($arr, $data);
	}

	echo json_encode($arr);
	//echo $data;
	mysqli_close($link);
?>

