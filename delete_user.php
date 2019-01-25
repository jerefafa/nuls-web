<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: Joyce Balinquit
 * Date: 16/05/2018
 * Time: 8:47 PM
 */
require "connection.php";
if(isset($_POST["librarian_id"])){
    if(mysqli_num_rows($conn->query("SELECT * FROM `circulation` WHERE `lender_id` = '".$_POST["librarian_id"]."' OR `receiver_id` = '".$_POST["librarian_id"]."'")) > 0){
        echo "<script>swal('','Cannot Delete User, Already had a transaction with the library','error');
        setInterval(() => {
           window.history.back();    
        }, 2000);
        </script>";
    }
    else {
        $stmt = $conn->query("UPDATE `librarians` SET date_deleted = CURRENT_DATE WHERE librarian_id = '" . $_POST['librarian_id'] . "'");
        if ($stmt) {
            echo "<script>swal('','Librarian Deleted Successfully','success');
            setInterval(() => {
                window.history.back();
            }, 2000);</script>";
        }
    }

}
else{
    header("location:UserManagementList.php");
}