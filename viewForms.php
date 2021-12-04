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
            <table class="tbl">
                <tr>
                    <th>Email</th>
                    <th>Semester</th>
                    <th>Actions</th>
                </tr>

                        
                <?php
                    $email = "test@test.com";

                    $sql = "SELECT * FROM form WHERE email='$email' ORDER BY semester DESC";

                    $res = mysqli_query($conn, $sql);

                    if($res==TRUE)
                    {
                        $count = mysqli_num_rows($res);

                        if($count>0)
                        {
                            $semArray = array();
                            
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                $class=$rows['class'];
                                $email=$rows['email'];
                                $semester=$rows['semester'];
                                if (!in_array($semester, $semArray))
                                {
                                    ?>
                                        
                                    <tr>
                                        <td><?php echo $email; ?> </td>
                                        <td><?php echo $semester; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>viewForm.php?semester=<?php echo $semester; ?>&email=<?php echo $email; ?>" class="buttons">View Form</a>
                                            <a href="<?php echo SITEURL; ?>editForm.php?semester=<?php echo $semester; ?>&email=<?php echo $email; ?>" class="buttons">Edit Form</a>
                                            <a href="<?php echo SITEURL; ?>deleteForm.php?semester=<?php echo $semester; ?>&email=<?php echo $email; ?>" class="buttons" onclick="return confirm('Are you sure you want to Delete this Order Form?');">Delete Form</a>
                                        </td>
                                    </tr>

                                    <?php

                                    array_push($semArray, $semester);
                                }                               
                            }
                        }
                        else
                        {
                    
                        }
                    }

                ?>


                        
            </table>       
        </div>    
    </div>

    <?php include('partials/footer.php'); ?>
</body>