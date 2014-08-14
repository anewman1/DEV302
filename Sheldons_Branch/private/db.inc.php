<?php
	$database = "dev302_shop";	// name of database
	$hostname = "localhost";	// name of host
	$username = "root";		// dbhost username
	$password = "root";		// dbhost password
	
	$pdo = new PDO("mysql:hostname=$hostname;dbname=$database", $username, $password);
?>