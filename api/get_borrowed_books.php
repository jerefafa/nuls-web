<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 27/05/2018
 * Time: 10:47 PM
 */
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
$conn = new mysqli("nuls-mysqldbserver.mysql.database.azure.com","nuls-user@nuls-mysqldbserver","National1","nuls");
$user_id=$_POST["user_id"];
$stmt = $conn->query("SELECT `acquisition`.`title`,`catalog`.`barcode`,`circulation`.`date_borrowed` FROM `acquisition` INNER JOIN `catalog` INNER JOIN `circulation` WHERE `circulation`.`borrower_id` ='".$user_id."' AND `circulation`.`barcode` = `catalog`.`barcode` AND `circulation`.`date_returned` IS NULL AND `acquisition`.`acquisition_number` = `catalog`.`acquisition_number`");
$response = array();
while ($row = $stmt->fetch_object()){
    array_push($response,$row);
}
$json_response = json_encode($response);
echo $json_response;