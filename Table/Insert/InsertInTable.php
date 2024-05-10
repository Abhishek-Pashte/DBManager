<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Insert Record</title>
</head>
<body>
    <!-- <div id='header'>
        <span><p class="text-center text-white" style="font-size: 50px; font-weight: 700;">DB Manager</p></span>
    </div>
        <div class="container-fluid p-3" style="border: 2px solid black;">
        <h1 style='font-weight: 400;'>Insert Record in Table</h1> -->

<?php

    echo "<link rel='stylesheet' href='/DBManagerV2/CSS/style.css'>";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname=$_GET['dbname'];
    $tablename=$_GET['tablename'];
    try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $get_columns=$conn->prepare("DESC $tablename");
    $get_columns->execute();
    $tableData = $get_columns->fetchAll(PDO::FETCH_ASSOC);
    // $tableData = $get_columns->fetchColumn(0);
    echo "<div id='header'>
            <span><p class='text-center text-white' style='font-size: 50px; font-weight: 700;'>DB Manager</p></span>
        </div>
    <div class='container-fluid p-3' style='border: 2px solid black;'>
    <h1 style='font-weight: 400;'>Insert Record in Table</h1>";
    echo "<form method='POST' action='/DBManagerV2/Table/Insert/ConfirmInsertion.php?dbname=$dbname&tablename=$tablename'>";
    echo "<table class='table table-dark table-bordered table-striped'>";

        // Print table headers dynamically
        echo '<tr>';
        // foreach ($tableData[0] as $columnName => $value) {
        //     echo '<th>' . $columnName . '</th>';
        // }
        echo "<th>Field</th><th>Data</th>";
        echo '</tr>';
        foreach ($tableData as $row) {
            echo '<tr>';
            echo '<td>'.$row['Field'].'</td>';
            echo "<td> <input type='text' class='form-control' style='padding:2px; width:25%;' name='".$row['Field']."' placeholder='Enter data...'>";
            echo '</tr>';
        }
        echo "</table>";
        
        echo "<button type='submit' class='btn btn-dark'>Insert</button>
        </form>";

    }
    catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
?>

</body>
</html>