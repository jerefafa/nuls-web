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
 * Time: 6:01 PM
 */
require "connection.php";
if(isset($_POST["supplier_id"])){
    if(mysqli_num_rows($conn->query("SELECT * FROM `acquisition` WHERE `supplier_id` = '".$_POST["supplier_id"]."' AND `date_deleted` IS NULL")) > 0){
        echo "<script>swal('','Cannot Delete Supplier, assigned to one or more Acquisition','error');
        setInterval(() => {
           window.history.back();
        },2000);</script>";
    } else {
        $stmt = $conn->query("UPDATE `suppliers` SET date_deleted = CURRENT_DATE WHERE supplier_id = '" . $_POST['supplier_id'] . "'");
        if ($stmt) {
            echo "<script>swal('','Supplier Deleted Successfully','success');
            setInterval(() => {
                  location.href='Supplier.php';
            },2000);         </script>";
        }
    }

}