<?php
session_start();
    include("connect.php");
    if(isset($_POST['submit'])){
        $name=$_POST['item_name'];
        $cat=$_POST['Category'];
        $pr=$_POST['item_prc'];
        $qty=$_POST['item_quantity'];
        $filename=$_FILES['image']['name'];
        $temp_name=$_FILES['image']['tmp_name'];
        $folder="images/".$filename;
        if(move_uploaded_file($temp_name,$folder)){
            $msg="Image Uploaded Successfully.";
        }
        else{
            $msg="Failed.";
        }
        $q = mysqli_query($con,"insert into menu(Item_name, Item_category,Price,Quantity,Image) values('$name', '$cat', $pr, $qty, '$filename')");
        if($q){
            echo "success";
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
    <link rel="stylesheet" href="admin-module.css">
    <title>Document</title>
</head>
<body>
    <div>
        <a href="logout.php"><button class="b">Logout</button></a>
        <h1 style="color:white; text-align:center;">Hello, <?php echo $_SESSION['admin']['admin_username'];?></h1>
        <br><br>
    </div>
    <button class="tablink" onclick="openPage('Home', this, 'chocolate')"id="defaultOpen">Manage Menu</button>
    <button class="tablink" onclick="openPage('News', this, 'black')" >Manage Inventory</button>
    <button class="tablink" onclick="openPage('Contact', this, 'chocolate')">Manage Employees</button>
    <button class="tablink" onclick="openPage('About', this, 'black')">Sales</button>

    <div id="Home" class="tabcontent">
        <div class="AFIM">
            <h1><center>Add Food Items to Menu</center></h1>
            <hr><br>
            <center>
                <form method="post" enctype="multipart/form-data">
                    <b> Item-Name: </b> <input type="text" name="item_name"><br><br>
                    <b> Category:  </b> <select name="Category" id="Category">
                        <option value="Espresso">Espresso</option>
                        <option value="Sweets">Sweets</option>
                        <option value="Sandwiches">Sandwiches</option>
                        <option value="Juices">Juices</option>
                    </select>
                    <br><br>
                    <b>Quantity:</b> <input type="number" name="item_quantity"><br><br>
                    <b>Price (in Rupees):</b> <input type="number" name="item_prc"><br><br>
                    <b>Image: </b><input type="file" name="image"><br><br>
                    <input type="submit" class="c Add_Menu_Items" name="submit" value="Add to Menu"><br><br>
                </form>
            </center>
        </div>
        <br><br>
        <div class="AFIM">
            <h1><center>Menu</center></h1>
            <hr><br>
            <div>
                <h2> Espresso </h2>
                <?php
                    $query = mysqli_query($con,"select * from menu where Item_category='Espresso'");
                    if(mysqli_num_rows($query)){
                    while($data=mysqli_fetch_array($query)){
                ?>
                <div class="item" id="0010">
              
                    <div class="name_php" style="color:black;"><b><u><?php echo $data['Item_name']; ?></u></b></div>
                    <div class="price_php" style="color:black;"><b><u>Rs. <?php echo $data['Price']; ?></u></b></div>
                    <div style="display:flex;">
                    <div class="img"><img src="images/<?php echo $data['Image']; ?>" style="width:100px;height:100px;" class="image"></div>
                    <div class="carton"><form method="post">
                    <?php
                        $id=$data['ID'];
                        if(isset($_POST[$id])){
                            $q = mysqli_query($con,"delete from menu where ID=$id");
                        }
                    ?>
                    <input type="submit" name="<?php echo $id; ?>" value="Remove from Menu" class="b"></form></div>
                </div>
            </div>
            <?php
                    }
                }
            ?>   

                <h2> Sweets </h2>
                <?php
                    $query = mysqli_query($con,"select * from menu where Item_category='Sweets'");
                    if(mysqli_num_rows($query)){
                        while($data=mysqli_fetch_array($query)){
                ?>
                <div class="item" id="0010">
                    <div class="name_php" style="color:black;"><b><u><?php echo $data['Item_name']; ?></u></b></div>
                    <div class="price_php" style="color:black;"><b><u>Rs. <?php echo $data['Price']; ?></u></b></div>
                    <div style="display:flex;">
                        <div class="img"><img src="images/<?php echo $data['Image']; ?>" style="width:100px;height:100px;" class="image"></div>
                        <div class="carton">
                            <form method="post">
                            <?php
                                $id=$data['ID'];
                                if(isset($_POST[$id])){
                                    $q = mysqli_query($con,"delete from menu where ID=$id");
                                }
                            ?>
                            <input type="submit" name="<?php echo $id; ?>" value="Remove from Menu" class="b">
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>   


<h2> Juices </h2>
    <?php
                $query = mysqli_query($con,"select * from menu where Item_category='Juices'");
                if(mysqli_num_rows($query)){
                    while($data=mysqli_fetch_array($query)){
                ?>
                <div class="item" id="0010">
                
                    <div class="name_php" style="color:black;"><b><u><?php echo $data['Item_name']; ?></u></b></div>
                    <div class="price_php" style="color:black;"><b><u>Rs. <?php echo $data['Price']; ?></u></b></div>
                    <div style="display:flex;">
                    <div class="img"><img src="images/<?php echo $data['Image']; ?>" style="width:100px;height:100px;" class="image"></div>
                    <div class="carton"><form method="post">
                    <?php
                    
                    $id=$data['ID'];
                    if(isset($_POST[$id])){
                        $q = mysqli_query($con,"delete from menu where ID=$id");
                    }
                    ?><input type="submit" name="<?php echo $id; ?>" value="Remove from Menu" class="b"></form></div>
                   
                    </div>
                </div>
                <?php
                    }
                }
              ?>   
<h2> Sandwiches </h2>
    <?php
                $query = mysqli_query($con,"select * from menu where Item_category='Sandwiches'");
                if(mysqli_num_rows($query)){
                    while($data=mysqli_fetch_array($query)){
                ?>
                <div class="item" id="0010">
                
                    <div class="name_php" style="color:black;"><b><u><?php echo $data['Item_name']; ?></u></b></div>
                    <div class="price_php" style="color:black;"><b><u>Rs. <?php echo $data['Price']; ?></u></b></div>
                    <div style="display:flex;">
                    <div class="img"><img src="images/<?php echo $data['Image']; ?>" style="width:100px;height:100px;" class="image"></div>
                    <div class="carton"><form method="post">
                    <?php
                    
                    $id=$data['ID'];
                    if(isset($_POST[$id])){
                        $q = mysqli_query($con,"delete from menu where ID=$id");
                    }
                    ?><input type="submit" name="<?php echo $id; ?>" value="Remove from Menu" class="b"></form></div>
                   
                    </div>
                </div>
                <?php
                    }
                }
              ?>   
              
</div>
</div>

            </div>
<div id="News" class="tabcontent">
  
  <div class="AFIM">
      <h1><center>Inventory</center></h1>
      <hr>
      <br>
      <?php
      $query1 = mysqli_query($con,"select * from menu");
      if(mysqli_num_rows($query1)){
        while($data=mysqli_fetch_array($query1)){
      ?>
     
        
     
      <center>
          <div class="Inventory_items">
          <?php
            $id=$data['ID'];
            
            if(isset($_POST["update".$id])){
                
                $operand=$_POST['operand'];
                $operator=$_POST['operator'];
                if($operator=='+'){
                $q = mysqli_query($con,"update menu set Quantity=Quantity+$operand where ID=$id");
                }
                else if($operator=='-'){
                    $q = mysqli_query($con,"update menu set Quantity=Quantity-$operand where ID=$id");
                }
                if($q){
                    echo "success";
                }
                else{
                    echo "Sorry";
                }
            }
          ?>
            <div class="img" style="background-color:blanchedalmond; width:auto;"><img src="images/<?php echo $data['Image']; ?>" style="width:50px;height:50px;"></div>
            <div class="item-name" style="background-color:blanchedalmond; width:auto;"><?php echo $data['Item_name']; ?></div>
            <form method="post">
            <div class="item-quantity" style="background-color:blanchedalmond; width:auto;"><?php echo $data['Quantity']; ?></div>
            <select name="operator">Select sign
            <option value="+">+</option>
            <option value="-">-</option>
            </select>
            <input type="number" name="operand">
            <input type="submit" name="<?php echo "update".$id; ?>" value="Update">
            </form>
          </div>
          <hr>
      </center>
      <?php
                    }
                }
              ?>  
  </div>
</div>

<div id="Contact" class="tabcontent">

  <div class="AFIM">
    <h1><center>Recruit Employee</center></h1>
    <hr>
    <br>
    <?php
    include("connect.php");
    if(isset($_POST['register'])){
        $name=$_POST['name'];
        $phno=$_POST['contact_no'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $q = mysqli_query($con,"insert into employees(Name, Contact_no, Username, Password) values('$name', $phno, '$username', '$password')");
        if($q){
            echo "Success";
        }
        else{
            echo "sorry".mysqli_error($con);
        }
    }
?>
    <center>
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
    </h3>
    
        <br>
        <hr>
        <input type="submit" class="c" name="register" value="Register">
        <br>
        <br>
</form>
    </center>
</div>

<br>
<br>
<div class="AFIM">
    <h1><center>Employees</center></h1>
    <hr>
    <br>
    
    <?php
      $query2 = mysqli_query($con,"select * from employees");
      if(mysqli_num_rows($query2)){
        while($data=mysqli_fetch_array($query2)){
            $id=$data['ID'];
            if(isset($_POST[$id])){
                $q = mysqli_query($con,"delete from employees where ID=$id");
            }
      ?>
      <center>
          <div class="Inventory_items">
            <div class="emp-name"><b><?php echo $data['Name']; ?></b></div>
            <div class="emp-phn"><?php echo $data['Contact_no']; ?></div>
            <form method="post">
            <input type="submit" name="<?php echo $id;?>" value="Fire" class="b">
            </form>
          </div>
          <hr>
      </center>
      <?php
                    }
                }
              ?>  
   
</div>
</div>

<div id="About" class="tabcontent">
    <div class="AFIM">
        <h1><center>Check Sales</center></h1>
        <hr>
        <br>
        <center>
            
            </table>
            <form method="post">
            <b>Enter Time Range:</b>From <input type="date" name="from"> to  <input type="date" name="to"> <br><br>
            
            <input type="submit" name="view" class="c" value="View">
            </form>
            <br>
            <br>
            <table>
                
            <?php
            if(isset($_POST['view'])){
                $from=$_POST['from'];
                $to=$_POST['to'];
                $earnings=0;
               echo  "<tr><th>Product</th><th>Price</th><th>Quantity</th><th>Net</th><th>Date</th>";
                
              $q = mysqli_query($con,"select * from sales where date between '$from' and '$to'");
                if(mysqli_num_rows($q)){
                    while($data=mysqli_fetch_array($q)){
                        ?>
                <tr><td><?php echo $data['pdt_name'];?></td><td><?php echo $data['pdt_price'];?></td><td><?php echo $data['pdt_quantity'];?></td><td><?php echo $data['total'];?></td><td><?php echo $data['date'];?></td>
                        <?php $earnings=$earnings+$data['total']; ?>
<?php
                    }

            }
            echo "<b>Total Earnings: </b>".$earnings."<br>";
        }
            ?>
           </table>
        </center>
    </div>
</div>

<script src="admin-module.js"></script>

</body>
</html>

