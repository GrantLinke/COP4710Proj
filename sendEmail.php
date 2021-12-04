<?php

if(isset($_POST["submit"])) {
	
	$deadline = $_POST["deadline"];
	
	require_once 'dbhandler.php';
	require_once 'functions.php';
	
	if(userExists($email) !== false) {
		header("location: register.php?error=userExists");
		exit();
	}
	
	deadlineEmail($conn, $deadline);
	
}