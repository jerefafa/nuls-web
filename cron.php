<?php
require "connection.php";

if(date('l') != 'Sunday') {
    $init = $conn->query("SELECT * FROM `circulation` WHERE `date_returned` IS NULL");
    while ($rw = $init->fetch_object()) {
        $dateToday = strtotime(date('Y-m-d'));
        $fromDate = strtotime($rw->date_borrowed);
        $res = ($dateToday - $fromDate) / 3600 / 24;
        if($res > 3) {
            if(mysqli_num_rows($conn->query("SELECT * FROM `fines` WHERE `circulation_id` = '$rw->circulation_id'"))) {
                echo 1;
                $conn->query("UPDATE `fines` SET `amount` = amount+5 WHERE `circulation_id` = '$rw->circulation_id'");

            } else {
                echo 2;
                $conn->query("INSERT INTO `fines`(`user_id`,`circulation_id`,`amount`,`fine_note`,`is_paid`) VALUES('$rw->borrower_id','$rw->circulation_id','5','overdue','0')");
            }
        }
    }
}