<?php

if(isset($_POST["submit"])) {
	
	$email = $_POST["email"];
	$pwd = $_POST["password"];
	
	require_once 'dbhandler.php';
	require_once 'functions.php';

	login($conn, $email, $pwd);
}