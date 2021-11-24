<?php
// define variables and set to empty values
$email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $password = test_input($_POST["password"]);
  $email = test_input($_POST["email"]);
  if(!check_login($password, $email))
  {
		echo "Email/password incorrect"
  }
  else{
	  
  }
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
?>