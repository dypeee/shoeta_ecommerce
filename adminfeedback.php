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
<body style="background-color: #E8E8E8;">
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 navbar1" style="background-color:#0B3537; height: 100vh;">
                    <div class="logo"><span>S</span>hoe<span>T</span>a</div>
                    <ul>
                        <li><a href="AdminDashboard.php">Dashboard</a></li>
                        <li><a href="adminorder.php">Orders</a></li>
                        <li><a href="adminproducts.php">Products</a></li>
                        <li><a href="adminchat.php">Chat</a></li>
                        <li><a href="#"><span style="background-color: #D82121; padding: 10px;">Feedback</span></a></li>
                    </ul>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="navbar">
                        <div class="col-5">
                            <h1>Feedback</h1>
                        </div>
                       <div class="col-6">
                        <div class="search">
                            <i class="fa fa-search"></i>
                            <input type="text" placeholder="  Search..">
                        </div>
                       </div>
                        
                        
                    </div>
                </div>

                

                <div class="container">

                    <?php
                        include 'connect.php';
                        

                        
                        
                        $query = mysqli_query($con,"SELECT*FROM feedbackform");
                        if(mysqli_num_rows($query)>0){
                            while( $Data = mysqli_fetch_assoc($query)){
                            $userQuery = mysqli_query($con, "SELECT name FROM users");
                            $userData = mysqli_fetch_assoc($userQuery);
                            $name = $userData['name'];

                            
                    ?>

                    <div class="row bg-white m-5 p-3" style="width:90%;">
                        <div class="col-12 text-start d-flex justify-content-between">
                            
                            <div><h2 class="fw-bold"><?php echo $Data['name']?></h2></div>
                        
                            <div><?php  echo date("M d,Y") . "<br>";?></div>
                          
                        </div>
                        <div class="col-12">
                            <h5 class="p-3 text-start"><?php echo $Data['feedback']?></h5>
                        </div>
                        <div class="col-12 text-end d-flex">
                            <p>How likely are you recommended us to a friend?<h5 class="ps-2 text-success"><?php echo $Data['recommend']?></h5></p>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    ?>

                </div>
                
            </div>
        </div>
    </div>

    


</body>
</html>