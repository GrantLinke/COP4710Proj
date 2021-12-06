<?php
if(isset($_POST["submit"])) {
	$email = $_POST["email"];
	$pwd = $_POST["password"];
	$role = "professors";
	
	require_once 'dbhandler.php';
	require_once 'functions.php';
	
	if(userExists($conn, $email, $role) !== false) {
		header("location: register.html?error=userExists");
		exit();
	}
	
	createUser($conn, $email, $pwd, $role);
	
}
if(isset($_POST["newAcc"])){
	$email = $_POST["email"];
	$pwd = $_POST["password"];
	$role = "staff";
	
	require_once 'dbhandler.php';
	require_once 'functions.php';
	
	if(userExists($conn, $email, $role) !== false) {
		header("location: register.html?error=userExists");
		exit();
	}
	
	createUser($conn, $email, $pwd, $role);
	
}