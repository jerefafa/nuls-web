<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 12/06/2018
 * Time: 3:16 PM
 */
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
$conn =  new mysqli( "localhost", "nulsx10h_je", "Pithecus2013", "nulsx10h_nuls");
$topic = $_POST["topic"];
$sql="";
$barcode = $_POST["barcode"];
$stmt = $conn->query("SELECT * FROM `acquisition` INNER JOIN `catalog` WHERE `catalog`.`acquisition_number` = `acquisition`.`acquisition_number` AND `catalog`.`barcode` = '".$barcode."'");
while ($row = $stmt->fetch_object()) {
    $sql = "INSERT INTO `keywords`(acquisition_number,`keyword`) VALUES('".$row->acquisition_number."','" . $topic . "')";
if($conn->query($sql)){
    echo json_encode(1);
}else{
    echo json_encode(0);
}

}
