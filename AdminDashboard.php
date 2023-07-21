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
                        <li><a href="#"><span style="background-color: #D82121; padding: 10px;">Dashboard</span></a></li>
                        <li><a href="adminorder.php">Orders</a></li>
                        <li><a href="adminproducts.php">Products</a></li>
                        <li><a href="adminchat.php">Chat</a></li>
                        <li><a href="adminfeedback.php">Feedback</a></li>
                    </ul>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="navbar">
                        <div class="col-5">
                            <h1>Dashboard</h1>
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
                        <?php
                            include "connect.php";
                            $pendingquery = mysqli_query($con,"SELECT COUNT(status) FROM Orders WHERE status='processing' OR status='to deliver' OR status='to ship'OR status='to receive'");
                            $pending =  mysqli_fetch_assoc($pendingquery);

                            $completequery = mysqli_query($con,"SELECT COUNT(status) FROM Orders WHERE status='complete'");
                            $complete =  mysqli_fetch_assoc($completequery);

                            $totalpricequery = mysqli_query($con,"SELECT SUM(price*quantity) FROM Orders WHERE status='complete'");
                            $totalprice =  mysqli_fetch_assoc($totalpricequery);
                            
                            
                        ?>
                        <div class="row mt-5">
                            <div class="col-4">
                                <div class="cont1"style="background-color: rgba(203, 203, 203, 0.667);">
                                    <h4>Pending:</h4>
                                    <h1 class="text-center pb-5"><?php echo $pending['COUNT(status)']+0; ?></h1>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="cont1"style="background-color: rgba(203, 203, 203, 0.667);">
                                    <h4>Complete:</h4>
                                    <h1 class="text-center pb-5"><?php echo $complete['COUNT(status)']+0; ?></h1>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="cont1"style="background-color: rgba(203, 203, 203, 0.667);">
                                    <h4>Total Sales:</h4>
                                    <h1 class="text-center pb-5"><?php echo $totalprice['SUM(price*quantity)']+0; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="customerlist">
                                    
                                    <h3>Customer List:</h3>
                                    
                                    <table>
                                    <tr>
                                        <th style="width:.5%">ID:</th>
                                        <th>Name:</th>
                                        <th>Address:</th>
                                        <th>Phone No.:</th>
                                        <th>Payment Method:</th>
                                        <th>Email:</th>
                                        <th>Password:</th>
                                    </tr>

                                    <?php
                                        
                                        $sql = "SELECT * FROM users";
                                        $query = mysqli_query($con,$sql);
                                        
                                        if(mysqli_num_rows($query)>0){
                                            while($row =  mysqli_fetch_assoc($query)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['number']; ?></td>
                                        <td><?php echo $row['payment']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['password']; ?></td>
                                    </tr>
                                    <?php
                                            }
                                        }else{
                                            echo "No records found";
                                        }
                                        mysqli_close($con);
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
        .customerlist{
            margin-top: 40px;
            
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