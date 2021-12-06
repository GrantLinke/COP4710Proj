<?php 
    include('config/constants.php');

    $email = $_GET['email'];
    $semester = $_GET['semester'];

    $sql = "DELETE FROM form WHERE email = ? AND semester = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $semester);
    $stmt->execute();
    $res = $stmt->get_result();

    header('location:'.SITEURL."viewForms.php");
?>