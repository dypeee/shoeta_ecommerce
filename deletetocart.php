<?php
include "connect.php";
//id ng product sa cartmanager 297
$get_id = $_GET['id'];
session_start();

$sql = "SELECT FROM cartmanager WHERE id = '$get_id'";
$query = mysqli_query($con, $sql);

if($query == "TRUE"){
    $sql = "DELETE FROM cartquantity  WHERE id = '$get_id''";
    header("location: cart.php");
}else{
    
    header("location: cart.php");
}
$con->close();
?>