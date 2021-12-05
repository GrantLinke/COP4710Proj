<?php

if(isset($_POST["submit"])) {
	$email = $_POST["email"];
	$pwd = $_POST["password"];
	$role = $_POST["role"];
	
	require_once 'dbhandler.php';
	require_once 'functions.php';
	
	if(userExists($conn, $email, $role) !== false) {
		header("location: register.html?error=userExists");
		exit();
	}
	
	createUser($conn, $email, $pwd, $role);
	echo "something wrong";
	
}