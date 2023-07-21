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
                        <li><a href="#"><span style="background-color: #D82121; padding: 10px;">Chat</span></a></li>
                        <li><a href="adminfeedback.php">Feedback</a></li>
                    </ul>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="navbar">
                        <div class="col-5">
                            <h1>Chat</h1>
                        </div>
                       <div class="col-6">
                        <div class="search">
                            <i class="fa fa-search"></i>
                            <input type="text" placeholder="  Search..">
                        </div>
                       </div>
                        
                        
                    </div>
                </div>

<!-- sample -->

        <?php
            include 'connect.php';
            if(ISSET($_POST['send'])){
                $chat = $_POST['chat'];
                
                $query = mysqli_query($con,"INSERT INTO chatmanager(adminchat)VALUES('$chat')");
                
                // if($query){
                     // if(mysqli_num_rows($display)>0){
                    //     while( $chatdata = mysqli_fetch_assoc($display)){
                    //         $userchat = "<span style='border: 1px solid black ; width: 30%; background-color: #0B3537; color: white; border-radius: 20px; padding:10px;'";

                    //     }
                    // }
                    
                // }
            }
        ?>
            
            

            



    <div class="container border border-dark p-5 mt-4 " style="background-color:#0B3537; width:800px; box-shadow:5px 5px 5px grey; height:800px">
        <div class="row">
            <div class="col-12"><h1 class="text-center text-warning">Message</h1></div> 
            <div style="overflow-y: scroll; height:590px; background-color:white;" class="border p-2">
           




            <?php

                $display = mysqli_query($con,"SELECT*FROM chatmanager");
                if(mysqli_num_rows($display)>0){
                    while( $chatdata = mysqli_fetch_assoc($display)){
                        
                        $admin = $chatdata['adminchat'];
                        $user = $chatdata['userchat'];
                        
            ?>
            <table class="d-flex justify-content-end me-3">
                <tr>
                    <td class="h3 pe-3 pb-2"><span style="width: 30%;" ><?php echo $admin;?></span</td>
                </tr>
            </table>

            <table class="d-flex justify-content-start ms-3">
                <tr>
                    <td class="h3 ps-3 pb-2"><span style="width: 30%;" ><?php echo $user;?></span</td>
                </tr>
            </table>

            
            
            <?php
                    }
                }
            ?>
            </div>
            
        </div>
        

        <div class="row mt-2" style="background-color: white; border-radius: 10px;">
            <div class="col-1 d-flex justify-content-center">
                <i class="fa-regular fa-image" style="color: #000000; border-right: 1px solid grey; padding: 10px; font-size: 1.5em;"></i>   
            </div>
            <div class="col-10">
                <form action="adminchat2.php" method="POST">
                    <input type="text" name="chat" style="padding: 10px; font-size:20px;margin-left:-15px;">
                
                
            </div>
            <div class="col-1 d-flex justify-content-center">
                
                <button class="btn btn-primary m-1 me-3" type="submit" name="send">Send</button>
                </form>
                <!-- <i class="fa fa-paper-plane" style="color: #000000; font-size: 1.5em; margin-top: 10px;"></i>   -->
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>


</body>
</html>