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
        $date = $_REQUEST['date'];
        $deadline = $_REQUEST['deadline'];

        $sql = "INSERT INTO reminder VALUES ('$deadline','$date')";
        $sql1 = "SELECT * FROM reminder";
        $sql2 = "DELETE FROM reminder";
        $result = $conn->query($sql1);
        if($result->num_rows > 0 )
        {
          $result2 = $conn->query($sql2);
          $result3 = $conn->query($sql);
          if($result3)
            echo "<h3>Your deadline added succesfully</h3>";
        }
        else
        {
          $result4 = $conn->query($sql);
          if($result4)
            echo "<h3>Your deadline added succesfully</h3>"; 
        }  

        
?>