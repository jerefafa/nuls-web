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
 * Date: 14/07/2018
 * Time: 8:19 PM
 */
require "connection.php";
error_reporting(0);
if(isset($_POST["AddCopy"])){
    $program = $_POST["program"];
    $subject = $_POST["subject"];
    $author = $_POST["author"];
    $title = $_POST["title"];
    $edition = $_POST["edition"];
    $copyRightDate = date_format(date_create($_POST["copyRightDate"]),"Y-m-d");
    $supplier1 = $_POST["supplier1"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $dateCanvassed = date_format(date_create($_POST["dateCanvassed"]),"Y-m-d");
    $dateRs = date_format(date_create($_POST["dateRs"]),"Y-m-d");
    $supplier2 = $_POST["supplier2"];
    $lrcPrice = $_POST["lrcPrice"];
    $lrcNeedForJustification = $_POST["lrcNeedForJustification"];
    $justificationDate = date_format(date_create($_POST["justificationDate"]),"Y-m-d");
    $dateOfSignature = date_format(date_create($_POST["dateOfSignature"]),"Y-m-d");
    $chiefLibrarianDate = date_format(date_create($_POST["chiefLibrarianDate"]),"Y-m-d");
    $liasonDate = date_format(date_create($_POST["liasonDate"]),"Y-m-d");
    $vpaaDate = date_format(date_create($_POST["vpaaDate"]),"Y-m-d");
    $controllershipDate = date_format(date_create($_POST["controllershipDate"]),"Y-m-d");
    $pytDate = date_format(date_create($_POST["pytDate"]),"Y-m-d");
    $purchasingDate = date_format(date_create($_POST["purchasingDate"]),"Y-m-d");
    $dateOrdered = date_format(date_create($_POST["dateOrdered"]),"Y-m-d");
    $dateDelivered = date_format(date_create($_POST["dateDelivered"]),"Y-m-d");
    $dateDeliveredToLrc = date_format(date_create($_POST["dateDeliveredToLrc"]),"Y-m-d");
    $numDays = $_POST["numDays"];
    $dateProcessed = date_format(date_create($_POST["dateProcessed"]),"Y-m-d");
    $dateShelving = date_format(date_create($_POST["dateShelving"]),"Y-m-d");
    $totalNumDays = $_POST["totalNumDays"];
    $remarks = $_POST["remarks"];

    $sql = "INSERT INTO `acquisition`(`program_id`, `subject_id`, `author`, `title`, `edition`, `copyright_date`, `supplier_id`, `price`, `lrc_date_canvassed`, `lrc_date_rs_ps`, `lrc_supplier_id`, `lrc_price`, `lrc_need_for_justification`, `date_of_justification_matrix`, `date_of_signature`, `chief_librarian_date`, `liaison_date`, `vpaa_date`, `controllership_date`, `pyt_date`, `purchasing_date`, `date_ordered`, `date_delivered`, `date_delivered_to_lrc`, `no_of_days`, `date_processed`, `date_of_shelving`, `total_no_of_days`, `remarks`, `quantity`) VALUES('$program','$subject','$author','$title','$edition','$copyRightDate','$supplier1','$price','$dateCanvassed','$dateRs','$supplier2','$lrcPrice','$lrcNeedForJustification','$justificationDate','$dateOfSignature','$chiefLibrarianDate','$liasonDate','$vpaaDate','$controllershipDate','$pytDate','$purchasingDate','$dateOrdered','$dateDelivered','$dateDeliveredToLrc','$numDays','$dateProcessed','$dateShelving','$totalNumDays','$remarks','$quantity')";
    if(!mysqli_query($conn,$sql)){
        ?>
        <script>
            swal('','Adding Failed','error');
            setInterval(() => {
                location.href="AddCopies.php";
            },2000);
        </script>
        <?php
    }else{
        ?>
        <script>
            swal('','Adding Successful','success');
            setInterval(()=> {
                location.href="AddCopies.php";
            }, 2000)
        </script>
        <?php
    }
}else{
    header("location:AddCopies.php");
}