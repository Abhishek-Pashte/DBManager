<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "AdminDB";
  
    // Create database connection
    $con = new mysqli($servername, $username, $password, $dbname);
    if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
    }
?>