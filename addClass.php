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
                <li><a href="home.php" class="left">Home</a></li>
                <li><a href="logout.php" class="right">Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add New Class to Form</h1>

            <?php 
                $semester = $_GET["semester"];
                $email = $_GET["email"];
            ?>
                <form action="" method="POST">
                    <table class="">
                        <tr>
                            <td>Class Code: </td>
                            <td>
                                <input type="text" name="class" required>
                            </td>
                        </tr>

                        <tr>
                            <td>Book Title: </td>
                            <td>
                                <input type="text" name="title" required>
                            </td>
                        </tr>

                        <tr>
                            <td>Author: </td>
                            <td>
                                <input type="text" name="author" required>
                            </td>
                        </tr>

                        <tr>
                            <td>ISBN: </td>
                            <td>
                                <input type="text" name="isbn" required>
                            </td>
                        </tr>

                        <tr>
                            <td>Edition: </td>
                            <td>
                                <input type="text" name="edition" required>
                            </td>
                        </tr>

                        <tr>
                            <td>Publisher: </td>
                            <td>
                                <input type="text" name="publisher" required>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="4">
                                <input type="hidden" name="email" value="<?php echo $email; ?>">
                                <input type="hidden" name="semester" value="<?php echo $semester; ?>">
                                <input type="submit" name="submit" value="Add Class" class="buttons">
                                <a href="<?php echo SITEURL; ?>editForm.php?semester=<?php echo $semester; ?>&email=<?php echo $email; ?>" class="buttons">Back</a>
                            </td>
                        </tr>

                    </table>
                </form>
                <?php 
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

                        $sql = "SELECT class FROM form WHERE email = ? AND semester = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ss", $email, $semester);
                        $stmt->execute();
                        $res = $stmt->get_result();

                        $classArray = array();
                        
                        if ($res == true)
                        {
                            if (mysqli_num_rows($res) > 0)
                            {
                                while ($rows = mysqli_fetch_assoc($res))
                                {
                                    $prevClass = $rows['class'];
                                    array_push($classArray, $prevClass);
                                }
                            }
                        }

                        if (!in_array($class, $classArray))
                        {
                            $sql1 = "INSERT INTO form (book_title, author_names, isbn, edition, publisher, email, semester, class) VALUES (?,?,?,?,?,?,?,?)";
                            $stmt1 = $conn->prepare($sql1);
                            $stmt1->bind_param("ssssssss", $title, $author, $isbn, $edition, $publisher, $email, $semester, $class);
                            $stmt1->execute();
                    
                            header('location:'.SITEURL."editForm.php?semester=".$semester."&email=".$email);
                            //header("Refresh:0");
                        }
                        else
                        {
                            ?> <h1>Class already has a Textbook assigned, please choose another Class</h1> <?php
                        }
                    }
                ?>
        </div>
    </div>
