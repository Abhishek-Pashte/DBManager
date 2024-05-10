<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = $_GET['dbname'];
    $tablename=$_GET['tablename'];
  
    // Create database connection
    $con = new mysqli($servername, $username, $password, $dbname);
    if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
    }

    else{
        $updateCol=$_POST['updateCol'];
        $updateValue=$_POST['updateValue'];
        $conditionCol=$_POST['conditionCol'];
        $conditionValue=$_POST['conditionValue'];
        $sql="Update $tablename SET $updateCol = '$updateValue' where $conditionCol = '$conditionValue';" ;
        echo "SQL = $sql";

        if(mysqli_query($con,$sql)){
            echo "<script> alert('Updated successfully'); 
            location.href='TableDetails.php?userdb=$dbname&usertable=$tablename';</script>";
        }
        else{
            echo "Error = $con->error";
        }
    }
?>