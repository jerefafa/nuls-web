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
 * User: Jeremiah
 * Date: 22/07/2018
 * Time: 5:03 AM
 */
require "connection.php";
if(!isset($_POST["topics"])){
    header("location:Catalog.php");
}
else{
    $topics = $_POST["topics"];
    $arr = explode("\n",$topics);
    $acquisition_number = $_POST["acquisition_number"];
    foreach ($arr as $ar){
       if(!$conn->query("INSERT INTO `keywords`(`acquisition_number`,`keyword`) VALUES('".$acquisition_number."','".$ar."')")){
           echo mysqli_error($conn);
       }
    }
    echo "<script>
            swal('','Topics Added','success');
            setInterval(() => {
            window.history.go(-2);                
            }, 2000);
          </script>";
}