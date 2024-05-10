<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Create New Table</title>
</head>
<body>


<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = $_GET['dbname'];
$useremail = $_SESSION['email'];
echo "<link rel='stylesheet' href='/DBManagerV2/CSS/style.css'>";
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
<?php
// Create database connection
$con = new mysqli($servername, $username, $password, $dbname);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

?>

<div class="container-fluid p-3" style="border: 2px solid black;">
        <form action="ConfirmCreateTable.php" method="post">
            <?php
            $tname=$_GET['tname'];
            if($tname=='table'){
                echo "<script>alert('Invalid Table name!!!');
                    location.href='/DBManagerV2/Table/ShowTables.php?userdb=$dbname&usertable=$tablename';</script>";
            }
            $no_of_cols=$_GET['no_of_cols'];
            echo "<input type='hidden' name='dbname' id='dbname' value='$dbname'>
            <input type='hidden' name='tname' id='tname' value='$tname'>
            <input type='hidden' name='no_of_cols' id='no_of_cols' value='$no_of_cols'>";
            
            echo "Table Name = <b>$tname</b> <br> Number of columns = $no_of_cols";
            $cols=1;
            echo "<table class='table table-dark table-bordered table-striped''>
            <tr>
                <th>Column</th>
                <th>Data Type</th>
                <th>Length</th>
                <th>Primary Key<th>
            </tr>";
            $i=1;
            while($cols<=$no_of_cols){
                
                echo 
                "<tr>
                    <td>
                        <input type='text' name='colname$cols' class='form-control' placeholder='$i' required>
                    </td>
                    <td>
                        <select name='dtype$cols' id='dtype' class='form-control'>
                            <option value='text' selected>text</option>
                            <option value='int'>int</option>
                            <option value='varchar'>varchar</option>
                            <option value='date'>date</option>
                        </select>
                    </td>
                    <td>
                        <input required type='number' name='length$cols' class='form-control'>
                    </td>
                    <td>
                        <input type='radio' id='primary_key' name='primary_key' value='$cols' required>
                    </td>
                </tr>";
                $cols++;
            } 
            echo "</table>";
            ?>
            <button type="submit" class="btn btn-primary">Create table</button>
        </form>
    </div>
</body>
</html>