<?php
    include "connect.php";
    $get_id = $_GET['id'];
    session_start();
 
    $sql = "DELETE FROM cartmanager WHERE id = '$get_id'";
    $query = mysqli_query($con, $sql);
    

    if($query == "TRUE"){
        
        
        header("location: cart.php");
    }else{
        
        header("location: cart.php");
    }
    $con->close();
?>