<?php 
    include('config/constants.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM staff_info WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();

    header('location:'.SITEURL."viewProf.php");
?>