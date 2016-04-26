<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Employees
		</title>
		<script src="js/Employees.js"></script>
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
			<li><a href="EditEmployeesPage.php">Employees</a></li>
		</ul>
		<div id = "actionbar">
			<ul id = "actions">
				<li><a href = "#" class = "contentLink" data-type = "dentist">Dentists</a></li>
				<li><a href = "#" class = "contentLink" data-type = "hygienist">Hygienists</a></li>
				<li><a href = "#" class = "contentLink"	data-type = "addnew">Add a New Employee</a></li>
			</ul>
		</div>		
		<div id = "dentist" class="contentDiv">
			<h1 style = "text-align: center;">
				Dentists
			</h1>
			<select name="dentistselect" id = "selectID">
					<?php
						$link = mysqli_connect("localhost", "root", "security") or die(mysqli_error());
						mysqli_select_db($link, "new_schema") or die(mysqli_error($link));

						$result = mysqli_query($link, "select EmployeeID, lastname from Employees where EmpType = 'Dentist'");
						while($row = mysqli_fetch_array($result)){
							$name = $row['lastname'];
							$id = $row['EmployeeID'];
							echo("<option value = '".$id."'>".$name."</option>");
						}
						mysqli_close($link);
					?>
					</select>
			<button id = "delete" onClick = "deleteEmployee.php">Delete</button>
		</div>
		<div id = "hygienist" class="contentDiv">
			<h1 style = "text-align:center;">
				Hygienists
			</h1>
			<select name="hygienistselect" id = "selectID">
				<?php
					$link = mysqli_connect("localhost", "root", "security") or die(mysqli_error());
					mysqli_select_db($link, "new_schema") or die(mysqli_error($link));

					$result = mysqli_query($link, "select EmployeeID, lastname from Employees where EmpType = 'Hygienist'");
					while($row = mysqli_fetch_array($result)){
						$name = $row['lastname'];
						$id = $row['EmployeeID'];
						echo("<option value = '".$id."'>".$name."</option>");
					}
					mysqli_close($link);
				?>
			</select>
			<button id = "delete" onClick = "deleteEmployee.php">Delete</button>
		</div>
		<div id = "addnew" class="contentDiv">
			<h1>Add a New Employee</h1>
			<form id = "addEmployeeInfo" method = "post" action = "AddEmployee.php"> 
				<!--<div id = "typeSelection">
					<input id = "employeeTypeDentist" type = "radio" value = "dentist">Dentist</input><br>
					<input id = "employeeTypeHygienist" type = "radio" value = "hygienist">Hygienist</input>
				</div><br><br><br><br>-->
				<select id = "typeselect">
					<option value = "Dentist">Dentist</option>
					<option value = "Hygienist">Hygienist</option>
				</select>
				<input id = "firstname" type = "text" placeholder = "First name"></input>
				<input id = "lastname" type = "text" placeholder = "Last name"></input><br><br>
				<input id = "phone" type = "text" placeholder = "Phone number"></input>
				<input id = "email" type = "text" placeholder = "Email address"></input><br><br>
				<input id = "username" type = "text" placeholder = "Username"></input><br><br>
				<input id = "password" type = "password" placeholder = "password"></input>
				<input id = "passwordconfirm" type = "password" placeholder = "Confirm password"></input><br><br>
				<button id = "confirmAddEmployee" onClick="addEmployee.php">Confirm</button>
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