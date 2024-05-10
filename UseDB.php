<?php
    echo "userdb = ".$_GET['userdb'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = $_GET['userdb'];
  
    // Create database connection
    $con = new mysqli($servername, $username, $password, $dbname);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    else{
        echo "<script> location.href='ShowTables.php';</script>";
    }
?>