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
 * Time: 2:34 PM
 */
require "connection.php";
if(isset($_POST['addSubtype'])){
    $lib_subtype = $_POST['asubtype'];

    //Check Subtype
    $check_prog = "SELECT * FROM `subtypes` WHERE `subtype` = '$lib_subtype'";
    $run_query=mysqli_query($conn,$check_prog);

    if(mysqli_num_rows($run_query)>0) {
        echo "<script>swal('','Subtype already exists.','error');
        setInterval(() => {
            window.history.go(-2);
        }, 2000);
</script>";
    }
    else

        $stmt = $conn->query("INSERT INTO `subtypes` (subtype, date_deleted) VALUES ('$lib_subtype', NULL)");
    if($stmt){
        echo "<script>swal('','Subtype Added Successfully','success');
        setInterval(() => {
             window.history.go(-2);
        }, 2000);
        
</script>";
    }
}