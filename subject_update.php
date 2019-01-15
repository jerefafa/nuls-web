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
 * Date: 28/05/2018
 * Time: 11:45 AM
 */
require "connection.php";
if(isset($_POST["subject_id"])){
    if(isset($_POST["udSub"])){
        $stmt = $conn->query("UPDATE `subjects` SET subject_name='".$_POST['subject']."', `program_id`='".$_POST['program']."' WHERE subject_id = '".$_POST['subject_id']."'");
        if($stmt){
            echo "<script>swal('','Program Updated Successfully','success');
            setInterval(() => {
location.href='Assets.php';
            },2000);</script>";
        }

        else {
            echo "<script>swal('Program Update Error');
 setInterval(() => {
location.href='Assets.php';
            },2000);</script>";
        }
    }
}