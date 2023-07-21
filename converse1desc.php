<?php
    $idfromurl = $_GET['id'];
    
    session_start();
    require 'connect.php';
    if(!empty($_SESSION['id'])){
        $userid = $_SESSION['id'];
        echo $userid;
    }
    if (isset($_GET['color'])) {
        
        $_SESSION['color'] = $_GET['color'];
 
    }
    include 'connect.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
         if (isset($_POST['size'])) {
        
           $_SESSION['size'] = $_POST['size'];
         }
         
     }
  
?>
<!DOCTYPE
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
                        <div class="cart"> <a href="cart.php"><i class="fa-solid fa-cart-shopping fa-2xl" style="color:rgb(255, 255, 255);" ></i></a></div>
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
    
    
     <?php
     
     $displayquery=mysqli_query($con,"SELECT * FROM  product WHERE id = '$idfromurl'");
     if($displayquery){
         while($display=mysqli_fetch_assoc($displayquery)){
         $id = $display['id'];
        //  $color = isset($_GET['color']) ? $_GET['color'] : "";
     ?>
        <div class="container-fluid">
            <div class="row mt-2 ms-5">
                <div class="col-lg-4 d-flex justify-content-center my-2" >
                        
                        <div class="cartcont" style="width: 90%; height: 100%; align-items: center; border: 1px solid; padding: 20px;">
                            <div class="description">
                                <h2 class="text-center mt-5 pt-4"><b><?php echo $display['productname']?></b><br></h2><!--Change Description-->
                            </div>
                            <div><img src="<?php echo $display['image']?>" alt="" width="100%" height="auto"></div><!--Change Image-->
                            <h4 class="text-end fw-bold pe-5 p-2">Php <?php echo $display['price']?></h4><!--Change Description-->
                        </div>
                        
                </div>

                <div class="col-lg-7 p-2">
                    <div style="width: 100%; border: 1px solid; padding: 20px;">
                        <div class="row">
                            
                        
                            <h2>Colors: <span class="text-primary h5"><?php echo $_SESSION['color'];; ?></span></h2>
                            
                            <!-- change this href-->
                            <div class="col-2">
                                <div class="product "><a href="converse1desc.php?id=<?php echo $id?>&color=Default"><img src="<?php echo $display['image']?>" alt="" width="80%" height="auto" class="productimage"></a></div> <!--Change Image-->
                            </div>
                            <!-- change this href and image color-->
                            <div class="col-2">
                                <div class="product"><a href="converse1desc.php?id=<?php echo $id?>&color=Black"><img src="converse11.png" alt="" width="80%" height="auto" class="productimage"></a></div> <!--Change Image-->
                            </div>
                            <!-- change this  href and image color-->
                            <div class="col-2">
                                <div class="product"><a href="converse1desc.php?id=<?=$id; ?>&color=Grey"><img src="converse12.png" alt="" width="80%" height="auto" class="productimage"></a></div><!--Change Image-->
                            </div>
                            
                        </div>

                     
                        
                        
                        <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $idfromurl . '&color=' . $_SESSION['color']; ?>" method="post">

                            <?php
                            $message="";
                            
                            if(ISSET($_POST['submit'])){
                                $image = $display['image'];
                                $productname = $display['productname'];
                                $brand = $display['brand'];
                                $color = isset($_GET['color']) ? $_GET['color'] : "";
                                $price = $display['price'];
                                $quantity = $_POST['quantity'];

                                $cartsql = mysqli_query($con, "SELECT productname FROM cartmanager WHERE userid = '$userid'");
                                $cartitems = mysqli_fetch_all($cartsql, MYSQLI_ASSOC);
                                $cartproductnames = array_column($cartitems, 'productname');
                                
                                if (!empty($_POST['quantity']) && isset($_SESSION['size']) && !empty($_SESSION['size'])) {
                                    $size = $_SESSION['size'];
                                
                                    if (!in_array($productname, $cartproductnames)) {
                                        // The item does not exist in the cart, so add it
                                        $sql = "INSERT INTO cartmanager (userid, image, productname, brand, price, size, quantity, color)
                                                VALUES ('$userid', '$image', '$productname', '$brand', $price, '$size', $quantity, '$color')";
                                        $query = mysqli_query($con, $sql);
                                
                                        if ($query) {
                                            $message = "Added to Cart";
                                            unset($_SESSION['size']);
                                        } else {
                                            echo mysqli_error($con);
                                        }
                                    } else {
                                        echo '<span class="text-danger h4">Item already exists in cart</span>';
                                        unset($_SESSION['size']);
                                    }
                                }
                            }
                            ?> 
                    
                            <div class="cartcont row ">
                                <div class="col-4 d-flex">
                                    <h2>Size:</h2>
                                    <?php if (isset($_SESSION['size'])): ?>
                                        <h2 class="text-primary"><?php echo $_SESSION['size']; ?></h2>
                                    <?php else: ?>
                                        <h2 class="text-primary">No size selected.</h2>
                                    <?php endif; ?>
                                </div>
                                <!-- <div class="col-4 d-flex">
                                    <h2>Size:</h2> <h2 class="text-primary">< ?php echo $_SESSION['size'];?></h2>
                                </div> -->

                                <div class="col-2 offset-6 mt-2">
                                    <h5></h5>
                                    <!-- <h5>Stock: 
                                        < ?php 
                                            if(empty($stock)){
                                                $productdisplay = mysqli_query($con, "SELECT * FROM product WHERE id=1");
                                                $stock = mysqli_fetch_assoc($productdisplay); 
                                                echo $totalstock = $stock['stock'];
                                            }else{
                                                $productdisplay = mysqli_query($con, "SELECT * FROM product WHERE id=1");
                                                $stock = mysqli_fetch_assoc($productdisplay); 
                                                echo $totalstock = $stock['stock'];
                                            }
                                            
                                        ?></h5> -->
                                </div>
                                <div class="col-3 rounded d-flex justify-content-center">
                                    <button name="size" type="submit" value="3.5">Size:US 3.5</button>
                                </div>
                                <div class="col-3 rounded d-flex justify-content-center">
                                    <button name="size" type="submit" value="4">Size:US 4</button>
                                </div>
                                <div class="col-3 rounded d-flex justify-content-center">
                                    <button name="size" type="submit" value="4.5">Size:US 4.5</button>
                                </div>
                                <div class="col-3 rounded d-flex justify-content-center">
                                    <button name="size" type="submit" value="5">Size:US 5</button>
                                </div>
                                <div class="col-3 rounded d-flex justify-content-center">
                                    <button name="size" type="submit" value="5.5">Size:US 5.5</button>
                                </div>
                                <div class="col-3 rounded d-flex justify-content-center">
                                    <button name="size" type="submit" value="6">Size:US 6</button>
                                </div>
                                <div class="col-3 rounded d-flex justify-content-center">
                                    <button name="size" type="submit" value="6.5">Size:US 6.5</button>
                                </div>
                                <div class="col-3 rounded d-flex justify-content-center">
                                    <button name="size" type="submit" value="7">Size:US 7</button>
                                </div>
                                <div class="col-3 rounded d-flex justify-content-center">
                                    <button name="size" type="submit" value="7.5">Size:US 7.5</button>
                                </div>
                                <div class="col-3 rounded d-flex justify-content-center">
                                    <button name="size" type="submit" value="8">Size:US 8</button>
                                </div>
                                <div class="col-3 rounded d-flex justify-content-center">
                                    <button name="size" type="submit"value="8.5">Size:US 8.5</button>
                                </div>
                                <div class="col-3 rounded d-flex justify-content-center">
                                    <button name="size" type="submit" value="9">Size:US 9</button>
                                </div>
                                <div class="col-3 rounded d-flex justify-content-center">
                                    <button name="size" type="submit"  value="9.5">Size:US 9.5</button>
                                </div>
                                <div class="col-3 rounded d-flex justify-content-center">
                                    <button name="size" type="submit" value="10">Size:US 10</button>
                                </div>
                
                            </div>
                        
                            <div class="row mt-5 pt-5">
                            
                            <div class="col-6 d-flex">
                                    <h1>Quantity:</h1>
                                    
                                </div>
                                <div class="col-6 d-flex justify-content-center">
                                    <div>
                                        <h3 class="text-success  ms-5 ps-5" style="margin-right:100px;"><?php echo $message;?></h3>
                                    </div>
                                </div>
                                <div class="col-6 form-group ms-5" style="border:solid 1px black; width:213.8px; ">
                                    <input name="quantity" class="text-center" value="1" min="1" oninput="this.value = Math.max(this.value, 1)" style="width:200px; font-size:30px;" type="number">
                                </div>
                                
                                <div class="col-6" style="display:flex; justify-content:end; margin-left:200px;">
                                    <a href="chat.php"class="btn btn-success fw-bold px-4">Chat</a>
                                    <input class=" btn btn-primary ms-5" name="submit" type="submit" value="Add to cart">
                                    
                                </div>
                            
                            </div>
                            </form>
                        
                    </div>
                </div>
            </div>
            
        </div>
        <?php
        }
    }
        ?>
        
     
</body>
</html>
