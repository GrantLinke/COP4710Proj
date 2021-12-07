<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Order Website</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="menu centerText">
        <div class="wrapper">
            <ul>
                <li><a href="adminPage.html" class="left">Admin Homepage</a></li>
                <li><a href="logoutScript.php" class="right">Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add New Professor</h1>

            <form action="" method="POST">
                                <table class="">
                                    <tr>
                                        <td>First Name: </td>
                                        <td>
                                            <input type="text" name="fname" required>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Last Name: </td>
                                        <td>
                                            <input type="text" name="lname" required>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Email: </td>
                                        <td>
                                            <input type="text" name="email" required>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <a href="<?php echo SITEURL; ?>viewProf.php" class="buttons">Back</a>
                                            <input type="submit" name="submit" value="Add Professor" class="buttons">
                                        </td>
                                    </tr>

                                </table>
                            </form>
                <?php 
                    if (isset($_POST['submit']))
                    {
                        $email = $_POST['email'];
                        $fname = $_POST['fname'];
                        $lname = $_POST['lname'];

                        $sql = "SELECT email FROM staff_info WHERE email = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $res = $stmt->get_result();
                        
                        if ($res == true)
                        {
                            if (mysqli_num_rows($res) > 0)
                            {
                                ?> <h1>Email already assigned to a Professor, pick another</h1> <?php
                            }
    
                        }

                        $sql1 = "INSERT INTO staff_info (email, lName, fName) VALUES (?,?,?)";
                        $stmt1 = $conn->prepare($sql1);
                        $stmt1->bind_param("sss", $email, $lname, $fname);
                        $stmt1->execute();

                        header('location:'.SITEURL."viewProf.php");
                    }
                ?>
        </div>
    </div>
