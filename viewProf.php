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
                <li><a href="adminPage.html" class="left">Admin Home</a></li>
                <li><a href="logout.php" class="right">Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="wrapper">
            <table class="tbl">
                <tr>
                    <th>Professor Name</th>
                    <th>Professor Email</th>
                </tr>

                        
                <?php

                    //Finds all the forms for the current logged in professor
                    $sql = "SELECT * FROM staff_info";

                    $res = mysqli_query($conn, $sql);

                    //If the sql query was successful then loop through all the forms and print out the table information for each form
                    if($res==TRUE)
                    {
                        $count = mysqli_num_rows($res);

                        if($count>0)
                        {
                            
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                $name=$rows['fName'] . ' ' . $rows['lName'];
                                $email=$rows['email'];
                                $id=$rows['id'];
                                    ?>
                                        
                                    <tr>
                                        <td><?php echo $name; ?> </td>
                                        <td><?php echo $email; ?></td>
                                        <td>
                                            <form method="post" action="sendInvite.php">
                                                <input type="text" hidden name=<?php echo $email; ?>>
                                                <input type="submit" class="buttons" id="indivRemind" value="Send email">
                                            </form><br>
                                            <a href="<?php echo SITEURL; ?>editProf.php?id=<?php echo $id; ?>" class="buttons">Edit Professor</a>
                                            <a href="<?php echo SITEURL; ?>deleteProf.php?id=<?php echo $id; ?>" class="buttons" onclick="return confirm('Are you sure you want to Delete this Professor?');">Delete Professor</a>
                                        </td>
                                    </tr>

                                    <?php
                                }                               
                            }
                        }
                        else
                        {
                    
                        }

                ?>


                        
            </table>
            <br>
            <a href="<?php echo SITEURL; ?>adminPage.html" class="buttons">Back</a>
            <a href="<?php echo SITEURL; ?>addProf.php" class="buttons">Add New Professor</a>
        </div>
    </div>
    <?php include('partials/footer.php'); ?>
</body>