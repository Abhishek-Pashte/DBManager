<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Show tables</title>
</head>

<body>
    <?php
    session_start();
    echo "<link rel='stylesheet' href='/DBManagerV2/CSS/style.css'>";
    $servername = "localhost";
    $adminname = "root";
    $password = "";
    $dbname = $_GET['userdb'];
    $useremail = $_SESSION['email'];
    $username=$_SESSION['name'];
    ?>
    <div id='header'>
    <span><p class="text-center text-white" style="font-size: 50px; font-weight: 700;">DB Manager</p></span>

        <div class='user-info'>
            <span style="font-weight: 100;">Username : </span>
            <?php echo "<span style='font-weight:700;'>$username</span>" ?><br>
            <span style="font-weight: 100;">E-mail ID : </span>
            <?php echo "<span style='font-weight:700;'>$useremail</span>" ?><br>
            <span style="font-weight: 100;">DB name : </span>
            <?php echo "<span style='font-weight:700;'>$dbname</span>" ?>
        </div>
    </div>
    <div class='container-fluid p-3' style='border: 2px solid black;'>
        <?php

        // Create database connection
        $con = new mysqli($servername, $adminname, $password, $dbname);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        } else {
            $sql = "SHOW TABLES FROM $dbname";
            $result = mysqli_query($con, $sql);
            // $result = $con->query($sql);

            
            if ($result) {
                if ($result->num_rows > 0) {
                    echo "<table class='table table-dark table-bordered table-striped'>";
            echo "<tr><th style='color:rgb(252,190,3)'>Table Name</th><th style='color:rgb(252,190,3)'>Show Table data</th><th style='color:rgb(252,190,3)'> Number of rows</th> <th style='color:rgb(252,190,3)'> Number of columns</th><th style='color:rgb(252,190,3)'>Columns Headings</th>";
                    while ($row = mysqli_fetch_row($result)) {
                        // echo "<tr><td>" . $row['Tables_in_$dbname'] . "</td><td><a href='TableDetails.php?usertable=".."'">Show</a></td></tr>";
                        echo "<tr>
                                <td>" . $row[0] . "</td>
                                <td><a href='/DBManagerV2/Table/TableDetails.php?userdb=$dbname&usertable=$row[0]'>SHOW</a></td>
                                    ";
                                        $query_table_data="SELECT * from $row[0]";
                                        $query_table_data_result=mysqli_query($con,$query_table_data);
                                        // if($query_table_data_result!=false && $query_table_data_result->num_rows==0){
                                        //     echo "<td>$query_table_data_result->num_rows</td>";
                                        // }
                                        if($query_table_data_result!=false && $query_table_data_result->num_rows>=0){
                                            // while($query_table_data_result_row=mysqli_fetch_row($query_table_data_result)){
                                                echo "<td>$query_table_data_result->num_rows</td>";
                                            // }
                                        }
                                        
                                        $query="desc $row[0]";
                                        $query_result=mysqli_query($con,$query);
                                        if($query_result){
                                            echo "<td>$query_result->num_rows</td>";
                                            echo "<td>";
                                            if($query_result->num_rows>0){
                                                echo "<table class='table table-dark table-bordered'>";
                                                while($query_row=mysqli_fetch_row($query_result)){
                                                    echo "<tr><td style='width:50%'>$query_row[0]</td>";
                                                    echo "<td style='width:50%'>$query_row[1]</td></tr>";
                                                }
                                                echo "</table>";
                                            }
                                            echo "</td>";
                                        }

                                    echo "
                            </tr>";

                        // U have to work here!!!!


                    }
                    echo "</table>";
                } else {
                    echo "Nothing to show<br><br>";
                    // echo "<script> location.href='createNewDB.html';</script>";
                }
            }
        }
        echo "<div class='container-fluid p-3' style='border: 2px solid white; border-radius:5px;'>
            <form action='CreateNewTable.php?' method='GET'>
                
                <h3>Create New Table</h3>
                <input type='hidden' name='dbname' id='dbname' value='$dbname'><br><br>
                <div class='form-group'>
                    <span>Table Name: </span>
                    <input type='text' class='form-control' name='tname' id='tname' placeholder='Table name'>
                </div>
                <br>
                <div class='form-group'>
                    <span>Number of Columns : </span>
                    <input type='number' class='form-control' name='no_of_cols' id='no_of_cols' placeholder='Number of columns'>
                </div>
                <br><br>
                <button type='submit' class='btn btn-primary'>Create Table</button>
            </form>
        </div>";
        ?>
        <form action="/DBManagerV2/Dashboard/Dashboard.php" method="get">
            <button type="submit" class="btn btn-light my-3">Change Database</button>
        </form>
    </div>

</body>

</html>