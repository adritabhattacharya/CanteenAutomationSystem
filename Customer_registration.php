<?php
    include("connect.php");
    if(isset($_POST['register'])){
        $name=$_POST['name'];
        $phno=$_POST['contact_no'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $address=$_POST['address'];
        $q = mysqli_query($con,"insert into customers(Name, Contact_no, Username, Password, Address) values('$name', $phno, '$username', '$password', '$address')");
        if($q){
            header('location:cus_login.php');
        }
        else{
            echo "sorry".mysqli_error($con);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
    <title>Customer_Registration</title>
</head>
<body class="cafe">
<a href="cus_login.php"><button class="b"> Go Back </button></a>
<div class="bg centered" style="width: 75%; height: auto;">
        <br>
        <h1>Registration Form</h1>
        <br>
        <hr>
        <br>
        <h3>
            <form method="post">
        Name: <input type="text" name="name">
        <br>
        <br>
        Contact Number: <input type="text" name="contact_no">
        <br>
        <br>
        User ID: <input type="text" name="username">
        <br>
        <br>
        Password: <input type="password" name="password">
        <br>
        <br>
        Address: <input type="textarea" style="width: 400px; height: 100px" name="address">
    </h3>
    
        <br>
        <hr>
        <input type="submit" class="c" name="register" value="Register">
        <br>
        <br>
</form>
    </div>
    
</body>
</html>