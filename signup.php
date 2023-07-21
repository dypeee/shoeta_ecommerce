<?php
    
     session_start();
     if(!empty($_SESSION['id'])){
        header("Location: home.php");
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
<body style="background-color: #0B3537;">
    <img src="LOGO.png" alt="" style="height: 150px; margin-left: 50px;">
    <div class="container mt-3">
        <h1 class="text-center text-white ">SIGN UP</h1>
        <div class="container bg-light rounded-5 p-5">
            <form action="signup.php" method= "post">
            <?php
                $invalidemail = "";
                $invalidpassword = "";
                $notmatchpassword = "";
                $alreadyexist ="";
                $invalidnumber ="";

                
                require 'connect.php';
                if (isset($_POST["submit"])){
                    $name = $_POST['name'];
                    $address = $_POST['address'];
                    $number = $_POST['number'];
                    $payment = "Enter Mode of Payment";
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $confirmpassword = $_POST['confirmpassword'];

                    $errors = array();
                     // validation for gender field
                     
                
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $invalidemail = "<span class='text-danger ms-5'>Invalid Email</span>";
                    }
                 

                    if (strlen($password) < 8) {
                        $invalidpassword = "<span class='text-danger ms-5'>Password must be at least 8 characters long</span>";
                    
                    } else if(strlen($number) != 11){
                        $invalidnumber = "<span class='text-danger ms-5'>Invalid Number</span>";
                    }
                    else {
                        $duplicate = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");
                    
                        if (mysqli_num_rows($duplicate) > 0) {
                            $alreadyexist = "<span class='text-danger ms-5'>Email Already Exists</span>";
                        } else {
                            if ($password == $confirmpassword) {
                                $query = "INSERT INTO users (name,address,number,payment,email, password) VALUES ('$name','$address','$number','$payment','$email', '$password')";
                                mysqli_query($con, $query);
                                header("Location: login.php");
                                echo "<span class='text-success'>Registration Successful</span>";
                            } else {
                                $notmatchpassword = "<span class='text-danger ms-5'>Password does not match</span>";
                            }
                        }
                    }
                }
            ?>



                <div class="row">
                    <div class="col-6">
                            <div class="form-group">
                                <h6 class="text-start ms-5">Name:</h6>
                                <input type="text" class="form-control" name="name"  placeholder="Name" style = "margin-left:50px; width: 80%; height: 50px; border: 1px solid grey;"  Required>
                                <br>
                            </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <h6 class="text-start ms-5 ps-4">Email</h6>
                            <input type="text" class="form-control" name="email"  placeholder="Email" style = "margin-left:50px; width: 80%; height: 50px; border: 1px solid grey;"  Required>
                            <?php if($invalidemail){echo $invalidemail;}?>
                            <?php if($alreadyexist){echo $alreadyexist;}?>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mt-2">
                            <h6 class="text-start ms-5">Address:</h6>
                            <input type="text" class="form-control" name="address"  placeholder="Address" style = "margin-left:50px; width: 80%; height: 50px; border: 1px solid grey;"  Required>
                            <br>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <h6 class="text-start ms-5 ps-4">Password</h6>
                            <input type="password" class="form-control"  name="password" placeholder="Password" style = "margin-left:50px; width: 80%; height: 50px; border: 1px solid grey;" Required>
                            <?php if($invalidpassword){echo $invalidpassword;}?>
                                
                            <br>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mt-2">
                            <h6 class="text-start ms-5">Phone Number:</h6>
                            <input type="text" class="form-control" name="number"  placeholder="Phone Number" style = "margin-left:50px; width: 80%; height: 50px; border: 1px solid grey;"  Required>
                            <?php if($invalidnumber){echo $invalidnumber;}?>
                            <br>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <h6 class="text-start ms-5 ps-4">Confirm Password</h6>
                            <input type="password" class="form-control"  name="confirmpassword" placeholder="Confirm Password" style = "margin-left:50px; width: 80%; height: 50px; border: 1px solid grey;" Required>
                            <?php if($notmatchpassword){echo $notmatchpassword;}?>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-6">
                        <div class="form-group">
                            <h6 class="text-start ms-5">Payment Method:</h6>
                            <div class="col-7 ms-5">
                                <input type="radio" class="form-check-input" name="payment" value="1"> GCash
                                <span style="padding-left: 15px"></span>
                                <input type="radio" class="form-check-input" name="payment" value="2"> Cash On Delivery <br>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-6 text-center">
                        <div class="form-group">
                            <!-- <input type="submit" value="Signup" name="submit";> -->
                            <!-- <a href="login.php" class="btn btn-primary mt-4" value="signup" name="submit">SIGN UP</a> -->
                            <button class="btn btn-primary mt-4" value="signup" name="submit">SIGN UP</button>
                        </div>
             
                    </div>
                    
                </div>
            </form>
        </div>
    </div>

</body>
</html>