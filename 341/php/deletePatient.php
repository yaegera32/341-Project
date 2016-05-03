<?php
	session_start();
	$link = mysqli_connect("localhost", "root", "security") or die(mysqli_error());
			
	mysqli_select_db($link, "new_schema") or die(mysqli_error($link));

	$employee = $_POST["select"];
	$strSQL = "DELETE from Usernames WHERE PatientID = ".$employee;

	mysqli_query($link, $strSQL);
	mysqli_close($link);

	header('Location: /EditEmployeesPage.php');
?>