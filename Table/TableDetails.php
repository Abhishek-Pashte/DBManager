<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="/DBManagerV2/CSS/style.css">
    <!-- <script src="script.js"></script> -->
    <title>Table Details</title>
</head>

<body>
    <!-- <div class="container-fluid my-3 p-3" style="border: 2px solid black; border-radius: 5px; text-align: center;">
        <h1>DB Manager</h1>
    </div> -->
    

        <?php
        session_start();
        $servername = "localhost";
        $adminname = "root";
        $password = "";
        $dbname = $_GET['userdb'];
        $tablename = $_GET['usertable'];
        $username=$_SESSION['name'];
        $useremail = $_SESSION['email'];
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $adminname, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $desc = $conn->prepare("DESC $tablename");
            $desc->execute();
            $tableData = $desc->fetchAll(PDO::FETCH_ASSOC);
            $tableEmpty=false;
            ?>
            <div id='header'>
                <span><p class="text-center text-white" style="font-size: 50px; font-weight: 700;">DB Manager</p></span>

                    <div class='user-info'>
                        <span style="font-weight: 100;">Name: </span>
                        <?php echo "<span style='font-weight:700;'>$username</span>" ?><br>
                        <span style="font-weight: 100;">E-mail ID : </span>
                        <?php echo "<span style='font-weight:700;'>$useremail</span>" ?><br>
                        <span style="font-weight: 100;">DB name : </span>
                        <?php echo "<span style='font-weight:700;'>$dbname</span>" ?><br>
                        <span style="font-weight: 100;">Table name : </span>
                        <?php echo "<span style='font-weight:700;'>$tablename</span>" ?>
                    </div>
                </div>
            </div>
            <div class="container-fluid p-3" style="border: 2px solid white; margin-top:1%; border-radius:5px;">
            <?php
            echo "<h1 style='font-weight: 400;'>Table Information</h1>";
            echo "<h2 style='font-weight: 100;'><small>Table description </small></h2>";
            echo "<table class='table table-dark table-bordered table-striped'><tr>";
            foreach ($tableData[0] as $columnName => $value) {
                echo "<th style='color:rgb(252,190,3)'>" . $columnName . "</th>";
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
                echo "<table class='table table-dark table-bordered table-striped'>";

                // Print table headers dynamically
                echo '<tr>';
                foreach ($tableData[0] as $columnName => $value) {
                    echo "<th style='color:rgb(252,190,3)'>" . $columnName . "</th>";
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
                <form method='POST' action='/DBManagerV2/Table/Insert/InsertInTable.php?dbname=$dbname&tablename=$tablename';>
                    <button type='submit' class='btn btn-dark m-2'>Insert</button>
                </form>
            </div>";

        echo "<hr>";

        echo "<div class='container-fluid p-1 m-0' >
                <p>Delete All Records </p>
                <form method='POST' action='/DBManagerV2/Table/Delete/DeleteAllFromTable.php?dbname=$dbname&tablename=$tablename';>";
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
                <form method='POST' action='/DBManagerV2/Table/Delete/DeleteFromTable.php?dbname=$dbname&tablename=$tablename';>
                Delete record from column name = 
                <select class='form-group' name='deleteCol' style='background-color:rgb(39,39,39);color:white;'>";
                foreach ($tableData[0] as $columnName => $value) {
                    echo "<option value='$columnName'>$columnName</option>";
                }
        echo "</select>
                <br>value = <input type='text' class='form-group' name='deleteValue' style='width: 150px; background-color:rgb(39,39,39);color:white;border-radius:5px;outline:none;border:2px solid white;'><br>";
                
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
                <form method='POST' action='/DBManagerV2/Table/Update/UpdateTable.php?dbname=$dbname&tablename=$tablename';>
                Update record from column name = 
                <select name='updateCol' class='form-group' style='background-color:rgb(39,39,39);color:white;'>";
                    foreach ($tableData[0] as $columnName => $value) {
                    echo "<option value='$columnName'>$columnName</option>";
                    }
        echo "</select>
            set value = <input type='text' name='updateValue' class='form-group' style='width: 150px; background-color:rgb(39,39,39);color:white;border-radius:5px;outline:none;border:2px solid white;'><br>
            where column name = 
            <select name='conditionCol' class='form-group' style='background-color:rgb(39,39,39);color:white;'>";
            foreach ($tableData[0] as $columnName => $value) {
                echo "<option value='$columnName'>$columnName</option>";
            }
        echo "value = <input type='text' name='conditionValue' class='form-group' style='width: 150px; background-color:rgb(39,39,39);color:white;border-radius:5px;outline:none;border:2px solid white;'><br>";
        if($tableEmpty){
            echo "<button type='submit' class='btn btn-dark m-2' disabled> Update </button>";
        }
        else{
            echo "<button type='submit' class='btn btn-dark m-2'>Update </button>";
        }
        echo "</form></div>";
        echo "<hr>";
        echo "<div class='container-fluid p-1 m-0' >
                <form method='POST' action='/DBManagerV2/Table/ShowTables.php?userdb=$dbname&useremail=$useremail';>


                    
                    <button type='submit' class='btn btn-primary m-2'>Go Back</button>
                </form>
            </div>";
        ?>
    </div>
    <!-- Line number 180 user email is not getting from previous responce work on it... -->
</body>

</html>