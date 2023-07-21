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
                        <div class="cart"> <a href="cart.php"><i class="fa-solid fa-cart-shopping fa-2xl" style="color:rgb(255, 255, 255);" ></i></a></div>
                        <div class="profile"><a href="profile.php"><i class="fa-solid fa-user fa-2xl" style="color: yellow;"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container-fluid">                                                                          
        <div class="row ">
            <div class="profilesection col-2">
                <h2 class="text-center profileword">PROFILE</h2>
                <div class="profilenavbar">
                    <h5 class="text-center border"><a href="profile.php"><span style="color:red;">All Orders</span></a></h5>
                    <h5 class="text-center border"><a href="profileprocessing.php">Processing</a></h5>
                    <h5 class="text-center border"><a href="profiletoship.php">To Ship</a></h5>
                    <h5 class="text-center border"><a href="profiletoreceive.php">To Receive</a></h5>
                    <h5 class="text-center border"><a href="profilecomplete.php">Complete</a></h5>
                    
                </div>
                <div class="profilesetting">
                    <h6 class="text-center"><a href="helpcenter.php">Help</a></h6>
                    <h6 class="text-center"><a href="feedback.php">Feedback</a></h6>
                    <h6 class="text-center"><a href="logout.php" class="text-danger">Log Out</a></h6>
                </div>
                    
             
            </div>
            <!-- rgb(241, 241, 241); -->
            <div class="col-10 ">

                <h1 class="text-center mt-3">ShoeTa Return/ Refund Form</h1>
                <div class="d-flex justify-content-center">
                    <div class="container m-2 p-5" style="box-shadow:5px 5px 5px grey;width:50%;background-color:rgb(250, 250, 250);">
                        <div class="row">
                            <form action="returnrefund.php" method ="post" enctype="multipart/form-data">
                                <?php
                                   
                                    include 'connect.php';
                                    

                                    if(ISSET($_POST['submit'])){
                                        
                                        $image = $_FILES['fileToUpload']['name'];
                                        $returnto = $_POST['returnto'];
                                        $reason = $_POST['reason'];
                                        
                                        if($returnto == 1){
                                            $returnto = "Gcash";
                                        }elseif($returnto == 2){
                                            $returnto = "Cash on Delivery";
                                        }

                                        if(!empty($returnto)){
                                            $sql = "INSERT INTO refund_return (returnto,reason)VALUES('$returnto','$reason')";
                                        $query = mysqli_query($con, $sql);
                                        if($query){
                                            echo "<span class='text-success'>Successful</span>";
                                            header("Location: profile.php");
                                            exit;
                                        }else{
                                            echo "<span class='text-danger'>Failed</span>";
                                        }

                                        }else{
                                            echo "<span class='text-danger'>Failed</span>";
                                        }
                                        
                                    }

                                
                                   
                                ?>

                                <!-- <div class="col-12 d-flex mb-4" style="box-shadow:2px 2px 2px grey; width:100%; background-color:rgb(241, 241, 241);">
                                    <div class="col-1">
                                        <div style="width: 100%; min-width: 150px;"><a href="#"><img src="" alt="" width="100%" height="auto"></a></div>
                                    </div>
                                    <div class="col-7 text-center p-3">
                                    <h5>name></h5>
                                    <h6>brand</h6>
                                    <h6>price</h6>
                                </div>
                                <div class="col-4 p-5">
                                    <h6>Quantity: 1</h6>
                                </div>
                                </div> -->
                                
                                <div class="col-12">
                                   
                                    <div class="form-group">
                                        <input type="hidden" value="<?php echo $queryproduct['id']; ?>" name="productid">
                                        <h6 class="text-start ms-5">Return to:</h6>
                                        <select name="returnto" id="" class="ms-5">
                                            <option value="">Select one...</option>
                                            <option value="1">Gcash</option>
                                            <option value="2">Cash on Delivery</option>
                                        </select>
                                        <br>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                    <h6 class="text-start ms-5">Reason:</h6>
                                        <textarea class="p-3 ms-5" style="height:150px; width: 90%;" placeholder="Write here..." type="text" name="reason"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <h6 class="text-start ms-5">Image/Video:</h6>
                                        <input type="file" class="form-control" name="fileToUpload" id="fileToUpload"  style="margin-left:50px; width: 90%; height: auto; border: 1px solid grey;" >
                                        <br>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        
                                        <input type="submit" class="form-control btn btn-primary" name="submit"style="margin-left:50px; width: 90%; height: auto; border: 1px solid grey;" value="SUBMIT">
                                        <br>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
                </div>
                
            </div>

            
           

            
        </div>
    </div>
    <style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

    
</body>
</html>
