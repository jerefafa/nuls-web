<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 09/07/2018
 * Time: 1:54 PM
 */
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
$conn =  new mysqli( "localhost", "nulsx10h_je", "Pithecus2013", "nulsx10h_nuls");
$user_id = $_POST['user_id'];
$sql = $conn->query("SELECT `circulation`.`date_borrowed`, `acquisition`.`title` FROM `circulation` INNER JOIN `acquisition` INNER JOIN `catalog` WHERE `circulation`.`borrower_id`='".$user_id."' AND `circulation`.`barcode` = `catalog`.`barcode` AND `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` AND `circulation`.`date_returned` IS NULL");
$arr = array();
while ($row = $sql->fetch_object()){
    array_push($arr,$row);
}
echo json_encode($arr);