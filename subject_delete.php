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
 * Time: 3:14 PM
 */
require "connection.php";
if(isset($_POST["subject_id"])){
    if(mysqli_num_rows($conn->query("SELECT * FROM `acquisition` WHERE `subject_id` = '".$_POST["subject_id"]."' AND `date_deleted` IS NULL")) > 0){
        echo "<script>swal('','Cannot Delete Subject, it is assigned to one or more acquisition','error');
        setInterval(() => {
            window.history.back();            
        }, 2000);
</script>";
    }
    else {
        $stmt = $conn->query("UPDATE `subjects` SET date_deleted = CURRENT_DATE WHERE subject_id = '" . $_POST['subject_id'] . "'");
        if ($stmt) {
            echo "<script>swal('','Subject Deleted Successfully','success');
               setInterval(() => {
                window.history.back();   
               }, 2000);
                </script>";
        }
    }

}