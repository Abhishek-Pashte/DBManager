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
    <div class="container-fluid my-3 p-3" style="border: 2px solid black; border-radius: 5px; text-align: center;">
        <h1>DB Manager</h1>
    </div>
    <div class='container-fluid p-3' style='border: 2px solid black;'>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = $_GET['userdb'];

        // Create database connection
        $con = new mysqli($servername, $username, $password, $dbname);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        } else {
            $sql = "SHOW TABLES FROM $dbname";
            $result = mysqli_query($con, $sql);
            // $result = $con->query($sql);

            echo "<table class='table table-bordered table-striped'>";
            echo "<tr><th>Table Name</th><th>Show Table data</th>";
            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_row($result)) {
                        // echo "<tr><td>" . $row['Tables_in_$dbname'] . "</td><td><a href='TableDetails.php?usertable=".."'">Show</a></td></tr>";
                        echo "<tr><td>" . $row[0] . "</td><td><a href='TableDetails.php?userdb=$dbname&usertable=$row[0]'>Show</a></td></tr>";
                        // echo $row[0];


                        // U have to work here!!!!


                    }
                    echo "</table>";
                } else {
                    echo "Nothing to show<br><br>";
                    // echo "<script> location.href='createNewDB.html';</script>";
                }
            }
        }
        echo "<div class='container-fluid p-3' style='border: 2px solid black;'>
            <form action='CreateNewTable.php?' method='GET'>
                <h3>Create New Table</h3>
                <input type='hidden' name='dbname' id='dbname' value='$dbname'><br><br>
                <span>Table Name : </span>
                <input type='text' name='tname' id='tname'><br><br>
                <span>Number of Columns : </span>
                <input type='number' name='no_of_cols' id='no_of_cols'><br><br>
                <button type='submit' class='btn btn-primary'>Create Table</button>
            </form>
        </div>";
        ?>
        <form action="Dashboard.php" method="get">
        <button type="submit" class="btn btn-dark my-3">Change Database</button>
    </form>
    </div>
    
</body>

</html>