<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 04/06/2018
 * Time: 10:15 PM
 */
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
$conn =  new mysqli( "localhost", "nulsx10h_je", "Pithecus2013", "nulsx10h_nuls");
$barcode = $_POST["barcode"];
$userId = $_POST["userId"];
$stmt = $conn->query("UPDATE `catalog` set `is_missing` = '0' WHERE `barcode`='".$barcode."' ");
$stmt2 = $conn->query("SELECT `catalog_id` FROM `catalog` WHERE `barcode` = '".$barcode."'");
while ($row2 = $stmt2->fetch_object()) {
    $conn->query("INSERT INTO `inventory`(`catalog_id`,`date_of_inventory`,`inventory_by`) VALUES('".$row2->catalog_id."', '".date('Y-m-d')."', '".$userId."')");
}
echo json_encode('1');