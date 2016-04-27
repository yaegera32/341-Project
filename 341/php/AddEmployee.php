<?php
	$link = mysqli_connect("localhost", "root", "security") or die(mysqli_error());
			
	mysqli_select_db($link, "new_schema") or die(mysqli_error($link));

	$firstname = $_GET["firstname"];
	$lastname = $_GET["lastname"];
	$empType = $_GET["typeselect"];
	$phone = $_GET["phone"];
	$email = $_GET["email"];
	$address = $_GET["address"];
	$username = $_GET["username"];
	$password = $_GET["password"];
	$confirmPassword = $_GET["passwordconfirm"];

	if($confirmPassword==$password){
			$strSQL = "INSERT INTO Employees(";
			
			$strSQL = $strSQL . "firstname, lastname, EmpType, phone, address, email)";
			$strSQL = $strSQL . "VALUES('".$firstname."', '".$lastname."', '".$empType."', '".$phone."', '".$address."', '".$email."')";
			echo json_encode($strSQL);
			mysqli_query($link, $strSQL) or die(mysqli_error($link));
		
			$strSQL = "SELECT EmployeeID FROM Employees WHERE firstname = '".$firstname."' AND lastname = '".$lastname."' AND EmpType = '".$empType."' AND phone = '".$phone."'";
			$query = mysqli_query($link, $strSQL) or die(mysqli_error($link));
			while($row = mysqli_fetch_array($query)){
				$ID = $row['EmployeeID'];	
			}
			$strSQL = "INSERT INTO Usernames(";
			$strSQL = $strSQL . "Username, Passwords, EmployeeID)";
			$strSQL = $strSQL . " VALUES('".$username."', '".$password."', '".$ID."')";
			echo json_encode($strSQL);	  
			mysqli_query($link, $strSQL) or die(mysqli_error($link));
	}
	else{
		print("passwords don't match");
		exit();
	}
	header('Location: /EditEmployeesPage.php');
?>
