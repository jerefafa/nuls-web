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
 * Time: 8:48 PM
 */
require "connection.php";
if(!isset($_POST["course_id"])){
    header("location:Courses.php");
}
else{
    if($conn->query("UPDATE `courses` SET `program_id`='".$_POST["program"]."',`course`='".$_POST["course"]."' WHERE `course_id`='".$_POST["course_id"]."'")){
        echo "<script>
               swal('','Course Updated','success');
               setInterval(() => {
                   window.history.go(-2);
               }, 2000);
        </script>";
    }
    else{
        echo "<script>
               swal('','Update Failed','error');
               setInterval(() => {
                   window.history.go(-2);
               }, 2000);
        </script>";
    }
}