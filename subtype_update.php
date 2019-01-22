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
 * Time: 2:42 PM
 */
require "connection.php";
if(isset($_POST["subtype_id"])){
    if(isset($_POST["udSub"])){
        $stmt = $conn->query("UPDATE `subtypes` SET subtype='".$_POST['asubtype']."' WHERE subtype_id = '".$_POST['subtype_id']."'");
        if($stmt){
            echo "<script>swal('','Subtype Updated Successfully','success');
            setInterval(() => {
                window.history.go(-2);
            }, 2000);
</script>";
        }

        else {
            echo "<script>swal('','Subtype Update Error','error');
            setInterval(() => {
                window.history.go(-2);
            }, 2000);
</script>";
        }
    }
}