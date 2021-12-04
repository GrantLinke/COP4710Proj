<!DOCTYPE HTML>
<html>

<head>
	<title>Final List Page</title>
</head>

<body>
     
    <h1> Here is the list for that semester </h1>
    <br>

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
		
		$semester = $_REQUEST['semester'];

        $sql = "SELECT * FROM form WHERE Semester= '$semester'";
        $result = $conn->query($sql);
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $class = $row['class'];
                $semester = $row['semester'];
                $isbn = $row['isbn'];
                $book_title = $row['book_title'];
                $author_names = $row['author_names'];
                $edition = $row['edition'];
                $publisher = $row['publisher'];

              ?>
              <h2><?php echo $class, ", ", $semester, ", " , $isbn, ", ", $book_title, ", ", $author_names, ", ", $edition, ", ", $publisher ;?></h2>

            <?php 
            }
           
        }

        mysqli_close($conn);

        ?>

    <br>

    <div class="back">
        <form action="adminPage.html" method="post">
            <input type="submit" name="back" value="Back">
        </form>
    </div>

    <div class="logout">
		<a href="login.html">
			<button type="button" id="logoutButton" class="buttons" onclick="logoutfunction"> Log Out </button>
		</a>
	</div>

</body>

</html>