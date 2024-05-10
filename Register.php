<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirmPassword"];

    #Declaring flags...
    $emailFlag = false;
    $passwordFlag = false;

    if (strlen($name) > 0 && strlen($email) > 0 && strlen($password) && strlen($confirm_password)) {
        if ($password == $confirm_password) {
            $passwordFlag = true;
            if (preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)) {
                $emailFlag = true;
            } else {
                echo "<script> alert('Invalid E-mail')</script>";
            }
        } else {
            echo "<script> alert('Confirm ur password')</script>";
        }
        if ($emailFlag && $passwordFlag) {
            include("AdminConnect.php");
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirm_password = $_POST["confirmPassword"];
            $query = "INSERT INTO user_register(name, email, password, timestamp) values ('$name','$email','$password',NULL)";


            // if ($con->query($query) === TRUE) 
            if (mysqli_query($con, $query)) {
                echo "<script type=text/javascript> alert('Successfully Registered')
                    location.href='login.html'</script></script>";
            } else if (mysqli_errno($con) == 1062) {
                echo "<script type=text/javascript> alert('User already exists');
                    location.href='index.html'</script>";
            } else {
                echo "Error: " . $query . "<br>" . $con->error;
            }
            $con->close();
        } else {
            echo "<script> alert('Enter valid data'); location.href='index.html';</script>";
        }
    }
}
