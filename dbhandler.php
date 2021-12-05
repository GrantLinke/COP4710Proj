<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "libDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if(!$conn) {
	die("Connection failed: " . mqsqli_connect_error());
}

