<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body>
<?php
    session_start();  
    include("AdminConnect.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email_input=$_POST["email"];
        $password_input=$_POST["password"];

        $query="SELECT name,email,password from user_register;";
        $result = $con->query($query);
        
        if ($result->num_rows > 0) {
            $flag=true;
            while($row = $result->fetch_assoc()) {
                
                // echo "email : " . $row["email"]. "password : " . $row["password"]. "<br>email_ip = ".$email_input." pass_ip = ".$password_input."<br>";
                // echo "<br> Cond = ".(($row["email"]==$email_input) && ($row["password"]==$password_input));
                if(($row["email"]==$email_input) && ($row["password"]==$password_input))
                {
                    
                    echo "
                    <script>alert('Welcome ".$row['name']." Login successfully');
                    location.href='/DBManagerV2/Dashboard/Dashboard.php'</script>
                    ";
                    // echo "
                    // <script>alert('Welcome ".$row['name']." Login successfully');";
                    $_SESSION['name']=$row['name']; 
                    $_SESSION['email']=$email_input;
                    $flag=false; 
                }
                
            }
            if($flag)
            {
                    echo "<script>alert('Invalid Credentials!!!');
                    location.href='/DBManagerV2/Login/Login.html';</script>";
            }
        } else {
            echo "<script>alert('User not found !!!');
            location.href='/DBManagerV2/Login/Login.html'</script>";
        }
        $con->close();
    }
?>
</body>
</html>