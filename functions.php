<?php

function userExists($conn, $email, $role)
{
	$sql = "";
	if($role == "professors")
	{
		$sql = "SELECT * FROM professors WHERE email = '$email';";
	}
	else
	{
		$sql = "SELECT * FROM staff WHERE email = '$email';";
	}
	
	if (!($result = mysqli_query($conn, $sql))) {
		echo $sql . " Didnt work " . mysqli_error($conn);
		//header("location: register.html?error=stmtFailed");
		exit();
	}
	
	if($row = mysqli_fetch_assoc($result)) {
		return $row;
	}
	else {
		return false;
	}
	
	mysqli_stmt_close($stmt);
}

function createUser($conn, $email, $password, $role)
{
	$sql = "";
	if($role == "professors")
	{
		$sql = "INSERT INTO professors VALUES ('$email', '$password', 'null', 'null');";
	}
	else
	{
		$sql = "INSERT INTO staff VALUES ('$email', '$password', 'null', false);";
	}

	if (!mysqli_query($conn, $sql)) {
		echo $sql . " Didnt work " . mysqli_error($conn);
		//header("location: register.php?error=stmtFailed");
		exit();
	}
	
	if($role == "professors") {
		session_start();
		$_SESSION["email"] = $email;
		header("location: home.html"); 
	}
	else {
		session_start();
		$_SESSION["email"] = $email;
		header("location: adminPage.html"); 
	} 
	
	exit();
}

function login($conn, $email, $password)
{
	$role = getRole($conn, $email);
	$row = userExists($conn, $email, $role);

	if($row === false){ header("location: login.html?error=userDNE"); }

	if($password == $row["password"]){ /* checks if passwords match */
		session_start();
		$_SESSION["email"] = $email;
		if($role == "professors"){
			header("location: home.html");
		}
		else{
			header("location: adminPage.html");
		}
	}
	else{
		echo " Didnt work " . mysqli_error($conn);
		echo implode(" ", $row);
	}

}

function changePassword($conn, $email, $oldPW, $newPW, $confPW){
	if($newPW != $confPW){
		header("location: changePassword.html?error=passwordMismatch");
		exit();
	}

	$sql = "SELECT password FROM staff where email = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: register.php?error=stmtFailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_assoc($result);

	if($row["password"] == $oldPW){
		$sql2 = "UPDATE staff SET password = ? WHERE password = ?;";
		if (!mysqli_stmt_prepare($stmt, $sql2)) {
			header("location: register.php?error=stmtFailed");
			exit();
		}
		
		mysqli_stmt_bind_param($stmt2, "ss", $newPW, $oldPW);
		mysqli_stmt_execute($stmt2);
		mysqli_stmt_close($stmt2);
		mysqli_stmt_close($stmt);
		echo "Password Successfully changed";
		header("location: home.html");
		exit();
	}

}

function deleteAdmin($conn, $email, $password){
	$sql = "DELETE FROM staff WHERE email = '$email' AND password = '$password';";

	if (!mysqli_query($conn, $sql)) {
		header("location: deleteAdmin.html?error=stmtFailed");
		exit();
	}
	else{
		header("location: adminPage.html");
		exit();
	}
	exit();
}

function deadlineEmail($conn, $deadline){
	$sql = "SELECT email FROM professors;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: adminPage.html?error=stmtFailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt, "ss", $email, $password);
	mysqli_stmt_execute($stmt);

	// loops thru row to get each email, then sends each email.
	while($row = mysqli_fetch_assoc($result)){
	$to = $row["email"];
	$subject = "Deadline for book submission: " . $deadline;
	$message = "This is a reminder email sent to all professors letting them
					know that the book list submission deadline is on " . $deadline;
	$headers = "From: noreply@libDB.com";
	mail($to, $subject, $message, $headers);
	}

	mysqli_stmt_close($stmt);
	header("location: adminPage.html?status=emailSent");
}

function getRole($conn, $email){
	{
		$sql = "SELECT * FROM staff WHERE email = '$email';";
		$stmt = mysqli_query($conn, $sql);
		$result = mysqli_fetch_assoc($stmt);
		if($result) {
			return "staff";
		}
		else {
			return "professors";
		}
		
		mysqli_stmt_close($stmt);
	}
}