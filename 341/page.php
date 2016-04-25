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
		<header>
			<h1> Website Title</h1>
		</header>
		
		<ul id = "links">
			<li><a href=" ">Home</a></li>
			<li><a href=" ">Account</a></li>
			<li><a href=" ">About Us</a></li>
			<li><a href=" ">Contact Info</a></li>
		</ul>
		<home>
			<p>stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff
			   stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff
			   stuff stuff stuff stuff stuff stuffs stuff stuff stuff stuff stuff stuff stuff
				stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff</p>
		</home>
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
		<div id = "footer">
			Copyright &copy dentistscheduler.com
		</div>
	</body>
</head>