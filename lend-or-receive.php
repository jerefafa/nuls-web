<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>
</html>
<?php
session_start();
require "connection.php";
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 19/01/2019
 * Time: 2:58 PM
 */
if(isset($_POST['lendButton'])){
    $id = $_POST["idnum"];
    $barcode = $_POST["barcode"];
    $flag = false;
    if(mysqli_num_rows($conn->query("SELECT * FROM `catalog` WHERE `barcode` = '$barcode' AND `date_deleted` IS NULL"))) {
        $flag = true;
    }
    else {
        echo "<script>
            swal('','Barcode Doesn\'t Exist','error');
            setInterval(() => {
                location.href = 'Lend.php';
            }, 2000)
        </script>";
    }

    $sql = "SELECT `user_id` FROM `users` WHERE `id_number` = '$id'";
    $stmt = $conn->query($sql);
    if(mysqli_num_rows($stmt) > 0 && $flag) {
        while ($row = $stmt->fetch_object()) {
            if ($conn->query("INSERT INTO `circulation`(`barcode`,`borrower_id`,`date_borrowed`,`lender_id`) VALUES('$barcode','$row->user_id','".date('Y-m-d')."','".$_SESSION["user_id"]."') ")) {
                $conn->query("UPDATE `catalog` SET `is_borrowed`='1' WHERE `barcode` = '" . $barcode . "'");
                echo "<script>
                swal('','Book successfully lent','success');
                setInterval(() => {
                    location.href = 'Lend.php';
                },2000);
</script>";
            }
        }
    } else {
        echo "<script>swal('','Could not find id number or barcode','error');
        setInterval(() => {
            location.href='Lend.php';
        }, 2000);
</script>";
    }
} elseif (isset($_POST["receiveButton"])) {
    $barcode = $_POST["barcode"];
    if(!mysqli_num_rows($conn->query("SELECT * FROM `catalog` WHERE `barcode` = '$barcode' AND `date_deleted` IS NULL"))) {
        echo "<script>
        swal('','Book does not belong in the library', 'error');
        setTimeout(() => {
            location.href = 'Receive.php';
        },2000);
</script>";
    }
    else {
        if(mysqli_num_rows($conn->query("SELECT * FROM `circulation` WHERE `barcode` = '$barcode' AND `date_returned` IS NULL")) < 1) {
            echo "<script>
            swal('','Book is not listed as borrowed', 'error');
            setTimeout(() => {
                location.href = 'Receive.php';
            },2000);
    </script>";
        }
        else {
            $stmt = $conn->query("SELECT * FROM `circulation` INNER JOIN `fines` WHERE `fines`.`circulation_id` = `circulation`.`circulation_id` AND `circulation`.`barcode` = '" . $barcode . "' AND `fines`.`is_paid` = '0'");
        if (!mysqli_num_rows($stmt)) {
            if ($conn->query("UPDATE `circulation` SET `date_returned` = '" . date('Y-m-d') . "', `receiver_id` = '" . $_SESSION["user_id"] . "' WHERE `barcode` = '$barcode'")) {
                $conn->query("UPDATE `catalog` SET `is_borrowed`='0' WHERE `barcode` = '".$barcode."'");
                echo "<script>swal('','Book Received Successfully','success')
        setInterval(() => {
            location.href = 'Receive.php';
        },2000);
</script>";
            } else {
                echo "<script>swal('','Book Receiving Failed','error')
        setInterval(() => {
            location.href = 'Receive.php';
        },2000);
</script>";
            }
        } else {
            echo "<script>swal('','Book still have fines','error')
        setInterval(() => {
            location.href = 'Receive.php;
        },2000);
</script>";
        }
    
        }
    }
}