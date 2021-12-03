<?php

function userExists($email)
{
	$sql = "SELECT * FROM staff where email = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: register.php?error=stmtFailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt)
	
	$resultOne mysqli_stmt_get_result($stmt);
	
	$sql2 = "SELECT * FROM professors where email = ?;";
	$stmt2 = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt2, $sql2)) {
		header("location: register.php?error=stmtFailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt2, "s", $email);
	mysqli_stmt_execute($stmt2);
	
	$resultTwo mysqli_stmt_get_result($stmt);
	
	if($row = mysqli_fetch_assoc($resultOne)) {
		return $row;
	}
	else if($row = mysqli_fetch_assoc($resultTwo)) {
		return $row;
	}
	else {
		return false;
	}
	
	mysqli_stmt_close($stmt);
	mysqli_stmt_close($stmt2);
}

function createUser($email, $password, $role)
{
	$sql = "INSERT INTO ? (email, password) VALUES (?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: register.php?error=stmtFailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt, "sss", $role, $email, $password);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location: home.html");
	exit();
}

function check_login($password, $email)
{
	$sql = "SELECT COUNT(*)
	FROM Professors P, Staff S
	WHERE P.email=? AND P.password=? OR S.email=? AND S.password=?"
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssss", $email, $password, $email, $password);
	$stmt->execute();
	$result=$stmt->get_result();
	if($result != 0){ return false; }
	else{ return true; }
}