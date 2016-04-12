<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Admin Calendar
		</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="js/calendarAdmin.js"></script>
		<link rel="stylesheet" href="css/css.css">
	</head>
	<body onload="setToday()">
		<?php
			session_start();
			echo("<h1>" . $_SESSION['Username'] . " " . $_SESSION['ID'] . " " . $_SESSION['idstuff'] . " </h1>");
		?>
		<form method="post" action="php/logout.php">
			<input type="submit" value="logout"></input>
		</form>
		<button onclick="toggleCalendar()">Hide/Show</button>
			<button onclick="toggleApt()">Close</button>
		
			<table id="create" style="display:none">
				<tr>
					<td colspan="5">
						<button onclick="createApptment()">Add Appointment</input>
					</td>
				</tr>
				<tr>
					<td><input id="typeApt" type="text" name="type" placeholder="Type"></td>
					<td><input id="monthApt" type="text" name="month" placeholder="Month"></td>
					<td><input id="dayApt" type="number" name="day" placeholder="Day"></td>
					<td><input id="yearApt" type="number" name="year" placeholder="Year"></td>
					<td><input id="patientID" type="number" name="patientID" placeholder="Patient ID"></td>
				</tr>
				<tr>
					<td colspan="5">
						<ul id="Appts">
						</ul>
					</td>
				</tr>
			</table>
		<table id="calendar" >
			<tr>
				<td colspan="7">
					<button onclick="showAppt()">Show Appointments</button>
					<button onclick="showAvailable()">Show Availability</button>
					<select id="monthJump">
						<option value="0">January</option>
						<option value="1">February</option>
						<option value="2">March</option>
						<option value="3">April</option>
						<option value="4">May</option>
						<option value="5">June</option>
						<option value="6">July</option>
						<option value="7">August</option>
						<option value="8">September</option>
						<option value="9">October</option>
						<option value="10">November</option>
						<option value="11">December</option>
					</select>
					<input type="number" id="yearJump">
					<button onclick="selectDate()">Jump</button>
					<button onclick="setToday()">Today</button>
				</td>
			</tr>
			<tr>
				<td><button onclick="setPreviousYear()">&lt;&lt;</button></td>
				<td><button onclick="setPreviousMonth()">&lt;</button></td>
				<th colspan="3" id="month"></th>
				<td><button onclick="setNextMonth()">&gt;</button></td>
				<td><button onclick="setNextYear()">&gt;&gt;</button></td>
			</tr>
			<tr>
				<th>Sunday</th>
				<th>Monday</th>
				<th>Tuesday</th>
				<th>Wednsday</th>
				<th>Thursday</th>
				<th>Friday</th>
				<th>Saturday</th>
			</tr>
			<tr id="w1">
			
			</tr>
			<tr id="w2">
			
			</tr>
			<tr id="w3">
			
			</tr>
			<tr id="w4">
			
			</tr>
			<tr id="w5">
			
			</tr>
			<tr id="w6">
			
			</tr>
		</table>
		
		<div id="appointment">
			<form method="post" action="php/addApt.php">
				<input type="number" name="year" placeholder="Year">
				<input type="number" name="month" placeholder="Month">
				<input type="number" name="day" placeholder="Day">
				<input type="number" name="hour" placeholder="hour">
				<input type="number" name="min" placeholder="Minute">
				<input type="number" name="dentist" placeholder="Dentist ID">
				<input type="number" name="hygenist" placeholder="Hygenist ID">
				<input type="number" name="patient" placeholder="Patient ID">
				<input type="submit" value="Add Appointment"></input>
			</form>
			<div style="display: none;">
				<br><br><a href="calendar.php">calendar</a><br><a href="page.php">login</a><br><a href="register.php">register</a>
			</div>
		</div>
		
		
	</body>
</html>