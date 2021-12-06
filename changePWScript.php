<?php

if(isset($_POST["submit"])) {
	
    $email = $_POST["email"];
	$oldPW = $_POST["o_pass"];
	$newPW = $_POST["n_pass"];
	$confPW = $_POST["c_pass"];
	
	require_once 'dbhandler.php';
	require_once 'functions.php';
	
	if(userExists($conn, $email, getRole($conn, $email)) === false) {
		header("location: register.php?error=userDNE");
		exit();
	}

	if($newPW != $confPW){
		header("location: changePassword.html?error=passwordMismatch");
		exit();
	}
	
	changePassword($conn, $email, $oldPW, $newPW, $confPW);
	
}