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
 * Time: 2:15 PM
 */
require "connection.php";
if(isset($_POST["material_type_id"])){
    if(isset($_POST["udMaterial"])){
        $stmt = $conn->query("UPDATE `material_types` SET material_type='".$_POST['amaterial']."' WHERE material_type_id = '".$_POST['material_type_id']."'");
        if($stmt){
            echo "<script>swal('','Material Type Updated Successfully','success');
            setInterval(() => {
                window.history.go(-2);
            }, 2000);
</script>";
        }

        else {
            echo "<script>swal('','Material Type Update Error','error');
            setInterval(() => {
                window.history.go(-2);
            }, 2000);
    </script>";
        }
    }
}