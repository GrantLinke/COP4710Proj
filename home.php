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
                <li><a href="logoutScript.php" class="right">Logout</a></li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <div class="wrapper">
            <div id="loggedInDiv">
                <h2>Welcome Professor</h2><br>
            </div>
            
            <div id="intro">
                <p>Welcome to the Book Ordering application, you can either create a new book order form for this semester or view and edit an existing form if one was already created. To Create a new order form click the create button below, to View / Edit an existing form then click the View button below.</p><br>
            </div>
            
            <div id="homeForm">
                <div class="buttonBlocks_hidden centerText">
                </div>    

                <div id="newbookformbutton" class="buttonBlocks centerText">
                    Create a New Book Order Form:
                    
                    <form method="post" action="<?php echo SITEURL; ?>form.html">
                       <br> <button id="createButton" class="buttons" type="submit">Create</button>
                    </form>
                </div>
                
                <div id="viewbookformsbutton" class="buttonBlocks centerText">
                    View an existing Book Order Form:
                    
                    <form method="post" action="<?php echo SITEURL; ?>viewForms.php">
                       <br> <button id="viewButton" class="buttons" type="submit">View</button>
                    </form>
                </div>

                <div class="buttonBlocks_hidden centerText">
                </div>
                
            </div>

            <br>

            <div class="fix"></div>
        </div>
    </div>
        
    
    <?php include('partials/footer.php'); ?>
</body>
