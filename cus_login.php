<?php
    session_start();
    include("connect.php");
    if(isset($_POST['cus_login']))
    {
       // echo "hi";
        $username = $_POST['username'];
        $password = $_POST['password'];
        //echo $username;
        //echo $password;
        $query = mysqli_query($con,"select * from customers where Username='$username' AND Password='$password'");
        if(mysqli_num_rows($query)){
            //echo "yes";
            $q = mysqli_fetch_array($query);
            $_SESSION['customer']=$q;
            header("location:cart.php");
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
        <form method="post">
        <br>
        <hr>
        <br>
        <h3>
        Customer User ID: <input type="text" id="username" name="username">
        <br>
        <br>
        Password: <input type="password" id="password" name="password">
    </h3>
    
        <br>
        <hr>
        <input class="c" type="submit" name="cus_login" value="Login">
        <br>
</form>
    <h3> New Customer? <a href="Customer_registration.php" style="color:white;">Register here </a></h3>
    </div>
    <script src="cus_login.js"></script>
</body>
</html>