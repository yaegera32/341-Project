<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Login
		</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="js/login.js"></script>
		<link rel="stylesheet" href="css/css.css">

	</head>
	<body>
		
		<form method="post" action="php/login.php">
			<input type="text" name="username" placeholder="Username"></input>
			<br>
			<input type="password" name="password" placeholder="Password"></input>
			<input type="submit" value="Login"></input>
			<div style="display: none;">
				<br><br><a href="calendar.php">calendar</a><br><a href="page.php">login</a><br><a href="register.php">register</a>
				
				<br><br><br><a href="test.php">TEST CONNECTION</a>
			</div>
		</form>
		<input type="button" value="Register" onClick="location.href = 'register.php';"></input>
	</body>
</head>