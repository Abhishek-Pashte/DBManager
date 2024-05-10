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
        $sql="DELETE FROM $tablename";
        if (mysqli_query($con, $sql)) {
            echo "<script type=text/javascript> alert('All Record DELETED Successfully')
                location.href='/DBManagerV2/Table/TableDetails.php?userdb=$dbname&usertable=$tablename'</script></script>";
        }
    }
?>