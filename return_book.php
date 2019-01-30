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
$receiver_id = $_POST["receiver_id"];
$stmt = $conn->query("UPDATE `circulation` SET `date_returned` = '".date("Y-m-d")."',`receiver_id`='".$receiver_id."' WHERE `barcode`='".$barcode."' AND `date_returned` IS NULL AND `receiver_id` IS NULL");
$stmt = $conn->query("UPDATE `catalog` SET `is_borrowed`='0' WHERE `barcode` = '".$barcode."'");
echo json_encode('1');
