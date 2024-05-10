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
        $col=$_POST['deleteCol'];
        $value=$_POST['deleteValue'];
        $sql="DELETE FROM $tablename where $col = '$value'";
        echo "SQL = $sql";
        if(mysqli_query($con,$sql)){
            echo "<script>alert('Record deleted successfully');
            location.href='/DBManagerV2/Table/TableDetails.php?userdb=$dbname&usertable=$tablename';</script>";
            

            //Work here not getting useremail


            
        }
        
        else{
            echo "Error $con->error";
        }
    }
?>