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
		$sql = "INSERT INTO staff VALUES ('$email', '', '$password', 1);";
	}

	if (!mysqli_query($conn, $sql)) {
		echo $sql . " Didnt work " . mysqli_error($conn);
		//header("location: register.php?error=stmtFailed");
		exit();
	}
	
	if($role == "professors") {
		session_start();
		$_SESSION["email"] = $email;
		header("location: home.php"); 
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
			header("location: home.php");
		}
		else{
			if($row["firstLogin"] == 1){
				header("location: firstLogin.html");
			}
			else{
				header("location: adminPage.html");
			}
		}
	}
	else{
		header("location: login.html?error=badLogin");
	}

}

function updateFLogin($conn, $email){
	$sql = "UPDATE staff SET tempPassword = 0 WHERE email = '$email';";
	if (!mysqli_query($conn, $sql)) {
		header("location: register.php?error=stmtFailed");
		exit();
	}
	echo "First login successful";
	exit();
}

function changePassword($conn, $email, $oldPW, $newPW){
	$sql = "SELECT password FROM staff where email = '$email';";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	if($row["password"] == $oldPW){
		$sql2 = "UPDATE staff SET password = '$newPW' WHERE email = '$email';";
		if (!mysqli_query($conn, $sql2)) {
			header("location: register.php?error=stmtFailed");
			exit();
		}
		echo "Password Successfully changed";

		header("location: adminPage.html");
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
	$sql = "SELECT email FROM professors";
	$result = $conn->query($sql);
	if($result == false)
	{
		header("location: adminPage.html?error=stmtFailed");
		exit();
	}
	else
	{
		while($row = $result->fetch_assoc())
		{
			$to = $row["email"];
			$subject = "Deadline for book submission: " . $deadline;
			$message = "This is a reminder email sent to all professors letting them know that the book list submission deadline is on " . $deadline;
			$headers = "From: ss.ege95@gmail.com";
			$mailsent = mail($to, $subject, $message, $headers);
		}
	}	

	// loops thru row to get each email, then sends each email.

	mysqli_close($conn);
	header("location: adminPage.html?status=emailSent");
}

function inviteEmail($conn, $email)
{
	$sql = "SELECT email FROM professors WHERE email = '$email'";
	$link = "http://localhost/login.html";
	$result = $conn->query($sql);
	if($result == false)
	{
		header("location: adminPage.html?error=stmtFailed");
		exit();
	}
	else
	{
			$to = $email;
			$subject = "Invitation for submitting a book request: " . $deadline;
			$message = "Hello Professor,
Please use this link to login/register to our database to submit a book request :" . $link . "
Thank you ";
			$headers = "From: ss.ege95@gmail.com";
			$mailsent = mail($to, $subject, $message, $headers);
	}	

	// loops thru row to get each email, then sends each email.

	mysqli_close($conn);
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
