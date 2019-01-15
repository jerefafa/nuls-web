<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 15/01/2019
 * Time: 9:36 PM
 */
header('Content-type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=catalog_report.csv');
require "connection.php";

$output = fopen("php://output","w");
fputcsv($output, array('Book Title','Call #','Publisher','Publish Date', 'Barcode'));
$startDate= date_format(date_create($_GET['start']),"Y-m-d");
$endDate=  date_format(date_create($_GET['end']),"Y-m-d");
$sql="SELECT `acquisition`.`acquisition_number`,`acquisition`.`title`,`catalog`.`call_number`,`catalog`.`publisher`,`catalog`.`publication_date`, `catalog`.`barcode` FROM `acquisition` INNER JOIN `catalog` WHERE `catalog`.`publication_date` BETWEEN '$startDate' AND '$endDate' AND `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` AND `catalog`.`date_deleted` IS NULL ORDER BY `catalog`.`publication_date` ASC ";
$stmt = $conn->query($sql);

while ($row = $stmt->fetch_object()) {
    fputcsv($output, array($row->title,"#".$row->call_number,$row->publisher,$row->publication_date, $row->barcode));
}
fclose($output);