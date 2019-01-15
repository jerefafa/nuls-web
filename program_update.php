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
 * Date: 27/05/2018
 * Time: 2:19 PM
 */
require "connection.php";
if(isset($_POST["program_id"])){
    if(isset($_POST["udProg"])){
        $stmt = $conn->query("UPDATE `programs` SET program='".$_POST['aprogram']."' WHERE program_id = '".$_POST['program_id']."'");
        if($stmt){
            echo "<script>swal('','College Updated Successfully','success');
    setInterval(()=> {
        location.href='Program.php';
    }, 2000);
</script>";
        }

        else {
            echo "<script>swal('','College Update Error','error');
         setInterval(() => {
             location.href='Program.php';
         }, 2000);
</script>";
        }
    }
}