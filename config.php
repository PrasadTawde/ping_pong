<?php
	$servername = "localhost";
	$username = "root";
	$password = "";

	$dbh = new PDO("mysql:host=$servername;dbname=ping_pong", $username, $password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>