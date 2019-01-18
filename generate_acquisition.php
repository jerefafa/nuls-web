<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 15/01/2019
 * Time: 9:36 PM
 */
header('Content-type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=acquisition_report.csv');
require "connection.php";

$output = fopen("php://output","w");
fputcsv($output, array('Book Title','Author','Edition','Copyright Date', 'Price', 'Date Delivered', 'Date of Shelving', 'Quantity'));
$startDate= date_format(date_create($_GET['start']),"Y-m-d");
$endDate=  date_format(date_create($_GET['end']),"Y-m-d");
$sql="SELECT * FROM `acquisition` WHERE `date_delivered` BETWEEN '$startDate' AND '$endDate' AND `date_deleted` IS NULL ORDER BY `date_delivered` ASC";
$stmt = $conn->query($sql);

while ($row = $stmt->fetch_object()) {
    fputcsv($output, array($row->title,$row->author,$row->edition,$row->copyright_date, $row->price, $row->date_delivered, $row->date_of_shelving,$row->quantity));
}
fclose($output);