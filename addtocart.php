<?php


session_start();
    require 'connect.php';

if(!empty($_SESSION['add'])){
    $addtocart = $_SESSION['add'];
    
}
session_start();

$sql = "SELECT FROM cartmanager WHERE id = '$addtocart'";
$query = mysqli_query($con, $sql);
$product = mysqli_fetch_assoc($query);
if($query == "TRUE"){
    $userid = $product['userid'];
    $image = $product['image'];
    $productname = $product['productname'];
    $brand = $product['brand'];
    $price = $product['price'];
    $size = $product['size'];
    $quantity = $product['quantity'];
    $color = $product['color'];

    $insertproduct = mysqli_query($con,"INSERT INTO cartquantity (userid, image, productname, brand, price, size, quantity, color)
    VALUES ('$userid', '$image', '$productname', '$brand', $price, '$size', $quantity, '$color')");
    header("location: cart.php");
}else{
    
    header("location: cart.php");
}
$con->close();
?>