<?php
session_start();
require 'connect.php';

if(!empty($_SESSION['id'])){
    $userid = $_SESSION['id'];
    
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

<body style="background-color: #E8E8E8;">
    
    <div class="container-fluid" style="background-color: #0B3537;">                    <!--Header/Navbar-->
        <div class="row">
            <div class="navbar">
                <div class="col-6">
                    <div class="logo"><a href="home.php" class="display-1"><span>S</span>hoe<span>T</span>a</a></div>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <div class="iconnavbar">
                        <div class="cart"> <a href="cart.php"><i class="fa-solid fa-cart-shopping fa-2xl" style="color: #ffffff;"></i></a></div>
                        <div class="profile"><a href="profile.php"><i class="fa-solid fa-user fa-2xl" style="color: #ffffff;"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" style="box-shadow: 1px 1px 5px black;">                <!--Brand Section-->
        <div class="row brand">
            <div class="col-2"><a href="nike.php" class="h5">Nike</a></div>
            <div class="col-2"><a href="adidas.php" class="h5"><span class="selected">Adidas</span></a></div>
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
        <div class="row mt-3 brandsection">
            <?php
                include 'connect.php';
                $query=mysqli_query($con,"SELECT * FROM  product WHERE brand = 'adidas'");
                if($query){
                    while($row=mysqli_fetch_assoc($query)){
                    $id = $row['id'];
                    $link =$row['link'];
            ?>
            <div class="col-md-4 col-6  d-flex justify-content-center mt-2">
                <div class="cont">
                    <div class="product"><a href="<?=$link; ?>?id=<?=$id; ?>&color=Default"><img src="<?php echo $row['image']?>" alt="" width="100%" height="auto" class="productimage"></a></div>
                    <div class="description">
                        <h6><span class="fw-bold"><?php echo $row['productname']?></span><br><span>₱ <?php echo $row['price']?></span></h6>
                    </div>
                </div>
            </div>
            <?php
              }
            }
            ?>
        </div>
    </div>
</body>
</html>
