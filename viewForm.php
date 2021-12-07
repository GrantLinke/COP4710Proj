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
                <li><a href="home.php" class="left">Home</a></li>
                <li><a href="logoutScript.php" class="right">Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="wrapper">

            <?php 
                $semester = $_GET['semester'];
                $email = $_GET['email'];

                ?> <h1>Book Order Form for <?php echo $semester ?></h1><br><br> <?php

                $sql = "SELECT * FROM form WHERE email=? AND semester=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $email, $semester);
                $stmt->execute();
                $res = $stmt->get_result();

                if ($res == true)
                {
                    if (mysqli_num_rows($res) > 0)
                    {
                        ?> 
                            <table class="tbl1">
                                    <thead>
                                        <tr>
                                            <th>Class Code: </th>
                                            <th>Book Title: </th>
                                            <th>Author: </th>
                                            <th>ISBN: </th>
                                            <th>Edition: </th>
                                            <th>Publisher: </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        <?php
                        while ($rows = mysqli_fetch_assoc($res))
                        {
                            $class = $rows['class'];
                            $title = $rows['book_title'];
                            $author = $rows['author_names'];
                            $isbn = $rows['isbn'];
                            $edition = $rows['edition'];
                            $publisher = $rows['publisher'];

                            ?>
                                    <tr>
                                        <td>
                                            <p name="class"><?php echo $class; ?></p>
                                        </td>
                                        <td>
                                            <p name="title"><?php echo $title; ?></p>
                                        </td>
                                        <td>
                                            <p name="author"><?php echo $author; ?></p>
                                        </td>
                                        <td>
                                            <p name="isbn"><?php echo $isbn; ?></p>
                                        </td>
                                        <td>
                                            <p name="edition"><?php echo $edition; ?></p>
                                        </td>
                                        <td>
                                            <p name="publisher"><?php echo $publisher; ?></p>
                                        </td>
                                    </tr>

                             <?php
                        }
                    }
                }

                            ?>
                            </tbody>
                            </table>
                            <br>
            <a href="<?php echo SITEURL; ?>viewForms.php" class="buttons">Back</a>
        </div>
    </div>
        
    <?php include('partials/footer.php'); ?>
</body>
