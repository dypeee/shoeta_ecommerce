<?php
    include 'connect.php';

    $error = "";
    $updated = "";
    
    $userQuery = mysqli_query($con, "SELECT name FROM users");
    $userData = mysqli_fetch_assoc($userQuery);
    $name = $userData['name'];

    if(ISSET($_POST['update'])){
        $Query = mysqli_query($con, "SELECT*FROM orders");
        $Data = mysqli_fetch_assoc($Query);
        $id = $Data['id'];
        $statusArray = $_POST['status'];
                            
        foreach ($statusArray as $orderId => $status) {
            if ($status == 1) {
                $status = "Processing";
            } else if ($status == 2) {
                $status = "To Ship";
            } else if ($status == 3) {
                $status = "To Receive";
            } else if ($status == 4) {
                $status = "Complete";
            } else {
                $error = "<span class='text-danger ms-5'>Please Select One</span>";
            }
        
        if(!empty($status)){
            
            $sql = "UPDATE orders SET status='$status' WHERE id='$orderId'";

            $query = mysqli_query($con, $sql);
            
            if($query){
                $updated = "<span class='text-success ms-5'>Updated Successfully</span>";
               
           }else{
               echo "<h6 class='text-danger'>Failed to Updated</h6>";
               
           }
        }
        }

    }
    

?>


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
                        <li><a href="#"><span style="background-color: #D82121; padding: 10px;">Orders</span></a></li>
                        <li><a href="adminproducts.php">Products</a></li>
                        <li><a href="adminchat.php">Chat</a></li>
                        <li><a href="adminfeedback.php">Feedback</a></li>
                    </ul>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="navbar">
                        <div class="col-5">
                            <h1>Orders</h1>
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
                            <div class="col-12 mt-5">
                                <h1 class="text-center">ORDER LIST</h1>
                                
                                <div class="filter">
                                    
                                    <button><a href="adminorder.php" class="text-dark" style="text-decoration:none;">All</a></button>
                                    <button><a href="adminorder1.php" class="text-dark" style="text-decoration:none;">Processing</a></button>
                                    <button><a href="adminorder2.php" class="text-dark" style="text-decoration:none;">To Ship</a></button>
                                    <button><a href="adminorder3.php" class="text-dark" style="text-decoration:none;">To Receive</a></button>
                                    <button><a href="adminorder4.php" class="text-dark" >Complete</a></button>
                                    
                                   
                                </div>
                                <div style="overflow-y: scroll; height:700px; background-color:white;" class="border p-2">
                                <div class="text-center"><?php echo $error; ?><?php echo $updated?></div>
                                <table>
                                
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Order Status</th>
                                    </tr>
                                    
                                    <?php 
                                    $Query = mysqli_query($con, "SELECT*FROM orders");
                                    if(mysqli_num_rows($Query)>0){
                                        while( $Data = mysqli_fetch_assoc($Query)){
                                            $id = $Data['id'];
                                            $productname = $Data['productname'];
                                            $name = $Data['username'];
                                    ?>
                                    <tr>
                                        <td><?php echo $Data['id']?></td>
                                        <td><?php echo $name;?></td>
                                        <td><?php echo $productname?></td>
                                        <td><?php echo $Data['brand']?></td>
                                        <td><?php echo $Data['price'] *= $Data['quantity']?></td>
                                        <td><?php echo $Data['quantity']?></td>
                                        <td>
                                            <form action="adminorder.php" method="POST">
                                                
                                                <select name="status[<?php echo $id; ?>]">
                                                    <option value="0"><?php echo $Data['status']?></option>
                                                    <option value="1">Processing</option>
                                                    <option value="2">To Ship</option>
                                                    <option value="3">To Receive</option>
                                                    <option value="4">Complete</option>
                                                </select>
                                                <!-- <input type="submit" name="update" class="btn btn-success ms-3" value="Update"> -->
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <button class="btn btn-success ms-3" name="update" type="submit">Update</button>
                                            </form>
                                            
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