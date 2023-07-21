<?php
include "connect.php";
$get_id = $_GET['id'];
session_start();

$sql = "DELETE FROM product WHERE id = '$get_id'";
$query = mysqli_query($con, $sql);

if($query == "TRUE"){
    
    header("location: adminproducts.php");
}else{
    
    header("location: adminproducts.php");
}
$con->close();
?>