<?php
    session_start();
    include("connect.php");
    if(isset($_POST['admin_login']))
    {
       // echo "hi";
        $username = $_POST['username'];
        $password = $_POST['password'];
        //echo $username;
        //echo $password;
        $query = mysqli_query($con,"select * from admin_login where admin_username='$username' AND admin_password='$password'");
        if(mysqli_num_rows($query)){
            //echo "yes";
            $q = mysqli_fetch_array($query);
            $_SESSION['admin']=$q;
            header("location:admin-module.php");
        }
        else{
            echo "Invalid User ID or Password. Try again.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
    <title>Document</title>
</head>
<body class="cafe">
<a href="login.html"><button class="b"> Go Back </button></a>
    <div class="bg centered" style="width: 75%; height: 400px;">
        <br>
        <h1>Login to Continue</h1>
        <br>
        <hr>
        <br>
        <h3>
            <form method="post">
        Username: <input type="text" name="username">
        <br>
        <br>
        Password: <input type="password" name="password">
    </h3>
    
        <br>
        <hr>
        <input type="submit" class="c" name="admin_login" value="Login">
        <br>
</form>
    </div>
</body>
</html>