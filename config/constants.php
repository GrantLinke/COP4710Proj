<?php 
    session_start();

    define('SITEURL', 'http://localhost/COP4710Proj-main/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'libDB');
    
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($db));
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($db));
?>
