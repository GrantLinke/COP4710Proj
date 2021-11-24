<!DOCTYPE html>
<html>
  
<head>
    <title>Insert Page page</title>
</head>
  
<body>
    <center>
        <?php
        $servername = "localhost";
        $username = "username";
        $password = "password";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password);
          
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
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
        $sql = "INSERT INTO Form  VALUES ('$classname', 
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
    </center>
</body>
  
</html>