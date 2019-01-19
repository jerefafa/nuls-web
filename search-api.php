<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 22/05/2018
 * Time: 4:08 PM
 */
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
if(isset($_POST["keyword"])){
    $keyword = $_POST["keyword"];
    $conn = new mysqli("nuls-mysqldbserver.mysql.database.azure.com","nuls-user@nuls-mysqldbserver","National1","nuls");
    $stmt = $conn->query("SELECT DISTINCT `acquisition`.`acquisition_number`,`acquisition`.`title`,`acquisition`.`author`,`acquisition`.`edition`,`acquisition`.`copyright_date` FROM `acquisition` INNER JOIN `keywords`,`subjects` WHERE (`acquisition`.`title` LIKE '%".$keyword."%' OR `acquisition`.`author` LIKE '%".$keyword."%') OR (`keywords`.`keyword` LIKE '%".$keyword."%' AND `keywords`.`acquisition_number` = `acquisition`.`acquisition_number`) OR (`subjects`.`subject_name` LIKE '%".$keyword."%' AND `acquisition`.`subject_id` = `subjects`.`subject_id`) AND (`acquisition`.`date_deleted` IS NULL)");
    $res = array();
    while ($row = $stmt->fetch_object()){
        if(mysqli_num_rows($conn->query(" SELECT `catalog`.`catalog_id` FROM `catalog` WHERE `acquisition_number` = '".$row->acquisition_number."' AND `is_missing` = '0' AND `is_borrowed` = '0' AND `date_deleted` IS NULL")) > 0) {
            array_push($res, $row);
        }
    }
    $json_response = json_encode($res);
    echo $json_response;
}