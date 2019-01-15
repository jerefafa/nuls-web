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
 * Time: 3:21 PM
 */
require "connection.php";
if(isset($_POST["user_id"])){

    if(isset($_POST["ePass"])){
        $password = $_POST['password'];
        //password hashing
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->query("UPDATE `users` SET user_fname='".$_POST['fname']."', user_lname = '".$_POST['lname']."', user_mname = '".$_POST['mname']."', id_number = '".$_POST['idnum']."', username = '".$_POST['uname']."', password = '".$hash."', user_type='".$_POST['utype']."', course_id='".$_POST['program']."',date_deleted = null WHERE user_id = '".$_POST['user_id']."'");
        if($stmt){
            echo "<script>swal('','User Updated Successfully','success');
            setInterval(() => {
                location.href='Users.php';
            }, 2000);
</script>";
        }

    }
    else{
        $stmt1 = $conn->query("UPDATE `users` SET user_fname='".$_POST['fname']."', user_lname = '".$_POST['lname']."', user_mname = '".$_POST['mname']."', id_number = '".$_POST['idnum']."', username = '".$_POST['uname']."', user_type='".$_POST['utype']."', course_id='".$_POST['program']."', date_deleted = null WHERE user_id = '".$_POST['user_id']."'");
        if($stmt1){
            echo "<script>swal('','User Updated Successfully', 'success');
            setInterval(() => {
                location.href='Users.php';
            }, 2000);
</script>";
        }

    }

}