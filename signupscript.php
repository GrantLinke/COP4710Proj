<?php

if(isset($_POST["submit"])) {
	
	$email = $_POST["email"];
	$pwd = $_POST["name"];
	
	require_once 'dbhandler.php';
	require_once 'functions.php';
	
	if(userExists($email) !== false) {
		header("location: register.php?error=userExists");
		exit();
	}
	
	createUser($conn, $email, $pwd, $role);
	
}