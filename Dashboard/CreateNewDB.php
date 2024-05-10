<?php
    session_start();
    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "DB_manager";
    // $con = new mysqli($servername, $username, $password, $dbname);
    // if ($con->connect_error) {
    //     die("Connection failed: " . $con->connect_error);
    // }
    include("AdminConnect.php");
    if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
    }
    else{
        if($_POST['dbname'])
        {
            $sql = "CREATE DATABASE ".$_POST['dbname'];
            if ($con->query($sql) === TRUE)
            {
                echo "Database created successfully";
                echo "<br>";
                echo "email = ".$_SESSION['email'];
                echo "<br>";
                echo "dbname = ".$_POST['dbname'];
                echo "<br>";

                $session_email=$_SESSION['email'];
                $session_dbname=$_POST['dbname'];
                // $sql_inner_query="INSERT INTO `db_data` (`userid`, `email`, `dbname`, `timestamp`) VALUES ('".$_SESSION['userid']."', '".$_SESSION['email']."', '".$_POST['dbname']."', current_timestamp());";
                // $sql_inner_query="INSERT INTO db_data (userid, email, dbname, timestamp) VALUES ('$userid', '$email', '$dbname', NULL);";
                $sql_inner_query="INSERT INTO user_database_info(email, dbname, timestamp) VALUES ('$session_email', '$session_dbname', NULL);";
                if($con->query($sql_inner_query)){
                    echo "<html><head></head><script>alert('DataBase created successfully!!!');
                        location.href='/DBManagerV2/Dashboard/Dashboard.php'</script></html>";
                }
                else{
                    echo "no insertion";
                }
            } 
            else 
            {
                            
                // Design This page....
                echo "<html>
                        <head><link rel='stylesheet' href='/DBManagerV2/CSS/style.css'></head>
                        <body>
                            <div class='error-box'>
                                <h1>ERROR!</h1>
                                <h3>Error Occured</h3>
                                $con->error;
                                <br><br><br>
                                <h2><span style='border:2px solid white; border-radius:5px; color:white; padding:10px;'><a href='/DBManagerV2/Dashboard/Dashboard.php' style='color:yellow;'> GO BACK </a></span></h2>
                                <br><br><br>
                            </div>
                        </body>
                    </html>";

            }
            
        }
        else{
            echo "<html><head><script>alert('Enter DB name ');
                location.href='/DBManagerV2/Dashboard/Dashboard.php'</script></head></html>";
        }
        
    }
    $con->close();
?>
