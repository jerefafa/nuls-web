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
 * Date: 28/07/2018
 * Time: 8:28 PM
 */
require "connection.php";

if(!isset($_POST["course"])){
    header("location:Courses.php");
}
else{
    if($conn->query("INSERT INTO `courses`(`program_id`,`course`) VALUES('".$_POST["program"]."','".$_POST["course"]."')")){
        echo "<script>
            swal('','Course added','success');
            setInterval(() => {
                location.href='Courses.php';
            }, 2000);
        </script>";
    }else{
        echo "<script>
            swal('','Adding Failed','error');
            setInterval(() => {
                location.href='Courses.php';
            }, 2000);
        </script>";
    }
}