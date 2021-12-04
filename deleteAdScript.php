<?php

if(isset($_POST["submit"])) {
	
    $email = $_POST["email"]
	$password = $_POST["password"];
	$delete = $_POST["delete"];
	
	require_once 'dbhandler.php';
	require_once 'functions.php';
	
	if(userExists($email) == false) {
		header("location: register.php?error=userDNE");
		exit();
	}

    if($_SESSION["email"] != $email){
        header("location: changePassword.html?error=incorrectEmail")
        exit();
    }
	
	changePassword($conn, $email, $oldPW, $newPW, $confPW);
	
}