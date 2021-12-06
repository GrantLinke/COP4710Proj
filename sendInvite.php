<?php

	$email = $_POST["email"];
	
	require_once 'dbhandler.php';
	require_once 'functions.php';
	
	inviteEmail($conn, $email);

?>