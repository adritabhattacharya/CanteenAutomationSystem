<?php
session_start();
    include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="admin-module.css">
    <link rel="stylesheet" href="employee_module.css">
    <title>Document</title>
</head>
<body>
    <div class="cafe">
    <a href="e_logout.php"><button class="b">Logout</button></a>
        <br>
        <h1><center>Welcome, <?php echo $_SESSION['employee']['Name'];?></center></h1>
        <br>
    </div>
    <hr>
    <hr>
    <hr>
    <h1><center>Orders</center></h1>
    <center><?php
    $query = mysqli_query($con,"select * from orders");
    if(mysqli_num_rows($query)){
        while($data=mysqli_fetch_array($query)){
    ?>
    <div class="item" style="width:50%;">
        <u><h2>Customer and Order details:</h2></u>
        <form method="post">
            <br>Customer Name: <?php echo $data['Name']; ?>
            <br>Phone Number: <?php echo $data['Contact_no']; ?>
            <br>Address: <?php echo $data['Address']; ?><br>
            <br>Product Name: <?php echo $data['pdt_name']; ?>
            <br>Quantity: <?php echo $data['Qty']; ?>
            <br>Price: <?php echo $data['prc']; ?>
            <br>Total: <?php echo $data['Qty']*$data['prc']; ?>
            <?php
            $current_date = date("Y-m-d H:i:s");
            
            ?>
            <br><br>
            <?php $id=$data['ID']; ?>
            <?php
            if(isset($_POST[$id])){
                $total=$data['Qty']*$data['prc'];
                $name=$data['pdt_name'];
                $price=$data['prc'];
                $qty=$data['Qty'];
                $current_date = date("Y-m-d");
                $q = mysqli_query($con,"delete from orders where ID=$id");
                $q1 = mysqli_query($con,"insert into sales(pdt_name,pdt_price,pdt_quantity,total,date) values('$name',$price,$qty,$total,'$current_date')");
                $q2=mysqli_query($con,"update menu set Quantity=Quantity-$qty where Item_name='$name'");
            }
            ?>
            <input type="submit" value="Completed" class="c" name="<?php echo $id; ?>">
            
            <br>
            <br>
        </form>
    </div>
    <br><br>
    <?php
        }
    }
    ?>
    
    </center>
    
</body>
</html>