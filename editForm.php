<?php 
// TODO: Add comments to the pages

    include('config/constants.php');

    if (isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $semester = $_POST['semester'];
        $class = $_POST['class'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $edition = $_POST['edition'];
        $publisher = $_POST['publisher'];

        $sql = "UPDATE form SET
                book_title = ?,
                author_names = ?,
                isbn = ?,
                edition = ?,
                publisher = ?
                WHERE email = ? AND semester = ? AND class = ?";

        $stmt = $conn->prepare($sql);
        //$stmt->bind_param("ssssssss", $class, $title, $author, $isbn, $edition, $publisher, $email, $semester);
        $stmt->bind_param("ssssssss", $title, $author, $isbn, $edition, $publisher, $email, $semester, $class);
        //$stmt->bind_param("sss", $title, $email, $semester);
        $stmt->execute();

        //header('location:'.SITEURL."editForm.php?semester=".$semester."&email=".$email);
        header("Refresh:0");
    }
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
                <li><a href="home.php" class="left">Home</a></li>
                <li><a href="logout.php" class="right">Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="wrapper">

            <?php 
                $semester = $_GET['semester'];
                $email = $_GET['email'];

                ?> <h1>Edit Book Order Form for <?php echo $semester ?></h1> <?php

                $sql = "SELECT * FROM form WHERE email=? AND semester=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $email, $semester);
                $stmt->execute();
                $res = $stmt->get_result();

                if ($res == true)
                {
                    if (mysqli_num_rows($res) > 0)
                    {

                        while ($rows = mysqli_fetch_assoc($res))
                        {
                            $class = $rows['class'];
                            $title = $rows['book_title'];
                            $author = $rows['author_names'];
                            $isbn = $rows['isbn'];
                            $edition = $rows['edition'];
                            $publisher = $rows['publisher'];

                            ?>

                            <form action="" method="POST">
                                <table class="">
                                    <tr>
                                        <td>Class Code: </td>
                                        <td>
                                            <p name="class"><?php echo $class; ?></p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Book Title: </td>
                                        <td>
                                            <input type="text" name="title" value="<?php echo $title; ?>" required>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Author: </td>
                                        <td>
                                            <input type="text" name="author" value="<?php echo $author; ?>" required>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>ISBN: </td>
                                        <td>
                                            <input type="text" name="isbn" value="<?php echo $isbn; ?>" required>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Edition: </td>
                                        <td>
                                            <input type="text" name="edition" value="<?php echo $edition; ?>" required>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Publisher: </td>
                                        <td>
                                            <input type="text" name="publisher" value="<?php echo $publisher; ?>" required>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <input type="hidden" name="email" value="<?php echo $email; ?>">
                                            <input type="hidden" name="semester" value="<?php echo $semester; ?>">
                                            <input type="submit" name="submit" value="Update Class" class="buttons">
                                            <a href="<?php echo SITEURL; ?>deleteClass.php?semester=<?php echo $semester; ?>&email=<?php echo $email; ?>&class=<?php echo $class; ?>" class="button" onclick="return confirm('Are you sure you want to Delete this Class?');">Delete Class</a>
                                        </td>
                                    </tr>

                                </table>
                            </form>

                             <?php
                        }
                    }
                }

                            ?>
            <a href="<?php echo SITEURL; ?>viewForms.php" class="buttons">Back</a>
            <a href="<?php echo SITEURL; ?>addClass.php?semester=<?php echo $semester; ?>&email=<?php echo $email; ?>" class="buttons">Add New Class</a>
        </div>
    </div>
        
    <?php include('partials/footer.php'); ?>
</body>