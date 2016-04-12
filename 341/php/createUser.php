<?php
	$link = mysqli_connect("172.31.57.7:3306", "root", "security") or die(mysqli_error());
			
	mysqli_select_db($link, "new_schema") or die(mysqli_error($link));

	$first = $_POST["fName"];
	$last = $_POST["lName"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$addr = $_POST["addr"];
	$email = $_POST["email"];
	$user = $_POST["username"];
	$pass = $_POST["password"];
	
	$strSQL = "INSERT INTO Patients(";
			
	$strSQL = $strSQL . "firstname, lastname, phone, address, email)";
	$strSQL = $strSQL . "VALUES('".$first."', '".$last."', '".$phone."', '".$addr."', '".$email."')";
	
	mysqli_query($link, $strSQL) or die(mysqli_error($link));
	
	$strSQL = "SELECT PatientID FROM Patients WHERE email = '" . $email . "'";
			
	$rs = mysqli_query($link, $strSQL);
	
	$id = "";
	while($row = mysqli_fetch_array($rs)){
		$id = $row['PatientID'];
	}
	
	$strSQL = "INSERT INTO Usernames(";
			
	$strSQL = $strSQL . "Username, Passwords, PatientID)";
	$strSQL = $strSQL . "VALUES('".$user."', '".$pass."', '".$id."')";
	
	mysqli_query($link, $strSQL) or die(mysqli_error($link));
	
	header('Location: /page.php');

?>