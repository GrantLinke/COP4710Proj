<?php 
    include('config/constants.php');

    $email = $_GET['email'];
    $semester = $_GET['semester'];
    $class = $_GET['class'];

    $sql = "DELETE FROM form WHERE email = ? AND semester = ? AND class = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $semester, $class);
    $stmt->execute();
    $res = $stmt->get_result();

    $sql1 = "SELECT * FROM form WHERE email=? AND semester=?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("ss", $email, $semester);
    $stmt1->execute();
    $res1 = $stmt1->get_result();

    header('location:'.SITEURL."editForm.php?semester=".$semester."&email=".$email);
    //header('location:'.SITEURL."viewForms.php");
?>