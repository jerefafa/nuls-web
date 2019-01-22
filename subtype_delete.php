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
 * Time: 2:44 PM
 */

require "connection.php";
if(isset($_POST["subtype_id"])){
    if(mysqli_num_rows($conn->query("SELECT * FROM `catalog` WHERE `subtype_id` = '".$_POST["subtype_id"]."' AND `date_deleted` IS NULL")) > 0){
        echo "<script>swal('','Cannot Delete Subtype, assigned to one or more Catalog','error');
         setInterval(() => {
            window.history.back(); 
         }, 2000);</script>";
    }
    else {
        $stmt = $conn->query("UPDATE `subtypes` SET date_deleted = CURRENT_DATE WHERE subtype_id = '" . $_POST['subtype_id'] . "'");
        if ($stmt) {
            echo "<script>swal('','Subtype Deleted Successfully','success');
               setInterval(() => {
                  window.history.back(); 
               },2000);</script>";
        }
    }

}