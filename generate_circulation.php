<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 15/01/2019
 * Time: 9:36 PM
 */
header('Content-type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=circulation_report.csv');
require "connection.php";

$output = fopen("php://output","w");
$startDate= date_format(date_create($_GET['start']),"Y-m-d");
$endDate=  date_format(date_create($_GET['end']),"Y-m-d");
if(isset($_GET["start"])){
    $cmbValue = $_GET["cmbText"];
    $startDate= date_format(date_create($_GET['start']),"Y-m-d");
    $endDate=  date_format(date_create($_GET['end']),"Y-m-d");

    if($cmbValue == 0){
        fputcsv($output, array('Book Title','Barcode','Check Out Date','ID #', 'Return Date'));
        $sql="SELECT `acquisition`.`acquisition_number`,`acquisition`.`title`,`acquisition`.`author`,`catalog`.`barcode`,`users`.`user_id`,`users`.`user_fname`,`users`.`user_lname`,`users`.`user_mname`,`users`.`id_number`,`courses`.`course_id`,`courses`.`course`,`circulation`.`date_borrowed`,`circulation`.`date_returned` FROM `acquisition` INNER JOIN `catalog` INNER JOIN `circulation` INNER JOIN `users` INNER JOIN `courses` WHERE `circulation`.`date_returned` BETWEEN '$startDate' AND '$endDate' AND `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` AND `catalog`.`barcode` = `circulation`.`barcode` AND `users`.`user_id` = `circulation`.`borrower_id` AND `courses`.`course_id` = `users`.`course_id`";
    }else if ($cmbValue == 1){
        fputcsv($output, array('Book Title','Barcode','Check Out Date','ID #'));
        $sql="SELECT `acquisition`.`acquisition_number`,`acquisition`.`title`,`acquisition`.`author`,`catalog`.`barcode`,`users`.`user_id`,`users`.`user_fname`,`users`.`user_lname`,`users`.`user_mname`,`users`.`id_number`,`courses`.`course_id`,`courses`.`course`,`circulation`.`date_borrowed`,`circulation`.`date_returned` FROM `acquisition` INNER JOIN `catalog` INNER JOIN `circulation` INNER JOIN `users` INNER JOIN `courses` WHERE `circulation`.`date_borrowed` BETWEEN '$startDate' AND '$endDate' AND `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` AND `catalog`.`barcode` = `circulation`.`barcode` AND `users`.`user_id` = `circulation`.`borrower_id` AND `courses`.`course_id` = `users`.`course_id`";
    }
}
else{
    $sql="SELECT `acquisition`.`acquisition_number`,`acquisition`.`title`,`acquisition`.`author`,`catalog`.`barcode`,`users`.`user_id`,`users`.`user_fname`,`users`.`user_lname`,`users`.`user_mname`,`users`.`id_number`,`courses`.`course_id`,`courses`.`course`,`circulation`.`date_borrowed`,`circulation`.`date_returned` FROM `acquisition` INNER JOIN `catalog` INNER JOIN `circulation` INNER JOIN `users` INNER JOIN `courses` WHERE `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` AND `catalog`.`barcode` = `circulation`.`barcode` AND `users`.`user_id` = `circulation`.`borrower_id` AND `courses`.`course_id` = `users`.`course_id`";
}

$stmt = $conn->query($sql);
while ($row = $stmt->fetch_object()) {
    if($cmbValue == 0) {
        fputcsv($output, array($row->title, $row->barcode, $row->date_borrowed, $row->id_number, $row->date_returned));
    } elseif ($cmbValue == 1) {

        fputcsv($output, array($row->title, $row->barcode, $row->date_borrowed, $row->id_number));
    }
}
fclose($output);