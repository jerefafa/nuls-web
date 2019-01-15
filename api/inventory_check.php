<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 04/06/2018
 * Time: 10:15 PM
 */
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
$conn = new mysqli("nuls-mysqldbserver.mysql.database.azure.com","nuls-user@nuls-mysqldbserver","National1","nuls");
$barcode = $_POST["barcode"];
$stmt = $conn->query("UPDATE `catalog` set `is_missing` = '0' WHERE `barcode`='".$barcode."' ");
echo json_encode('1');