<?php
session_start();
if(!empty($_SESSION['id'])){
    $userid = $_SESSION['id'];
 
    }
include 'connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['quantity'])) {
        $id = $_POST['id'];
        $quantity = $_POST['quantity'];
        $size = $_POST['size'];

       
     
        if (empty($size)) {
      
            $fetchSizeSql = "SELECT size FROM cartmanager WHERE id = '$id'";
            $fetchSizeResult = mysqli_query($con, $fetchSizeSql);
            
            if ($fetchSizeResult && mysqli_num_rows($fetchSizeResult) > 0) {
                $row = mysqli_fetch_assoc($fetchSizeResult);
                $size = $row['size'];
            }
        }

      
        $updateSql = "UPDATE cartmanager SET quantity = '$quantity', size = '$size' WHERE id = '$id'";
        mysqli_query($con, $updateSql);
    }
   
    if (isset($_POST['selectedProducts'])) {
        $selectedProducts = $_POST['selectedProducts'];
        
        foreach ($selectedProducts as $productId) {
            // Fetch product details based on the ID
            $fetchProductSql = "SELECT * FROM cartmanager WHERE id = '$productId'";
            $fetchProductResult = mysqli_query($con, $fetchProductSql);
            
            if ($fetchProductResult && mysqli_num_rows($fetchProductResult) > 0) {
                $productRow = mysqli_fetch_assoc($fetchProductResult);
                
                // Save the product details in the 'orders' table
                $image = $productRow['image'];
                $productName = $productRow['productname'];
                $price = $productRow['price'];
                $brand = $productRow['brand'];
                $size = $productRow['size'];
                $quantity = $productRow['quantity'];
                $status = "Processing";

                $userQuery = mysqli_query($con, "SELECT name FROM users WHERE id ='$userid'");
                $userData = mysqli_fetch_assoc($userQuery);
                $name = $userData['name'];

                
                $insertOrderSql = "INSERT INTO orders (userid,username,image, productname,brand, price, size, quantity,status) VALUES ('$userid','$name','$image', '$productName','$brand', '$price', '$size', '$quantity','$status')";
                mysqli_query($con, $insertOrderSql);
            }
        }
        header("Location: orderconfirmation.php?id=<?=$id; ?>");
        exit();
    }

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="testing.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>ShoeTa</title>
</head>

