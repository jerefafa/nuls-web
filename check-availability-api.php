<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 22/05/2018
 * Time: 5:13 PM
 */
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
$acnum = $_POST["book_id"];
$conn = new mysqli("nuls-mysqldbserver.mysql.database.azure.com","nuls-user@nuls-mysqldbserver","National1","nuls");
$stmt = $conn->query("SELECT * FROM `catalog` WHERE acquisition_number = '".$acnum."' AND (is_missing = '0' AND is_borrowed = '0') AND date_deleted IS NULL");
$numrows = mysqli_num_rows($stmt);
if($numrows>0){
    $jsondata = json_encode('1');
    echo $jsondata;
}
else{
    $jsondata = json_encode('0');
    echo $jsondata;
}