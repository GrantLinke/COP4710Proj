<?php

if(isset($_POST["submit"])) {
	
    $email = $_POST["email"]
	$oldPW = $_POST["o_pass"];
	$newPW = $_POST["n_pass"];
	$confPW = $_POST["c_pass"];
	
	require_once 'dbhandler.php';
	require_once 'functions.php';
	
	if(userExists($email) !== false) {
		header("location: register.php?error=userExists");
		exit();
	}

    if($_SESSION["email"] != $email){
        header("location: changePassword.html?error=incorrectEmail")
        exit();
    }
	
	changePassword($email, $oldPW, $newPW, $confPW);
	
}