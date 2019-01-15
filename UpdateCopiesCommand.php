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
 * Time: 4:50 PM
 */
require "connection.php";
if(isset($_POST["SaveCopy"])){
    $acquisition_number = $_POST["acquisition_number"];
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
    $sql = "UPDATE `acquisition` SET `program_id` = '$program',`subject_id`='$subject',`author`='$author',`title`='$title',`edition`='$edition',`copyright_date`='$copyRightDate',`supplier_id`='$supplier1',`price`='$price',`lrc_date_canvassed`='$dateCanvassed',`lrc_date_rs_ps`='$dateRs',`lrc_supplier_id`='$supplier2',`lrc_price`='$lrcPrice',`lrc_need_for_justification`='$lrcNeedForJustification',`date_of_justification_matrix`='$justificationDate',`date_of_signature`='$dateOfSignature',`chief_librarian_date`='$chiefLibrarianDate',`liaison_date`='$liasonDate',`vpaa_date`='$vpaaDate',`controllership_date`='$controllershipDate',`pyt_date`='$pytDate',`purchasing_date`='$purchasingDate',`date_ordered`='$dateOrdered',`date_delivered`='$dateDelivered',`date_delivered_to_lrc`='$dateDeliveredToLrc',`no_of_days`='$numDays',`date_processed`='$dateProcessed',`date_of_shelving`='$dateShelving',`total_no_of_days`='$totalNumDays',`remarks`='$remarks',`quantity`='$quantity' WHERE `acquisition_number` = '$acquisition_number'";
    if(!mysqli_query($conn,$sql)){
        ?>
        <script>
            swal('','Update Failed','error');
            setInterval(() => {
                location.href="ListOfCopies.php";
            }, 2000);
        </script>
        <?php
    }else{
        ?>
        <script>
            swal('','Update Successful','success');
            setInterval(()=> {
                location.href="ListOfCopies.php";
            }, 2000);
        </script>
        <?php
    }
}else{
    header("Location:ListOfCopies.php");
}
