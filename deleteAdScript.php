<?php

if(isset($_POST["submit"])) {
	
    $email = $_POST["email"]
	$password = $_POST["password"];
	$delete = $_POST["delete"];
	
	require_once 'dbhandler.php';
	require_once 'functions.php';
	
	if(userExists($email) == false) {
		header("location: deleteAdmin.html?error=userDNE");
		exit();
	}
	
    if($delete != "DELETE"){
        header("location: deleteAdmin.html?error=deleteError");
        exit();
    }

	deleteAdmin($conn, $email, $password);
	
}