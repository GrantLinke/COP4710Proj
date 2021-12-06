<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "libDB";

    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);

    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }

    $sql = "SELECT * FROM reminder";
    $sql1 = "SELECT email FROM professors";
	$result = $conn->query($sql);
    $result1 = $conn->query($sql1);
	if($result == false)
	{
		header("location: adminPage.html?error=stmtFailed");
		exit();
	}
	else
	{   
        $row1 = $result->fetch_assoc();
        $deadline = $row1["deadline"];
        $date = $row1["date"];
        if( strtotime($date) < strtotime('now') )
        {
            while($row = $result1->fetch_assoc())
            {
              $to = $row["email"];
              $subject = "---Automatic Reminder--- " . $deadline;
              $message = "This is a reminder email sent to all professors letting them know that the book list submission deadline is on " . $deadline;
              $headers = "From: ss.ege95@gmail.com";
              $mailsent = mail($to, $subject, $message, $headers);
            }
            header("location: adminPage.html?status=emailSent");
        }

	}	

	mysqli_close($conn);
	

    ?>