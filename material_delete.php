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
 * Date: 29/05/2018
 * Time: 2:25 PM
 */

require "connection.php";
if(isset($_POST["material_type_id"])){
    if(mysqli_num_rows($conn->query("SELECT * FROM `catalog` WHERE `material_type_id` = '".$_POST["material_type_id"]."' AND `date_deleted` IS NULL")) > 0) {
        echo "<script>swal('','Cannot Delete Material Type, Assigned to one or more catalog','error')
        setInterval(() => {
    window.history.back();
        }, 2000);</script>";
    }
    else {

        $stmt = $conn->query("UPDATE `material_types` SET date_deleted = CURRENT_DATE WHERE material_type_id = '" . $_POST['material_type_id'] . "'");
        if ($stmt) {
            echo "<script>swal('','Material Type Deleted Successfully','success');
            setInterval(() => {
location.href='MaterialType.php';
            }, 2000);</script>";
        }
    }

}