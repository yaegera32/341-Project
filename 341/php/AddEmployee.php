<?php
	$link = mysqli_connect("localhost", "root", "security") or die(mysqli_error());
			
	mysqli_select_db($link, "new_schema") or die(mysqli_error($link));

	$firstname = $_POST("firstname");
	$lastname = $_POST("lastname");
	$empType = $_POST("empType");
	$phone = $_POST("phone");
	$email = $_POST("email");
	$username = $_POST("username");
	$password = $_POST("password");
	$confirmPassword = $_POST("confirmPassword");

	if($confirmPassword==$password){
			$strSQL = "INSERT INTO Employees(";
			
			$strSQL = $strSQL . "firstname, lastname, EmpType, phone, address, email)";
			$strSQL = $strSQL . "VALUES('".$firstname."', '".$lastname."', '".$empType."', '".$phone."')";
			
			mysqli_query($link, $strSQL) or die(mysqli_error($link));
		
			$strSQL = "SELECT EmployeeID FROM Employees WHERE firstname = '".$firstname."' AND lastname = '".$lastname."' AND EmpType = '".$empType."' AND phone = '".$phone."'";
			$query = mysqli_query($link, $strSQL) or die(mysqli_error($link));
			while($row = mysqli_fetch_array($query){
				$ID = $row['EmployeeID'];	
			}
			$strSQL = "INSERT INTO Usernames(";
			$strSQL = $strSQL . "Username, Passwords, EmployeeID)";
			$strSQL = $strSQL . "VALUES('".$username."', '".$password."', '".$ID."')";
				  
			mysqli_query($link, $strSQL) or die(mysqli_error($link));
	}
	else{
		print("passwords don't match");
		exit();
	}
	header('Location: /EditEmployeesPage.php');
