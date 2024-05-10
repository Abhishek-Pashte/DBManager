<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <title>Dashboard</title>
</head>

<body>

    <?php
    echo "<link rel='stylesheet' href='/DBManagerV2/CSS/style.css'>
    <link rel='stylesheet' href='DashboardStyle.css'>";
    session_start();
    include('AdminConnect.php');
    $username = $_SESSION['name'];
    $useremail = $_SESSION['email']; 
    ?>

    <div id='header'>
        <span><p class="text-center text-white" style="font-size: 50px; font-weight: 700;">DB Manager</p></span>
        <div class='user-info'>
            <span style="font-weight: 100;">Username : </span>
            <?php echo "<span style='font-weight:700;'>$username</span>" ?><br>
            <span style="font-weight: 100;">E-mail ID : </span>
            <?php echo "<span style='font-weight:700;'>$useremail</span>" ?>
        </div>
    </div>

    <?php
    // echo "<div class='container-fluid p-3' style='border: 2px solid black;'>
    // <div class='container-fluid p-3'>
    // <p class='font-weight-bold'>User Information</p>
    // <p class='font-weight-normal'>$username</p>
    // <small>($useremail)</small>
    // </div>";

    $sql = "select * from user_database_info where email='$useremail';";
    $result = $con->query($sql);
    
    echo "<div class='main-container'>";

            
            if($result->num_rows==0){
                echo "<p>You haven't created any table yet...<br>
                Create your first table below.";
            }
            else{
                echo "<table class='table table-dark table-bordered table-striped'>";
                    if ($result) {
                        echo "<tr>
                                    <th>Database Name</th>
                                    <th>Time Stamp</th>
                                    <th>Select</th>";
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
                                                        <td>" . $row['dbname'] . "</td>
                                                        <td>" . $row['timestamp'] . "</td>
                                                        <td><a href='/DBManagerV2/Table/ShowTables.php?userdb=".$row['dbname']."'>OPEN</a></td>
                                                        
                                                    </tr>";


                                                // U have to work here!!!!


                                            }
                                        }
                        echo "</table>
                        </div>";
                    } else {
                        echo "Nothing to show";
                        // echo "<script> location.href='createNewDB.html';</script>";
                    }
            }

            echo "<span style='font-weight:100; margin:1%; padding:1%;'><br>Total DB's = ".$result->num_rows."</span>";
    ?>

    <!-- <form action="CreateNewDB.php" method="post">
        <span>DB Name : </span>
        <input type="text" name="dbname" id="dbname"><br>
        <button type="submit">Create DB</button>
    </form> -->

    
    <div class="main-container">
        <div class="container-fluid p-3" style="border: 2px solid white; border-radius:5px; background-color:rgb(39,39,39)">
            <form action="/DBManagerV2/Dashboard/CreateNewDB.php" method="post">
                <h3>Create New Database</h3>
                <br>
                <div class="form-group">
                    <span>DB Name: </span>
                    <input type="text" class="form-control" name="dbname" id="dbname" placeholder='Database Name'>
                </div>

                <button type="submit" class="btn btn-primary my-3">Create Database</button>
            </form>
        </div>
    </div>
    </div>
</body>

</html>