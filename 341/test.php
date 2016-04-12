<html>
	<head>
		<title>TEST</title>
	</head>
	<body>
		<?php
			$password = "security";
			
			$link = mysqli_connect("172.31.57.7:3306", "root", "security") or die(mysqli_error());
			
			mysqli_select_db($link, "new_schema") or die(mysqli_error($link));
			
		/*	$strSQL = "INSERT INTO Employees(";
			
			$strSQL = $strSQL . "firstname, lastname, phone, address, email)";
			$strSQL = $strSQL . "VALUES('ADMIN', 'ADMIN', '', '', '')";
			
			
			mysqli_query($link, $strSQL) or die(mysqli_error($link));
			echo("added " . $strSQL . " to Employees");
		*/
			$rs = mysqli_query($link, "Select * From Employees WHERE firstname = 'ADMIN'");
			$id;
			while($row = mysqli_fetch_array($rs)){
				$id = $row['EmployeeId'];
			}
			
			$strSQL = "INSERT INTO Usernames(";
			
			$strSQL = $strSQL . "Username, Password, EmployeeID, PatientID)";
			$strSQL = $strSQL . "VALUES('admin', 'admin', " . $id . ", '0')";
			
			
			mysqli_query($link, $strSQL) or die(mysqli_error($link));
			
			echo("added " . $strSQL . " to Usernames/Passwords");
			
			
			
			
			
		
			mysqli_close($link);
		?>
	</body>
</html>