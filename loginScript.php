<?php

if(isset($_POST["submit"])) {
	
	$userE = $_POST["email"];
	$pwd = $_POST["password"];
	
	require_once 'dbhandler.php';
	require_once 'functions.php';

	login($conn, $userE, $pwd);
}