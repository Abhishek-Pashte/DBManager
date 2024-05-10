<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Table Details</title>
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
        $dbname = $_GET['userdb'];
        $tablename = $_GET['usertable'];
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $desc = $conn->prepare("DESC $tablename");
            $desc->execute();
            $tableData = $desc->fetchAll(PDO::FETCH_ASSOC);
            $tableEmpty=false;
            echo "<h1 style='font-weight: 400;'>Table Information</h1>";
            echo "<h2 style='font-weight: 100;'><small>Table description </small></h2>";
            echo "<table class='table table-bordered table-striped'><tr>";
            foreach ($tableData[0] as $columnName => $value) {
                echo "<th>" . $columnName . "</th>";
            }
            echo "</tr>";

            foreach ($tableData as $row) {
                echo '<tr>';
                foreach ($row as $value) {
                    echo '<td>' . $value . '</td>';
                }
                echo '</tr>';
            }

            echo '</table>';

            echo "<hr>";

            echo "<h2 style='font-weight: 100;'><small>Table data</small></h2>";
            $stmt = $conn->prepare("SELECT * FROM $tablename");
            $stmt->execute();
            $tableData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($tableData) > 0) {
                echo "<table class='table table-bordered table-striped'>";

                // Print table headers dynamically
                echo '<tr>';
                foreach ($tableData[0] as $columnName => $value) {
                    echo '<th>' . $columnName . '</th>';
                }
                echo '</tr>';

                // Print table rows dynamically
                foreach ($tableData as $row) {
                    echo '<tr>';
                    foreach ($row as $value) {
                        echo '<td>' . $value . '</td>';
                    }
                    echo '</tr>';
                }

                echo '</table>';
            } else {
                $tableEmpty=true;
                echo 'No data available.';
                echo "<script>alert('Table is empty');</script>";
                // Enter code for insertion in table;
            }
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $tableData = NULL;
        echo "<hr>";
        echo "<div class='container-fluid p-1 m-0' >
                <p>Insert Record </p>
                <form method='POST' action='InsertInTable.php?dbname=$dbname&tablename=$tablename';>
                    <button type='submit' class='btn btn-dark m-2'>Insert</button>
                </form>
            </div>";

        echo "<hr>";

        echo "<div class='container-fluid p-1 m-0' >
                <p>Delete All Records </p>
                <form method='POST' action='DeleteAllFromTable.php?dbname=$dbname&tablename=$tablename';>";
                if($tableEmpty){
                    echo "<button type='submit' class='btn btn-dark m-2' disabled>Delete All</button>";
                }
                else{
                    echo "<button type='submit' class='btn btn-dark m-2'>Delete All</button>";
                }
        echo "</form>
            </div>";

        echo "<hr>";

        $stmt = $conn->prepare("SELECT * FROM $tablename");
        $stmt->execute();
        $tableData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<div class='container-fluid p-1 m-0' >
                <p>Delete Specific Record </p>
                <form method='POST' action='DeleteFromTable.php?dbname=$dbname&tablename=$tablename';>
                Delete record from column name = 
                <select class='form-group' name='deleteCol'>";
                foreach ($tableData[0] as $columnName => $value) {
                    echo "<option value='$columnName'>$columnName</option>";
                }
        echo "</select>
                value = <input type='text' class='form-group' name='deleteValue'><br>";
                if($tableEmpty){
                    echo "<button type='submit' class='btn btn-dark m-2' disabled> Delete </button>";
                }
                else{
                    echo "<button type='submit' class='btn btn-dark m-2'> Delete </button>";
                }
        echo "</form></div>";

        echo "<hr>";

        echo "<div class='container-fluid p-1 m-0' >
                <p>Update Record </p>
                <form method='POST' action='UpdateTable.php?dbname=$dbname&tablename=$tablename';>
                Update record from column name = 
                <select name='updateCol'>";
                    foreach ($tableData[0] as $columnName => $value) {
                    echo "<option value='$columnName'>$columnName</option>";
                    }
        echo "</select>
            set value = <input type='text' name='updateValue'><br>
            where column name = 
            <select name='conditionCol'>";
            foreach ($tableData[0] as $columnName => $value) {
                echo "<option value='$columnName'>$columnName</option>";
            }
        echo "value = <input type='text' name='conditionValue'><br>";
        if($tableEmpty){
            echo "<button type='submit' class='btn btn-dark m-2' disabled>Update </button>";
        }
        else{
            echo "<button type='submit' class='btn btn-dark m-2'>Update </button>";
        }
        echo "</form></div>";

        echo "<div class='container-fluid p-1 m-0' >
                <form method='POST' action='ShowTables.php?userdb=$dbname';>
                    <button type='submit' class='btn btn-dark m-2'>Go Back</button>
                </form>
            </div>";
        ?>
    </div>
</body>

</html>