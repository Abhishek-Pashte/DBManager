<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>
    <title>Confirm Table</title>
</head>
<body>
<div class="container-fluid my-3 p-3" style="border: 2px solid black; border-radius: 5px; text-align: center;">
        <h1>DB Manager</h1>
    </div>
    <div class="container-fluid p-3" style="border: 2px solid black;">

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = $_POST['dbname'];

// Create database connection
$con = new mysqli($servername, $username, $password, $dbname);
if ($con->connect_error) {
    echo "error";
    die("Connection failed: " . $con->connect_error);
}
else{

    $tname=$_POST['tname'];
    $no_of_cols=$_POST['no_of_cols'];
    // $colname=$_POST['colname'];
    // $dtype=$_POST['dtype'];
    $primary_key=$_POST['primary_key'];
    $i=1;

    // echo "Primary key ----".$primary_key;
    
    $inquery="";
    while($i<=$no_of_cols){
        $colname=$_POST['colname'.$i];
        $dtype=$_POST['dtype'.$i];
        $length=$_POST['length'.$i];
        // echo "<br>$colname  $dtype  $length $primary_key<br>";
        if($length){
            $inquery.="$colname $dtype($length),";
        }
        else{
            $inquery.="$colname $dtype,";
        }
        
        $i++;
    }
    $sql="CREATE TABLE $dbname.$tname ($inquery primary key(".$_POST['colname'.$primary_key]."));";
    // $sql="CREATE TABLE fr (f text(5),s text(2),t int(2), primary key(f))";
    echo "<b>SQL Query</b>  ".$sql."<br>";
    
    if(mysqli_query($con,$sql)){
        echo "Done";
        echo "<script>alert('Table created successfully!!!');
        location.href='/DBManagerV2/Table/ShowTables.php?useremail=".$useremail."&userdb=".$dbname."';</script>";
    
    }
    else{
        echo "<b>Error number -></b>".mysqli_errno($con)."<br>";
        // echo "<b>Error description -></b>".mysqli_error($con)."<br>";
        echo "<b>Error description -></b>
            <div class='alert alert-danger' role='alert'>".mysqli_error($con)."</div>";
        echo "<button onclick='history.back()'>Go Back</button>";
    }
    // $sql="CREATE TABLE $dbname.`testing` (`bji` INT NOT NULL , `bj` INT NOT NULL , `bk` INT NOT NULL , `bj` INT NOT NULL , PRIMARY KEY (`bj`)) ENGINE = InnoDB;"
}
?>
    </div>
</body>
</html>