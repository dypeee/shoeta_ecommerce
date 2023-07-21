<?php
    include "connect.php";
    $get_id = $_GET['id'];
    session_start();
 
    $sql = "DELETE FROM orders WHERE id = '$get_id'";
    $query = mysqli_query($con, $sql);

    if($query == "TRUE"){
        
        header("location: profile.php");
    }else{
        
        header("location: profile.php");
    }
    $con->close();
?>