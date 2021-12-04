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
        $dbname = "libDb";

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

        // Performing insert query execution
        $sql = "INSERT INTO form  VALUES ('$classname',
            '$semester','$isbn','$booktitle', '$author', '$edition', '$publisher')";

        if(mysqli_query($conn, $sql)){
            echo "<h3>Your form submitted succesfully</h3>";
        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($conn);
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