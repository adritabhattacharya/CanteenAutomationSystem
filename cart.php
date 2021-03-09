<?php
    session_start();
    include('connect.php');
   
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <div class="split left">
        <div class="cafe">
        <a href="c_logout.php" style="text-decoration: none;"><button class="b">Logout</button></a>
           <br>
           
        <h1><center>Welcome to Cafe Bistro,&nbsp <span class="cus_name"> <?php 
        $name=$_SESSION['customer']['Name'];
        echo $name;
        $phno=$_SESSION['customer']['Contact_no'];
        $addr=$_SESSION['customer']['Address'];
        ?></span></center></h1>
        <br>
        </div>
        <hr color="white">
        <hr color="white">
        <table width="100%"">
            <tr>
            <div style="display: flex;">
                <div class="category Espresso bg">
                <h2>Espresso</h2>
                <?php
                $query = mysqli_query($con,"select * from menu where Item_category='Espresso'");
                if(mysqli_num_rows($query)){
                    while($data=mysqli_fetch_array($query)){
                ?>
                <div class="item" id="0010">
                    <div class="name"><center><b><u><?php echo $data['Item_name']; ?></u></b></center></div>
                    <div class="price"><center><b><u>Rs. <?php echo $data['Price']; ?></u></b></center></div>
                    <div style="display:flex;">
                    <div class="img"><img src="images/<?php echo $data['Image']; ?>" style="width:100px;height:100px;" class="image"></div>
                    <div class="carton"><button class="a">Add to Cart</button></div>
                    </div>
                </div>
                <?php
                    }
                }
              ?>   
              </div>
            <div class="category Sweets bg">
                <h2>Sweets</h2>
                <?php
                $query = mysqli_query($con,"select * from menu where Item_category='Sweets'");
                if(mysqli_num_rows($query)){
                    while($data=mysqli_fetch_array($query)){
                ?>
                <div class="item" id="0010">
                    <div class="name"><center><b><u><?php echo $data['Item_name']; ?></u></b></center></div>
                    <div class="price"><center><b><u>Rs. <?php echo $data['Price']; ?></u></b></center></div>
                    <div style="display:flex;">
                    <div class="img"><img src="images/<?php echo $data['Image']; ?>" style="width:100px;height:100px;" class="image"></div>
                    <div class="carton"><button class="a">Add to Cart</button></div>
                    </div>
                </div>
                <?php
                    }
                }
              ?>   
              </div>
            </div>
        </tr>
        <br>
        <tr>
                <div style="display: flex;">
                <div class="category Juices bg">
                    <h2>Juices</h2>
                    <?php
                $query = mysqli_query($con,"select * from menu where Item_category='Juices'");
                if(mysqli_num_rows($query)){
                    while($data=mysqli_fetch_array($query)){
                ?>
                <div class="item" id="0010">
                    <div class="name"><center><b><u><?php echo $data['Item_name']; ?></u></b></center></div>
                    <div class="price"><center><b><u>Rs. <?php echo $data['Price']; ?></u></b></center></div>
                    <div style="display:flex;">
                    <div class="img"><img src="images/<?php echo $data['Image']; ?>" style="width:100px;height:100px;" class="image"></div>
                    <div class="carton"><button class="a">Add to Cart</button></div>
                    </div>
                </div>
                <?php
                    }
                }
              ?>   
                </div>
                <div class="category Sandwiches bg">
                    <h2>Sandwiches</h2>
                    <?php
                $query = mysqli_query($con,"select * from menu where Item_category='Sandwiches'");
                if(mysqli_num_rows($query)){
                    while($data=mysqli_fetch_array($query)){
                ?>
                <div class="item" id="0010">
                    <div class="name"><center><b><u><?php echo $data['Item_name']; ?></u></b></center></div>
                    <div class="price"><center><b><u>Rs. <?php echo $data['Price']; ?></u></b></center></div>
                    <div style="display:flex;">
                    <div class="img"><img src="images/<?php echo $data['Image']; ?>" style="width:100px;height:100px;" class="image"></div>
                    <div class="carton"><button class="a">Add to Cart</button></div>
                    </div>
                </div>
                <?php
                    }
                }
              ?>  
                    </div>
                </tr>
        <hr color="white">
            
        <br>
        </div>
      
      <div class="split right">
          
          <div class="cafe">
              <br>
          <center><h1>Cart</h1></center>
          <br>
          </div>
          <hr>
          <hr>
          <div class="bill">
          <div class="bg">
            
                <div class="all-items">

                </div>
          
                <hr>
            </div>
            <div class="eh"><h2><center>Total: <span class="total">Rs. 0</span></center></h2></div>
            <br>
            <center><input type="submit" value="Purchase" class="c"></center>
            </div>
        </div>
        
       <br>
       <br>
       <?php
     function regenerateToken()
     {
       $_SESSION["buy_token"] = sprintf(
         '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
         mt_rand(0, 0xffff),
         mt_rand(0, 0xffff),
         mt_rand(0, 0xffff),
         mt_rand(0, 0x0fff) | 0x4000,
         mt_rand(0, 0x3fff) | 0x8000,
         mt_rand(0, 0xffff),
         mt_rand(0, 0xffff),
         mt_rand(0, 0xffff)
       );
     }
     if (!isset($_SESSION["buy_token"])) {
         regenerateToken();
       }
  if (isset($_POST["ORDER"])) {
    $pdtnames=$_POST['pdt_name'];
    $pdtqties=$_POST['pdt_qty'];
    $pdtprcies=$_POST['pdt_prc'];
    for($i=0;$i<sizeof($pdtnames);$i++){
        $q = mysqli_query($con,"insert into orders(Name, pdt_name, Qty, prc, Contact_no, Address) values('$name', '$pdtnames[$i]',$pdtqties[$i],$pdtprcies[$i], $phno,'$addr')");
    }
  }
?>
       <br>
       <br>
        <script src="cart.js"></script>
        
</body>
</html>