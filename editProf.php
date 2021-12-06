<?php 
// TODO: Add comments to the pages

    include('config/constants.php');
?>

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
                <li><a href="adminPage.html" class="left">Admin Home</a></li>
                <li><a href="logout.php" class="right">Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="wrapper">

            <?php 
                $id = $_GET['id'];

                ?> <h1>Edit Professor</h1> <br><?php

                $sql = "SELECT * FROM staff_info WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $res = $stmt->get_result();

                if ($res == true)
                {
                    if (mysqli_num_rows($res) > 0)
                    {

                        while ($rows = mysqli_fetch_assoc($res))
                        {
                            $fname = $rows['fName'];
                            $lname = $rows['lName'];
                            $email = $rows['email'];

                            ?>

                            <form action="" method="POST">
                                <table class="">
                                    <tr>
                                        <td>First Name: </td>
                                        <td>
                                            <input type="text" name="fname" value="<?php echo $fname; ?>" required>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Last Name: </td>
                                        <td>
                                            <input type="text" name="lname" value="<?php echo $lname; ?>" required>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Email: </td>
                                        <td>
                                            <input type="text" name="email" value="<?php echo $email; ?>" required>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <a href="<?php echo SITEURL; ?>viewProf.php" class="buttons">Back</a>
                                            <input type="submit" name="submit" value="Update Professor" class="buttons">
                                        </td>
                                    </tr>

                                </table>
                            </form>

                             <?php
                        }
                    }
                }
                if (isset($_POST['submit']))
                {
                    $email = $_POST['email'];
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $sql = "UPDATE staff_info SET
                            fName = ?,
                            lName = ?,
                            email = ?
                            WHERE id=?";
            
                    $stmt = $conn->prepare($sql);
                    ?>

                    <h1><?php echo $conn->error; ?></h1>

                    <?php
                    //$stmt->bind_param("ssssssss", $class, $title, $author, $isbn, $edition, $publisher, $email, $semester);
                    $stmt->bind_param("sssi", $fname, $lname, $email, $id);
                    //$stmt->bind_param("sss", $title, $email, $semester); <input type="hidden" name="id" value="<?php echo $id; ">
                    $stmt->execute();
            
                    header('location:'.SITEURL."viewProf.php");
                    //header("Refresh:0");
                }

                            ?>
                            <br>
        </div>
    </div>
        
    <?php include('partials/footer.php'); ?>
</body>