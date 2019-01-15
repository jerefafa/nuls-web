<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 12/07/2018
 * Time: 1:52 AM
 */
require "connection.php";

    if(!isset($_POST["program_id"])){
        header("Location:ListOfCopies.php");
    }
    elseif(isset($_POST["subject_id"])) {
        $program_id = $_POST["program_id"];
        $stmt = $conn->query("SELECT * FROM `subjects` WHERE `program_id`='" . $program_id . "' AND `date_deleted` IS NULL");
        $output = '<option disabled selected value="">Select Subject</option>';
        while ($row = $stmt->fetch_object()) {
            if($row->subject_id==$_POST["subject_id"]){
                $output .= "<option value='" . $row->subject_id . "' selected>" . $row->subject_name . "</option>";
            }
            else {
                $output .= "<option value='" . $row->subject_id . "'>" . $row->subject_name . "</option>";
            }
        }

        echo $output;
    }
    else{
        $program_id = $_POST["program_id"];
        $stmt = $conn->query("SELECT * FROM `subjects` WHERE `program_id`='" . $program_id . "' AND `date_deleted` IS NULL");
        $output = '<option disabled selected value="">Select Subject</option>';
        while ($row = $stmt->fetch_object()) {
            $output .= "<option value='" . $row->subject_id . "'>" . $row->subject_name . "</option>";
        }
        echo $output;

    }