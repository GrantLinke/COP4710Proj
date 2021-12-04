<?php

function userExists($conn, $email)
{
	$sql = "SELECT * FROM staff where email = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: register.php?error=stmtFailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt)
	
	$resultOne = mysqli_stmt_get_result($stmt);
	
	$sql2 = "SELECT * FROM professors where email = ?;";
	$stmt2 = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt2, $sql2)) {
		header("location: register.php?error=stmtFailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt2, "s", $email);
	mysqli_stmt_execute($stmt2);
	
	$resultTwo = mysqli_stmt_get_result($stmt);
	
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

function createUser($conn, $email, $password, $role)
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
	
	if($role == "professors") { header("location: home.html"); }
	else { header("location: adminPage.php"); } 
	
	exit();
}

function login($conn, $password, $email)
{
	$sql = "SELECT * FROM staff WHERE email=? AND password=?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: login.html?error=stmtFailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ss" $email, $password);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$sql2 = "SELECT * FROM professors WHERE email=? AND password=?;";
	$stmt2 = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt2, $sql2)) {
		header("location: login.html?error=stmtFailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt2, "ss" $email, $password);
	mysqli_stmt_execute($stmt2);
	$result2 = mysqli_stmt_get_result($stmt2);

	$row = mysqli_fetch_assoc($result);	// row represents staff
	$row2 = mysqli_fetch_assoc($result2); // row2 represents professors

	if($row == null && $row2 == null){ 
		echo "Incorrect username/password";
		header("location: login.html?error=incorrectLogin");
		exit();
	}
	else if($row){	// if we need more session variables we declare them here
		session_start();
		$_SESSION["email"] = $email;
		header("location: adminPage.html");
		exit();
	}
	else{
		session_start();
		$_SESSION["email"] = $email;
		header("location: home.html");
		exit();
	}
}

function changePassword($conn, $email, $oldPW, $newPW, $confPW){
	if($newPW != $confPW){
		header("location: changePassword.html?error=passwordMismatch")
		exit();
	}

	$sql = "SELECT password FROM staff where email = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: register.php?error=stmtFailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt)
	
	$result = mysqli_stmt_get_result($stmt);

	if($result == $oldPW){
		$sql2 = "UPDATE staff SET password = ? WHERE password = ?;";
		if (!mysqli_stmt_prepare($stmt, $sql2)) {
			header("location: register.php?error=stmtFailed");
			exit();
		}
		
		mysqli_stmt_bind_param($stmt2, "ss", $newPW, $oldPW);
		mysqli_stmt_execute($stmt2)
		mysqli_stmt_close($stmt2);
		mysqli_stmt_close($stmt);
		echo "Password Successfully changed"
		header("location: home.html");
		exit();
	}

}

function deleteAdmin($conn, $email, $password){
	$sql = "DELETE FROM staff WHERE email = ? AND password = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: deleteAdmin.html?error=stmtFailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt, "ss", $email, $password);
	mysqli_stmt_execute($stmt)
	mysqli_stmt_close($stmt);
	echo "User successfully deleted.";
	header("location: adminPage.html");
	exit();
}