<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 27/05/2018
 * Time: 8:24 PM
 */
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
$barcode = $_POST["barcode"];
$user_id = $_POST["user_id"];
$conn = new mysqli("nuls-mysqldbserver.mysql.database.azure.com","nuls-user@nuls-mysqldbserver","National1","nuls");
$stmt = $conn->query("SELECT * FROM `catalog` WHERE barcode = '".$barcode."'  AND date_deleted IS NULL ");
while ($row = $stmt->fetch_object()){
    if($row->is_borrowed==1 || $row->is_missing==1){
        $response =0;
        $json_response = json_encode($response);
        echo $json_response;
    }
    else{
        $stmt2 = $conn->query("UPDATE `catalog` SET is_borrowed = '1' WHERE barcode = '".$barcode."'");
        $stmt3 = $conn->query("INSERT INTO `circulation`(`barcode`,`borrower_id`,`date_borrowed`) VALUES('".$barcode."','".$user_id."','".date("Y-m-d")."')");
        $response = 1;
        $json_response = json_encode($response);
        echo $json_response;
    }
}