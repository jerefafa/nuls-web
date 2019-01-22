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
 * Time: 3:48 PM
 */
require "connection.php";
error_reporting(0);
if(isset($_POST['nSupplier'])){
    $supplier = $_POST['sname'];
    $num = $_POST['number'];
    $name = $_POST['person'];

    //Check Supplier
    $check_prog = "SELECT * FROM `suppliers` WHERE `supplier_name` = '$supplier'";
    $run_query=mysqli_query($conn,$check_prog);

    if(mysqli_num_rows($run_query)>0) {
        echo "<script>swal('','Supplier already exists.','error');
        setInterval(() => {
            window.history.go(-2);
        }, 2000);
</script>";
    }
    else

        $stmt = $conn->query("INSERT INTO `suppliers` (supplier_name, contact_number, contact_person, date_deleted) VALUES ('$supplier', '$num', '$name', NULL)");
    if($stmt){
        echo "<script>swal('','Supplier Added Successfully','success');
            setInterval(() => {
                 window.history.go(-2);
            }, 2000);
</script>";
    }
}
