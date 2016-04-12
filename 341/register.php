<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Register
		</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<!--   <script src="js/register.js"></script>   -->
		<link rel="stylesheet" href="css/css.css">
		
	</head>
	<body>
		<form id="register" method="post" action="php/createUser.php">
			<input type="text" name="fName" placeholder="First Name"></input>
			<input type="text" name="lName" placeholder="Last Name"></input>
			<input type="text" name="phone" placeholder="(999) 999-9999"></input>
			<input type="text" name="email" placeholder="email@domain.com"></input>
			<input type="text" name="addr" placeholder="Address"></input>
			<input type="text" name="username" placeholder="Username"></input>
			<br>
			<input type="submit" value="Create"></input>
			<input type="password" name="password" placeholder="Password"></input>
			<!--<br>ADMIN ONLY --- <input type="radio" name ="job" value="hygenist">Hygenist
							   <input type="radio" name ="job" value="dentist">Dentist-->
			<input type="button" value="Back" onClick="location.href = 'page.php';"></input>
		</form>
		
	</body>
</head>