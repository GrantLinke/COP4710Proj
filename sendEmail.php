<?php

	$deadline = $_POST["deadline"];
	
	require_once 'dbhandler.php';
	require_once 'functions.php';
	
	deadlineEmail($conn, $deadline);

?>