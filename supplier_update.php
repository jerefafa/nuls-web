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
 * Time: 5:50 PM
 */
require "connection.php";
if(isset($_POST["supplier_id"])){
    if(isset($_POST["udSupplier"])){
        $stmt = $conn->query("UPDATE `suppliers` SET supplier_name='".$_POST['sname']."', contact_number='".$_POST['number']."', contact_person='".$_POST['person']."'  WHERE supplier_id = '".$_POST['supplier_id']."'");
        if($stmt){
            echo "<script>swal('','Supplier Updated Successfully','success')
            setInterval(()=> {
                window.history.go(-2);
            }, 2000);</script>";
        }

        else {
            echo "<script>swal('','Supplier Update Error','error');
            setInterval(() => {
                window.history.go(-2);
            }, 2000)
            </script>";
        }
    }
}