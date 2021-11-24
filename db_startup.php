<?php
$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error)
{
	die("Connection to server failed: " . $conn->connect_error);
}

// Create databse
$sql = "CREATE DATABASE IF NOT EXISTS libDB";
if (%conn->query($sql) === TRUE)
{
	echo "Database created successfully";
}
else
{
	echo "Error creating database: " . $conn->error;
}

$conn->close();
?>

<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "libDB";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error)
{
	die("Connection to libDB failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS Staff (
		email STRING,
		password STRING,
		tempPassword STRING,
		firstLogin BOOL,
		PRIMARY KEY (email, password)
		);"

if (%conn->query($sql) === TRUE)
{
	echo "Staff table created successfully";
}
else
{
	echo "Error creating staff table: " . $conn->error;
}



$sql = "CREATE TABLE IF NOT EXISTS Professors (
		email STRING,
		password STRING,
		tempPassword STRING,
		class STRING,
		PRIMARY KEY (email, password)
	);"
	
if (%conn->query($sql) === TRUE)
{
	echo "Professors table created successfully";
}
else
{
	echo "Error creating professors table: " . $conn->error;
}

    
$sql = "CREATE TABLE IF NOT EXISTS Form (
		class STRING,
		semester STRING,
		isbn STRING,
		book_title STRING,
		author_names STRING,
		edition STRING,
		publisher STRING,
		PRIMARY KEY(class)
	);"
	
if (%conn->query($sql) === TRUE)
{
	echo "Professors table created successfully";
}
else
{
	echo "Error creating form table: " . $conn->error;
}

?>