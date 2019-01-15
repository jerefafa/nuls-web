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
 * Time: 2:02 PM
 */

require "connection.php";
if(isset($_POST['addMaterial'])){
    $lib_material = $_POST['amaterial'];

    //Check Material
    $check_prog = "SELECT * FROM `material_types` WHERE `material_type` = '$lib_material'";
    $run_query=mysqli_query($conn,$check_prog);

    if(mysqli_num_rows($run_query)>0) {
        echo "<script>swal('','Material already exists.','error');
        setInterval(() => {
            window.history.go(-2);
        }, 2000);
</script>";
    }
    else

        $stmt = $conn->query("INSERT INTO `material_types` (material_type, date_deleted) VALUES ('$lib_material', NULL)");
    if($stmt){
        echo "<script>swal('','Material Added Successfully','success'); 
        setInterval(() => {
            window.history.go(-2);
        }, 2000)
</script>";
    }


}