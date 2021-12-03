<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "libDB";

// Create connection
$conn = new mysqli_connect($servername, $username, $password);

if(!$conn) {
	die("Connection failed: " . mqsqli_connect_error());
}

