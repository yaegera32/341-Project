<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Employees
		</title>
		<script src="js/calendarAdmin.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<link rel="stylesheet" href="css/css.css">
		<link rel="stylesheet" href="css/EditEmployees.css">
	</head>
	<body>
		<div id = "header">
			<h1> Website Title</h1>
		</div>
		<ul id = "links">
			<li><a href="calendarAdmin.php">Home</a></li>
			<li><a href=" ">Account</a></li>
			<li><a href=" ">About Us</a></li>
			<li><a href=" ">Contact Info</a></li>
			<li><a href="EditEmployeesPage.php">Account Management</a></li>
			<li style = "float:right;"><form method="post" action="php/logout.php"><input type="submit" value="logout"></input></form></li>
		</ul>
		<div id = "actionbar">
			<ul id = "actions">
				<li><a href = "#" class = "contentLink" data-type = "dentist">Dentists</a></li>
				<li><a href = "#" class = "contentLink" data-type = "hygienist">Hygienists</a></li>
				<li><a href = "#" class = "contentLink" data-type = "patient">Patient</a></li>
				<li><a href = "#" class = "contentLink"	data-type = "addnew">Add a New Employee</a></li>
			</ul>
		</div>		
		<div id = "dentist" class="contentDiv">
			<h1 style = "text-align: center;">
				Dentists
			</h1>
			<form id = "delete" method = "post" action = "php/deleteEmployee.php">
			<select name="select" id = "selectDentistID">
					<?php
						$link = mysqli_connect("localhost", "root", "security") or die(mysqli_error());
						mysqli_select_db($link, "new_schema") or die(mysqli_error($link));

						$result = mysqli_query($link, "select EmployeeID, lastname from Employees natural join Usernames where EmpType = 'Dentist'");
						while($row = mysqli_fetch_array($result)){
							$name = $row['lastname'];
							$id = $row['EmployeeID'];
							echo("<option value = '".$id."'>".$name."</option>");
						}
						mysqli_close($link);
					?>
					</select>
			<input name = "delete" type = "submit" value = "Delete">
			</form>
			<select id="monthselect">
						<option value="1">January</option>
						<option value="2">February</option>
						<option value="3">March</option>
						<option value="4">April</option>
						<option value="5">May</option>
						<option value="6">June</option>
						<option value="7">July</option>
						<option value="8">August</option>
						<option value="9">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
			</select>
			<input type="number" id="year" placeholder = "Year">
			<input type="number" id="day" placeholder = "Day">
			<button id = "addtimeoff" onclick = "addDentistTimeOff()">Add Time Off</button>
		</div>
				<div id = "patient" class="contentDiv">
			<h1 style = "text-align: center;">
				Patients
			</h1>
			<form id = "delete" method = "post" action = "php/deletePatient.php">
			<select name="select" id = "selectPatientID">
					<?php
						$link = mysqli_connect("localhost", "root", "security") or die(mysqli_error());
						mysqli_select_db($link, "new_schema") or die(mysqli_error($link));

						$result = mysqli_query($link, "select PatientID, firstname, lastname from Patients natural join Usernames");
						while($row = mysqli_fetch_array($result)){
							$firstname = $row['firstname'];
							$lastname = $row['lastname'];
							$id = $row['PatientID'];
							echo("<option value = '".$id."'>".$firstname." ".$lastname."</option>");
						}
						mysqli_close($link);
					?>
					</select>
			<input name = "delete" type = "submit" value = "Delete">
			</form>
			
		</div>
		<div id = "hygienist" class="contentDiv">
			<h1 style = "text-align:center;">
				Hygienists
			</h1>
			<form id = "delete" method = "post" action = "php/deleteEmployee.php">
			<select name="select" id = "selectHygienistID">
				<?php
					$link = mysqli_connect("localhost", "root", "security") or die(mysqli_error());
					mysqli_select_db($link, "new_schema") or die(mysqli_error($link));

					$result = mysqli_query($link, "select EmployeeID, lastname from Employees natural join Usernames where EmpType = 'Hygienist'");
					while($row = mysqli_fetch_array($result)){
						$name = $row['lastname'];
						$id = $row['EmployeeID'];
						echo("<option value = '".$id."'>".$name."</option>");
					}
					mysqli_close($link);
				?>
			</select>
			<input name = "delete" type = "submit" value = "Delete">
			</form>
			<select id="Hmonthselect">
						<option value="1">January</option>
						<option value="2">February</option>
						<option value="3">March</option>
						<option value="4">April</option>
						<option value="5">May</option>
						<option value="6">June</option>
						<option value="7">July</option>
						<option value="8">August</option>
						<option value="9">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
			</select>
			<input type="number" id="Hyear" placeholder = "Year">
			<input type="number" id="Hday" placeholder = "Day">
			<button id = "addtimeoffH" onclick = "addHygienistTimeOff()">Add Time Off</button>
		</div>
		<div id = "addnew" class="contentDiv">
			<h1>Add a New Employee</h1>
			<form id = "addEmployeeInfo" method = "get" action = "php/AddEmployee.php"> 
				<!--<div id = "typeSelection">
					<input id = "employeeTypeDentist" type = "radio" value = "dentist">Dentist</input><br>
					<input id = "employeeTypeHygienist" type = "radio" value = "hygienist">Hygienist</input>
				</div><br><br><br><br>-->
				<select name = "typeselect">
					<option value = "Dentist">Dentist</option>
					<option value = "Hygienist">Hygienist</option>
				</select>
				<input name = "firstname" type = "text" placeholder = "First name">
				<input name = "lastname" type = "text" placeholder = "Last name"><br><br>
				<input name = "phone" type = "text" placeholder = "Phone number">
				<input name = "address" type = "text" placeholder = "Address">
				<input name = "email" type = "text" placeholder = "Email address"><br><br>
				<input name = "username" type = "text" placeholder = "Username"><br><br>
				<input name = "password" type = "password" placeholder = "password">
				<input name = "passwordconfirm" type = "password" placeholder = "Confirm password"><br><br>
				<input name = "confirmAddEmployee" type = "submit" value = "Confirm">
			</form>
		</div>
		<script>
			$(document).ready(function(){
				$('.contentDiv').hide();
				$('#dentist').show();
				$('.contentLink').click(function(){
					var type = $(this).attr('data-type');
					$('.contentDiv').hide();
					$('#' + type).show();
				});
			});
		</script>
	</body>
</html>