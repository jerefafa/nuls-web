<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>
</html>
<?php
require "connection.php";
if(isset($_POST["save"])) {
    $id = $_POST["id"];
    $amount = $_POST["amount"];
    $note = $_POST["note"];
    if($conn->query("UPDATE `fines` SET `fine_note` = '$note', `amount` = '$amount' WHERE `circulation_id` = '$id' ")){
        echo "<script>
        swal('','Fine Updated Successfully', 'success');
        setInterval(() => {
            window.history.back();
        }, 2000);
        </script>";
    }
    else {
        echo "<script>
        swal('','Cannot Update Fine', 'error');
        setInterval(() => {
            window.history.back();
        }, 2000);
        </script>";
        echo $conn->error;
    }
}
if(isset($_POST["paid"])) {
    $id = $_POST["id"];
    if($conn->query("UPDATE `fines` SET `is_paid` = '1' WHERE `circulation_id` = '$id' ")){
        echo "<script>
        swal('','Fine Cleared', 'success');
        setInterval(() => {
            window.history.back();
        }, 2000);
        </script>";
    }
    else {
        echo "<script>
        swal('','Cannot Clear Fine', 'error');
        setInterval(() => {
            window.history.back();
        }, 2000);
        </script>";
        echo $conn->error;
    }
}