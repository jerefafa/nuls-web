<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: Joyce Balinquit
 * Date: 31/05/2018
 * Time: 2:10 PM
 */
require "connection.php";
if(isset($_POST["user_id"])){
    if(mysqli_num_rows($conn->query("SELECT * FROM `circulation` WHERE `borrower_id` = '".$_POST["user_id"]."' ")) > 0){
        echo "<script>swal('','Cannot Delete User, already had a transaction with the library','error')
        setInterval(() => {
          ;window.history.back();
        }, 2000);</script>";
    }
    else {
        $stmt = $conn->query("UPDATE `users` SET date_deleted = CURRENT_DATE WHERE user_id = '" . $_POST['user_id'] . "'");
        if ($stmt) {
            echo "<script>swal('','User Deleted Successfully','success');
            setInterval(()=> {
                location.href='Users.php';
            },2000);</script>";
        }
    }
}