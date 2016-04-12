<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<?php
			$link = mysqli_connect("172.31.57.7:3306", "root", "security") or die(mysqli_error());
			
			mysqli_select_db($link, "new_schema") or die(mysqli_error($link));
			
			$strSQL = "SELECT * FROM Usernames WHERE Username = '" . $_POST["username"] . "'";
			
			$rs = mysqli_query($link, $strSQL);
			
			$password = "";
			$id = 0;
			session_start();
			while($row = mysqli_fetch_array($rs)){
				$password = $row['Passwords'];
				$id = $row['EmployeeID'];
				$type;
				if($id != null && $id != 1){
					$checker = mysqli_query($link, "SELECT * FROM Employees WHERE EmployeeID = " . $id);
					while($stuff = mysqli_fetch_array($checker)){
						$_SESSION['UserType'] = $stuff['EmpType'];
					}
				}
				
				
				else{
					$id = $row['PatientID'];
					$_SESSION['UserType'] = 'Patient';
				}
			}
			
			if($password != ""){
				if($password == $_POST['password']){
					
					$_SESSION['Login'] = true;
					$_SESSION['Username'] = $_POST["username"];
					$_SESSION['ID'] = $id;
					if($_SESSION['Username'] == 'admin' || $_SESSION['Username'] == 'Admin'){
						header('Location: /calendarAdmin.php');
					}
					else{
						header('Location: /calendar.php');
					}
				}
				else{
					header('Location: /page.php');
				}
			}
			else{header('Location: /page.php');}
		?>
	</body>
</html>