<body>
    
    <div class="container-fluid" style="background-color: #0B3537;">                    <!--Header/Navbar-->
        <div class="row">
            <div class="navbar">
                <div class="col-6">
                    <div class="logo"><a href="home.php" class="display-1"><span>S</span>hoe<span>T</span>a</a></div>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <div class="iconnavbar">
                        <div class="cart"> <a href="cart.php"><i class="fa-solid fa-cart-shopping fa-2xl" style="color:yellow;" ></i></a></div>
                        <div class="profile"><a href="profile.php"><i class="fa-solid fa-user fa-2xl" style="color: #ffffff;"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" style="box-shadow: 1px 1px 5px black;">                <!--Brand Section-->
        <div class="row brand">
            <div class="col-2"><a href="nike.php" class="h5">Nike</a></div>
            <div class="col-2"><a href="adidas.php" class="h5">Adidas</a></div>
            <div class="col-2"><a href="puma.php" class="h5">Puma</a></div>
            <div class="col-2"><a href="converse.php" class="h5">Converse</a></div>
            <div class="col-2"><a href="vans.php" class="h5">Vans</a></div>
            <div class="col-2">
                <div class="search">
                    <i class="fa fa-search"></i>
                    <input type="text" placeholder="  Search..">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-start p-4">
                <input type="checkbox" style="width: 20px; margin-right: 10px; height: 20px;">
                <label for="all"><h6>Select All</h6></label>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-7">
                <?php
                    include 'connect.php';
                    
                    $sql = "SELECT * FROM cartmanager WHERE userid = '$userid' ORDER BY id DESC;";
                    

                    $query = mysqli_query($con,$sql);

                    if(mysqli_num_rows($query)>0){
                        while($row = mysqli_fetch_assoc($query)){
                        $id = $row['id'];  
                        $_SESSION['price'] = $row['price'];
                ?>
                
                <div class="row bg-light m-3 p-2">
               
                    <div class="col-1 d-flex justify-content-end">
                         <form action="cart.php" method="POST">
                            <input type="checkbox" id="myCheck" onclick="myFunction()" name="selectedProducts[]" value="<?php echo $id; ?>" style="width: 20px; height: 20px; margin-right: 10px;">
                            <script>
                                function myFunction() {
                                    // Get the checkbox
                                    var checkBox = document.getElementById("myCheck");
                                    // Get the displayText and updatedTotal elements
                                    var displayText = document.getElementById("text");
                                    var updatedTotal = document.getElementById("updatedTotal");
                                
                                    // If the checkbox is checked, display the elements
                                    if (checkBox.checked == true) {
                                        displayText.style.display = "block";
                                        updatedTotal.style.display = "block";
                                        
                                    } else {
                                        displayText.style.display = "none";
                                        updatedTotal.style.display = "none";
                                    }
                                }
                            </script>
                            </form>
                    </div>
                       
                    <div class="col-md-3 d-flex justify-content-start align-items-center">
                        <div>
                            <div style="width: 100%; min-width: 150px;"><a href="#"><img src="<?php echo $row['image']?>" alt="" width="100%" height="auto"></a></div>
                            <span class="fw-bold d-flex justify-content-center"><?php echo $row['brand']?></span>
                        </div>
                    </div>
                    <div class="col-md-4 col py-4 justify-content-center text-center">
                        <div>
                            <h6><?php echo $row['productname']?></h6>
                            <h6 class="ps-2"><?php echo $row['color']; ?></h6>
                            <div style="margin: auto; display: flex; justify-content: center;">
                                <form action="cart.php" method="POST" style="width: 200px;">
                                    <select name="size"  class="form-select col-12" >
                                        <option value="">Size: US <?php echo $row['size']?></option>
                                        <option value="3.5">Size: US 3.5</option>
                                        <option value="4">Size: US 4</option>
                                        <option value="4.5">Size: US 4.5</option>
                                        <option value="5">Size: US 5</option>
                                        <option value="5.5">Size: US 5.5</option>
                                        <option value="6">Size: US 6</option>
                                        <option value="6.5">Size: US 6.5</option>
                                        <option value="7">Size: US 7</option>
                                        <option value="7.5">Size: US 7.5</option>
                                        <option value="8">Size: US 8</option>
                                        <option value="8.5">Size: US 8.5</option>
                                        <option value="9">Size: US 9</option>
                                        <option value="9.5">Size: US 9.5</option>
                                        <option value="10">Size: US 10</option>

                                    </select>
                              
                            </div>
                            <h6 class="mt-5">Total: PHP <?php echo $row['quantity']*$row['price']?>  </h6>
                            
                        </div>
                    </div>
                    
                        <div class="col-md-4  py-5 d-flex justify-content-center" >
                            <div class="col-6">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="col-6 form-group ms-5" style="border:solid 1px black; width: 190px; ">
                                    <input name="quantity" class="text-center" value="<?php echo $row['quantity']?>" min="1" oninput="this.value = Math.max(this.value, 1)" style="width:200px;height:40px; font-size:30px; background-color:#ffffff00;" type="number">
                                </div>

                                <div class="col-6 d-flex ms-5">
                                    <!-- <a href="update.php?id=< ?=$id; ?>" name="update" class="btn btn-success m-2">Update</a> -->
                                    <input type="submit" name="update" value="Update" class="form-control btn btn-success m-2">
                                    <a href="delete.php?id=<?=$id; ?>" class="btn btn-danger m-2">Delete</a>
                                </div>
                            

                            </div>
                        </div>
                    </form>
                </div>
             
                <?php 
                    }
                    
                 }
                            
                ?>
        
            </div>  


            


            
            <div class="col-xl-5">
                <div class="row">
                    <div class="col-12 bg-light  p-5 d-flex">
                        <div class="col-6">
                            <h5>Product/s</h5>
                            <h5>Shipping</h5>
                           
                            <h3 class="mt-5 fw-bold">Total: </h3>
                        </div>

                        <div class="col-6 text-start ps-5">
                            <div class="d-flex">
                                <h5>: P</h5>
                                <h5 id="text" style="display:none">
                                    <?php 
                                    
                                    $cart = mysqli_query($con, "SELECT * FROM cartmanager");
                                    $row = mysqli_fetch_assoc($cart);
                                    $total = $row['quantity'] * $row['price'];

                                    
                                    $updatedTotal = $total +  150;
                                    echo $total;
                                    echo '<br>';
                                    
                                   
                                    ?>
                                </h5>
                                </div>
                                <h5>: P <?php echo 150 ?></h5>
                             

                            <div class="d-flex mt-5">
                                <h3>: P</h3><h3 id="updatedTotal" class=" fw-bold"><?php if(!empty($total)){echo $updatedTotal ;}?></h3>
                                
                            </div>
                            
                           
                        </div>

                    
                    </div> 
                </div>
                <div class="row">
                    <form action="cart.php" method="POST">
                    <div class="col-12 d-flex justify-content-center">
                        
                        <input type="hidden" name="selectedProducts[]" value="<?php echo $id; ?>">
                        <button class="btn btn-warning fw-bold text-dark" style="width:100%; height:50px; font-size:25px;">Checkout</button>
                        <!-- <div class="wordcart btn rounded-5 p-2" style="background-color: #EBB25D; height: 55px; width: 100%;"><i class="fa fa-cart-circle-check" style="color: #000000;"></i><a href="orderconfirmation.php" style="text-decoration: none; color: black;"><span class="h4">Checkout</span></a></div> -->
                    </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
   
    
</body>
</html>