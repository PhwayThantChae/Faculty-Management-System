<?php
	$servername = "localhost";
	$dbname = "php_test";
	$name = "root";
	$password = "admin";
	
	
	$conn  = new mysqli($servername,$name,$password,$dbname);
	
	if($conn->connect_error){
		die("Connection Failed : ". $conn->connect_error);
	}
	
	?>