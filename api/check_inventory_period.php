<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 04/06/2018
 * Time: 9:26 PM
 */
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
$conn = new mysqli("nuls-mysqldbserver.mysql.database.azure.com","nuls-user@nuls-mysqldbserver","National1","nuls");
$user_id=1;
$stmt = $conn->query("SELECT * FROM `periods` WHERE `period`='Inventory'");
$response = array();
while ($row = $stmt->fetch_object()){
    $response = $row;
}
$json_response = json_encode($response);
echo $json_response;