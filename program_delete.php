<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>
</html>
<?php
require "connection.php";
if(isset($_POST["program_id"])){
    error_reporting(0);
    if(mysqli_num_rows($conn->query("SELECT * FROM `acquisition` WHERE `program_id` = '".$_POST["program_id"]."' AND `date_deleted` IS NULL")) > 0 || mysqli_num_rows($conn->query("SELECT * FROM `courses` WHERE `program_id` = '".$_POST["program_id"]."' AND `date_deleted` IS NULL")) > 0 ){
        echo "<script>swal('','Cannot Delete College, assigned to one or more Acquisition or Courses','error');
        setInterval(() => {
            window.history.back();
        },2000);</script>";
    }
    else {
        $stmt = $conn->query("UPDATE `programs` SET date_deleted = CURRENT_DATE WHERE program_id = '" . $_POST['program_id'] . "'");
        if ($stmt) {
            echo "<script>swal('','College Deleted Successfully','success');
        setInterval(() => {
            window.history.back();
        },2000);</script>";
        }
    }
}