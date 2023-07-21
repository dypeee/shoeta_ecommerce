<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>ShoeTa</title>
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 navbar1" style="background-color:#0B3537; height: 100vh;">
                    <div class="logo"><span>S</span>hoe<span>T</span>a</div>
                    <ul>
                        <li><a href="AdminDashboard.php">Dashboard</a></li>
                        <li><a href="adminorder.php">Orders</a></li>
                        <li><a href="#"><span style="background-color: #D82121; padding: 10px;">Products</span></a></li>
                        <li><a href="adminchat.php">Chat</a></li>
                        <li><a href="adminfeedback.php">Feedback</a></li>
                    </ul>
                    
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="navbar">
                        <div class="col-5">
                            <h1>Products</h1>
                        </div>
                       <div class="col-6">
                        <div class="search">
                            <i class="fa fa-search"></i>
                            <input type="text" placeholder="  Search..">
                        </div>
                       </div>
                        
                        
                    </div>
                </div>
                
                <!--Edit Product-->
                <div class="container border border-dark p-5 mt-5">
                    <?php
                    include 'connect.php';
                    
                    if(ISSET($_POST['add'])){

                        
                        $image = $_FILES['fileToUpload']['name'];
                        $productname = $_POST['name'];
                        $brand = $_POST['brand'];
                        $price = $_POST['price'];
                        $stock = $_POST['stock'];

                        $sql = "INSERT INTO product(image,productname,brand,stock,price)VALUES('$image','$productname','$brand','$stock','$price')";
                        $query = mysqli_query($con,"$sql");

                        if($query){
                            echo '<span class="text-success h3">Added Successfully</span>';
                            header("location: adminproducts.php");
                        }else{
                            echo 'error';
                        }
                        
                    }

                    ?>
                    <form action="adminproductadd.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <h6 class="text-start ms-5">ProductName:</h6>
                                    <input type="text" class="form-control" name="name"  placeholder="Name" style = "margin-left:50px; width: 90%; height: 50px; border: 1px solid grey;"  Required>
                                    <br>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h6 class="text-start ms-5">Brand:</h6>
                                    <input type="text" class="form-control" name="brand"  placeholder="Brand" style = "margin-left:50px; width: 80%; height: 50px; border: 1px solid grey;"  Required>
                                    <br>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h6 class="text-start ">Stock:</h6>
                                    <input type="number" class="form-control" name="stock"  placeholder="Stock" style = "margin-left:5px; width: 80%; height: 50px; border: 1px solid grey;"  Required>
                                    <br>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h6 class="text-start">Price:</h6>
                                    <input type="number" class="form-control" name="price"  placeholder="Price" style = "margin-left:5px; width: 80%; height: 50px; border: 1px solid grey;"  Required>
                                    <br>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <h6 class="text-start ms-5">Image:</h6>
                                <input type="file" name="fileToUpload" id="fileToUpload" class="ms-5" >
                                <br>
                            </div>

                            <div class="col-4" style="margin-left:35%;">
                                <div class="form-group">
                                    <input type="submit" class="form-control btn btn-primary m-5" value="Add" name="add" style="width:50%;">
                                    <br>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
   

</body>
</html>