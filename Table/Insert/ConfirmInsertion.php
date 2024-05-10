<?php
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
        
        $innerQuery="";
        foreach ($tableData as $row) {
          // echo "<td> <input type='text' name='".$row['Field']."'>";
          $innerQuery.="'".$_POST[$row['Field']]."'";
          $innerQuery.=',';
        }
        $innerQuery=rtrim($innerQuery,",");
        // echo "<br>$innerQuery<br>";
        $insertQuery="INSERT INTO $tablename values($innerQuery);";
        // echo "Query = $insertQuery";
        $stmt=$conn->prepare($insertQuery);
        $result = $stmt->execute();
        if($result){
          echo "<script>alert('Data inserted successfully in $tablename');
          location.href='/DBManagerV2/Table/TableDetails.php?userdb=$dbname&usertable=$tablename';</script>";
        }
    }
  catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>