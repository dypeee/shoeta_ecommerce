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
                <div class="row">
                   <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="customerlist">
                                    <h1 class="text-center mt-5">Product List:</h1>
                                    
                                    <div class="filter">
                                        <button><a href="adminproducts.php" >All</a></button>
                                        <button><a href="adminproduct1.php">Nike</a></button>
                                        <button><a href="adminproduct2.php">Adidas</a></button>
                                        <button><a href="adminproduct3.php">Puma</a></button>
                                        <button><a href="adminproduct4.php">Converse</a></button>
                                        <button><a href="adminproduct5.php"style="text-decoration:underline;">Vans</a></button>
                                        <a href="adminproductadd.php" class="btn btn-primary" style="margin-left:50%; color:white;">Add Product</a>
                                    </div>
                                    

                                    <div style="overflow-y: scroll; height:700px; background-color:white;" class="border p-2">
                                        <table>
                                        <tr>
                                            <th style="width:.5%">ID:</th>
                                            <th style="width:10%">Image:</th>
                                            <th>Product Name:</th>
                                            <th>Brand:</th>
                                            <th>Stock:</th>
                                            <th>Price:</th>
                                            <th>Action:</th>
                                        </tr>

                                        <?php 
                                            include 'connect.php';

                                            $query= mysqli_query($con,"SELECT * FROM product WHERE brand ='vans'");
                                            if(mysqli_num_rows($query)>0){
                                                while( $queryproduct = mysqli_fetch_assoc($query)){
                                                $id = $queryproduct['id'];
                                        ?>
                                        <tr>
                                            <td><?php echo $queryproduct['id']?></td>
                                            <td><img src="<?php echo $queryproduct['image']?>" alt="" style="width:100%;"> </td>
                                            <td><?php echo $queryproduct['productname']?></td>
                                            <td><?php echo $queryproduct['brand']?></td>
                                            <td><?php echo $queryproduct['stock']?></td>
                                            <td><?php echo $queryproduct['price']?></td>
                                            <td style="width:13%;">
                                                <button class="btn btn-success px-4"><a href="adminproductedit.php"style="text-decoration:none;color:white;">Edit</a></button>
                                                <a href="deleteadminproduct.php?id=<?=$id; ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        table {

          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        td, th {
          border: 1px solid #000000;
          text-align: left;
          padding: 8px;
        }
        .filter{
            margin-bottom: 15px;
            display: flex;
        }
        .filter a{
            color:black;
            text-decoration:none;
        }
        .filter h3{
            margin-right: 5%;
            margin-left: 2%;
        }
        .filter button{             
            border: 1px solid grey;
            padding: 3px 1% 3px 1%;
            margin-left: 10px;
            border-radius: 5px;
            box-shadow: 1px 1px 2px rgb(99, 99, 99);
        }
        .filter button:active{
            box-shadow: none;
        }
        </style>

</body>
</html>