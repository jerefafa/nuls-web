<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 22/05/2018
 * Time: 2:05 PM
 */
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
if(isset($_POST["barcode"])) {
    $conn = new mysqli("nuls-mysqldbserver.mysql.database.azure.com","nuls-user@nuls-mysqldbserver","National1","nuls");
    $barcode = $_POST["barcode"];
    $stmt = $conn->query("SELECT `acquisition`.`acquisition_number`,`acquisition`.`title`,`acquisition`.`author`,`acquisition`.`edition`,`acquisition`.`copyright_date` FROM `acquisition` INNER JOIN `catalog` WHERE `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` AND `catalog`.`barcode` = '" . $barcode . "' AND `catalog`.`date_deleted` IS NULL");
    $res = array();
    while ($row = $stmt->fetch_object()) {
        array_push($res, $row);
    }
    $json_response = json_encode($res);
    echo $json_response;
}