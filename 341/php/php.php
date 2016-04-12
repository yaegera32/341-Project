<?php
	$username = "root";
	$password = "security";
	$hostname = "127.0.0.1:3306"; 

	
	//connection to the database
	$dbhandle = mysql_connect($hostname, $username, $password) 
	 or die("Unable to connect to MySQL");
	echo "Connected to MySQL<br>";
?>