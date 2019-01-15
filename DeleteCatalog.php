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
 * Time: 1:08 AM
 */
require "connection.php";
if(!isset($_POST["catalog_id"])){
    header("location:Catalog.php");
}
else{
    $check = mysqli_num_rows($conn->query("SELECT * FROM `catalog` INNER JOIN `circulation` WHERE `catalog`.`catalog_id` = '".$_POST["catalog_id"]."' AND `circulation`.`barcode` = `catalog`.`barcode` "));
    if($check > 0){
        echo "<script>
                swal('','Cannot Delete Catalog, Being used in Circulation','error');
                setInterval(() => {
                window.history.back();
                }, 2000);
            </script>";
    }
    else {
        if ($stmt = $conn->query("UPDATE `catalog` SET `date_deleted` = '" . date("Y-m-d") . "' WHERE `catalog_id` ='" . $_POST["catalog_id"] . "'")) {
            echo "<script>
                swal('','Successfully Deleted','success');
                setInterval(() => {                 
                window.history.back();
                },2000);
            </script>";
        } else {
            echo "<script>
                swal('','Deletion Failed','error');
                setInterval(() => {
                window.history.back();
                }, 2000);
            </script>";

        }
    }
}