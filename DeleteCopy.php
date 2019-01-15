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
 * Date: 17/07/2018
 * Time: 1:57 PM
 */
require "connection.php";
if(isset($_POST["acquisition_number"])){
    $check = mysqli_num_rows($conn->query("SELECT * FROM `catalog` WHERE `acquisition_number` = '".$_POST["acquisition_number"]."' AND `date_deleted` IS NULL"));
    if($check > 0){
        ?>
        <script>
            swal("","Cannot Delete Acquisition, One or more copy was catalogued", "error");
            setInterval(() => {
                window.history.back();
            }, 2000);
        </script>
        <?php
    }else {

        if ($conn->query("UPDATE `acquisition` SET `date_deleted` = '" . date("Y-m-d") . "' WHERE `acquisition_number` = '" . $_POST["acquisition_number"] . "' ")) {
            ?>
            <script>
                swal("","Successfully Deleted", "success");
                setInterval(() => {
                    window.history.back();
                }, 2000);
            </script>
            <?php
        } else {
            ?>
            <script>
                swal("","Deletion Failed", "error");
                setInterval(() => {
                    window.history.back();
                }, 2000);
            </script>
            <?php
        }
    }
}else{
    header("location:ListOfCopies.php");
}