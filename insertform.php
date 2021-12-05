<!DOCTYPE html>
<html>

<head>
    <title>Insert Page page</title>
</head>

<body>
    <center>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "libDB";

        // Create connection
        $conn = new mysqli($servername, $username, $password,$dbname);

        if ($conn -> connect_errno) {
         echo "Failed to connect to MySQL: " . $conn -> connect_error;
         exit();
        }
        // Taking all values from the form data(input)
        $classname = $_REQUEST['classname'];
        $semester = $_REQUEST['semestername'];
        $booktitle = $_REQUEST['booktitle'];
        $author = $_REQUEST['authornames'];
        $edition =  $_REQUEST['edition'];
        $publisher = $_REQUEST['publisher'];
        $isbn = $_REQUEST['isbn'];

        $sql1 = "SELECT * FROM form WHERE class= '$classname'";
        $result = $conn->query($sql1);
        if($result->num_rows > 0)
        {
            echo "<h3>A book is already assigned for this class</h3>";
        ?>
            <a href="form.html">
            <input type="submit" name="form" value="Add New Form">
            </a>
        <?php    
        } 
        else
        {
            $sql = "INSERT INTO form  VALUES ('$classname',
            '$semester','$isbn','$booktitle', '$author', '$edition', '$publisher')";

            if(mysqli_query($conn, $sql)){
                echo "<h3>Your form submitted succesfully</h3>";  
        ?>
            <a href="form.html">
            <input type="submit" name="form" value="Add Another Form">
            </a>
        <?php
            } 
            else{
                echo "ERROR: Hush! Sorry $sql. "
                    . mysqli_error($conn);
            }

        }
        
        // Close connection
        mysqli_close($conn);
        ?>

    <div class="logout">
		<a href="login.html">
			<button type="button" id="logoutButton" class="buttons" onclick="logoutfunction"> Log Out </button>
		</a>
	</div>
    </center>
</body>

</html>