<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 05/06/2018
 * Time: 8:19 PM
 */
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
$conn = new mysqli("nuls-mysqldbserver.mysql.database.azure.com","nuls-user@nuls-mysqldbserver","National1","nuls");
$barcode = $_POST["barcode"];
$remark = $_POST["remark"];
$receiver_id = $_POST["receiver_id"];
if($remark=="null"){
$stmt = $conn->query("UPDATE `catalog` SET `remarks`= NULL WHERE `barcode` = '".$barcode."'");
}
else{
$stmt = $conn->query("UPDATE `catalog` SET `remarks`='".$remark."' WHERE `barcode` = '".$barcode."'");
}
echo json_encode('1');
