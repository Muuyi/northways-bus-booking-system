<?php
	session_start();
	define('dbHost','localhost');
	define('dbUser','root');
	define('dbName', 'travmate');
	define('dbPass', '');
	$con = new mysqli(dbHost,dbUser,dbPass,dbName);
?>