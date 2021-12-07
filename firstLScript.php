<?php

if(isset($_POST["submit"])) {
	
	$userE = $_POST["email"];
	$oldPW = $_POST["password"];
    $newPW = $_POST["n_pass"];
    $confPW = $_POST["c_pass"];

	require_once 'dbhandler.php';
	require_once 'functions.php';

    changePassword($conn, $userE, $oldPW, $newPW);
    updateFLogin($conn, $userE, $newPW);
	login($conn, $userE, $newPW);
}