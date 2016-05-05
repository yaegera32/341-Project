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
			<h1>Dental Express Staffing</h1>
		</div>
		
		<ul id = "links">
			<li><a href=" ">Home</a></li>

		</ul>
		<div id = "content">

			<p><font size="+1" color="#122894"><strong>What can Dental Express Staffing do for you???</strong></font></p>
			<p>&nbsp;</p>
			<p><font color="#006699"><strong>* Increase Production *</strong></font></p>
			<p><font color="#006699"><strong>* Save You Time and Money *</strong></font></p>
			<p><font color="#006699"><strong>* Reduce Stress Placed on the Team *</strong></font></p>
			<p><font color="#006699"><strong>* Reduce the Potential for Losing Patients *</strong></font></p>
			<p>&nbsp;</p>
			<p>Have you lost production due to a dentist or hygienist on maternity leave, vacation or out sick? Have you had to work without a dental assistant to manage patient flow and production?</p>
			<p>&nbsp;</p>
			<p>If you answered <font color="#006699"><strong>YES</strong></font> to either of these questions...</p>
			<p>&nbsp;</p>
			<p>Let <font color="#006699"><strong>Dental Express Staffing</strong></font> be your <font color="#006699"><strong>&quot;Help In A Hurry&quot;</strong></font> solution! Whether short notice or long term, Dental Express Staffing is your stress-free choice for finding efficient, highly-skilled professional replacements. Dental Express Staffing offers qualified dentists, dental hygienists, dental assistants and dental administration who are available 24/7.</p>
			<p>&nbsp;</p>
			<p>At <font color="#006699"><strong>Dental Express Staffing</strong></font>, our goal is to create a professional relationship with each and every client.  We would love the opportunity to help you maintain your busy schedule and eliminate distractions caused by unforeseen shortages in staff.</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p><font color="#006699"><strong>Dental Express Staffing Webinar:</strong></font></p>
			<p>&nbsp;</p>
			<p><iframe width="476" height="268" src="https://www.youtube.com/embed/vQhxXfcLUMM" frameborder="0" allowfullscreen></iframe></p>
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