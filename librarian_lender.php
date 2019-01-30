<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 05/06/2018
 * Time: 8:19 PM
 */
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
$conn =  new mysqli( "localhost", "nulsx10h_je", "Pithecus2013", "nulsx10h_nuls");
$barcode = $_POST["barcode"];
$lender_id = $_POST["lender_id"];
$id_number = $_POST["id_num"];
$stmt = $conn->query("SELECT * FROM `catalog` WHERE `barcode` = '".$barcode."' AND is_missing = '0' AND is_borrowed='0' AND `date_deleted` IS NULL ");
$numrows = mysqli_num_rows($stmt);
if($numrows>0){
    $query = $conn->query("SELECT * FROM `users` WHERE `id_number`='".$id_number."' AND `date_deleted` IS NULL");
    if(mysqli_num_rows($query)>0) {
        while ($row = $query->fetch_object()) {
            $user_id = $row->user_id;
            $stmt1 = $conn->query("UPDATE `catalog` SET `is_borrowed`='1' WHERE `barcode` = '" . $barcode . "'");
            $stmt2 = $conn->query("INSERT INTO `circulation`(`barcode`,`borrower_id`,`date_borrowed`,`lender_id`) VALUES('" . $barcode . "','" . $user_id . "','" . date("Y-m-d") . "','" . $lender_id . "')");
        }
        echo json_encode('2');
    }
    else{
        //user not found
        echo json_encode('1');
    }
    }
else{
    //book unavailable
    echo json_encode(0);
}