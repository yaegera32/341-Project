<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Login
		</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="js/login.js"></script>
		<link rel="stylesheet" href="css/css.css">
		<link rel="stylesheet" href="css/page.css">
	</head>
	<body>
		<div id = "header">
			<h1> Website Title</h1>
		</div>
		
		<ul id = "links">
			<li><a href=" ">Home</a></li>
			<li><a href=" ">Account</a></li>
			<li><a href=" ">About Us</a></li>
			<li><a href=" ">Contact Info</a></li>
		</ul>
		<div id = "content">
			<p>stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff
			   stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff
			   stuff stuff stuff stuff stuff stuffs stuff stuff stuff stuff stuff stuff stuff
				stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff</p>
			<div id = "footer">
				Copyright &copy dentistscheduler.com
			</div>
		</div>
		<div id = "login_section">
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
		</div>
	</body>
</head>