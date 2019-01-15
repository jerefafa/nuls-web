<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 15/01/2019
 * Time: 9:36 PM
 */
header('Content-type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=inventory_report.csv');
require "connection.php";

$output = fopen("php://output","w");
fputcsv($output, array('Book Title','Author','Barcode','Remarks', 'Other Details'));


if(isset($_GET["start"])){
    $startDate= date_format(date_create($_GET['start']),"Y-m-d");
    $endDate=  date_format(date_create($_GET['end']),"Y-m-d");
    $sql="SELECT `acquisition`.`acquisition_number`,`catalog`.`catalog_id`,`acquisition`.`title`,`acquisition`.`author`,`catalog`.`is_borrowed`,`catalog`.`remarks`,`catalog`.`is_missing`,`catalog`.`other_details`,`catalog`.`barcode`,`inventory`.`date_of_inventory` FROM `acquisition` INNER JOIN `catalog` INNER JOIN `inventory` WHERE `inventory`.`date_of_inventory` BETWEEN '$startDate' AND '$endDate' AND `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` AND `catalog`.`catalog_id` = `inventory`.`catalog_id` ORDER BY `inventory`.`date_of_inventory` ASC ";
}else{
    $sql="SELECT `acquisition`.`acquisition_number`,`catalog`.`catalog_id`,`acquisition`.`title`,`acquisition`.`author`,`catalog`.`is_borrowed`,`catalog`.`remarks`,`catalog`.`is_missing`,`catalog`.`other_details`,`catalog`.`barcode`,`inventory`.`date_of_inventory` FROM `acquisition` INNER JOIN `catalog` INNER JOIN `inventory` WHERE `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` AND `catalog`.`catalog_id` = `inventory`.`catalog_id` ORDER BY `inventory`.`date_of_inventory` ASC";
}

if($stmt = $conn->query($sql)){

    while ($row=$stmt->fetch_object()){
        fputcsv($output, array($row->title,$row->author,$row->barcode,$row->remarks, $row->other_details));
    }
}
fclose($output);