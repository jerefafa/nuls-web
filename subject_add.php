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
 * Time: 11:22 PM
 */
require "connection.php";
if(isset($_POST['asubject'])){
    $subject = $_POST['subject'];
    $program = $_POST['program'];

    //Check Subject Existence
    $check_lib = "SELECT * FROM `subjects` WHERE `subject_name` = '$subject'";
    $run_query=mysqli_query($conn,$check_lib);

    if(mysqli_num_rows($run_query)>0) {
        echo "<script>swal('','Subject Already Taken.','error');
        setInterval(() => {
            window.history.back();
        }, 2000);</script>";
    }

    $stmt = $conn->query("INSERT INTO `subjects` (subject_name, program_id, date_deleted) VALUES ('$subject', '$program', NULL)");
    if($stmt){
        echo "<script>swal('','Subject Added Successfully','success');
setInterval(() => {
            window.history.go(-2);
        }, 2000);</script>";
    }
    else{
        echo "<script>swal('','Error Adding the Subject','error');
setInterval(() => {
            window.history.go(-2);
        }, 2000);</script>";
    }
}