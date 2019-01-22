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
 * Time: 8:37 PM
 */
require "connection.php";
if(isset($_POST["course_id"])){
    if(mysqli_num_rows($conn->query("SELECT * FROM `users` WHERE `course_id` = '".$_POST["course_id"]."' AND `date_deleted` IS NULL")) > 0){
        echo "<script>swal('','Cannot Delete Course, assigned to one or more Student','error');
        setInterval(() => {
            window.history.back();
        }, 2000);</script>";
    }
    else {
        $stmt = $conn->query("DELETE FROM `courses` WHERE course_id = '" . $_POST["course_id"] . "'");
        if ($stmt) {
            echo "<script>swal('','Course Deleted Successfully','success');
            setInterval(() => {
            window.history.back();
            }, 2000);</script>";
        } else {
            echo "<script>swal('','Cannot Delete Course','error');
            setInterval(() => {
                window.history.back();
            }, 2000);</script>";
        }
    }

}
else{
    header("location:Courses.php");
}