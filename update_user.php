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
 * User: Jeremiah
 * Date: 07/05/2018
 * Time: 9:31 PM
 */
require "connection.php";


if(isset($_POST["librarian_id"])){

    if(isset($_POST["ePass"])){
    $password = $_POST['password'];
    //password hashing
    $hash = password_hash($password, PASSWORD_DEFAULT);
        $date = date_create($_POST['bdate']);
        $stmt = $conn->query("UPDATE `librarians` SET fname='".$_POST['fname']."', mname = '".$_POST['mname']."', lname = '".$_POST['lname']."', gender = '".$_POST['gender']."', birthdate = '".date_format($date,"Y-m-d")."', email = '".$_POST['email']."', password = '".$hash."',`position`='".$_POST['position']."', date_deleted = null WHERE librarian_id = '".$_POST['librarian_id']."'");
        $query = $conn->query("DELETE FROM `access_levels` WHERE librarian_id = '".$_POST["librarian_id"]."'");
        if(!empty($_POST['access'])){
            $accesses = $_POST['access'];
            foreach ($accesses as $acc){
                $stmt2 = $conn->query("INSERT INTO `access_levels`(librarian_id,access_level) VALUES('".$_POST['librarian_id']."','".$acc."')");
            }
        }
        if($stmt){
            echo "<script>swal('','Librarian Updated Successfully','success');
                setInterval(()=> {
                    location.href='UserManagementList.php';
                },2000);</script>";
        }

    }
    else{
        $date1 = date_create($_POST['bdate']);
        $stmt1 = $conn->query("UPDATE `librarians` SET fname='".$_POST['fname']."', mname = '".$_POST['mname']."', lname = '".$_POST['lname']."', gender = '".$_POST['gender']."', birthdate = '".date_format($date1,"Y-m-d")."', email = '".$_POST['email']."',`position`='".$_POST['position']."', date_deleted = null WHERE librarian_id = '".$_POST['librarian_id']."'");
        $query1 = $conn->query("DELETE FROM `access_levels` WHERE librarian_id = '".$_POST["librarian_id"]."'");
        if(!empty($_POST['access'])){
            $accesses = $_POST['access'];
            foreach ($accesses as $acc){
                $stmt3 = $conn->query("INSERT INTO `access_levels`(librarian_id,access_level) VALUES('".$_POST['librarian_id']."','".$acc."')");
            }
        }
        if($stmt1){
            echo "<script>swal('','Librarian Updated Successfully','success');
            setInterval(() => {
                location.href='UserManagementList.php';
            }, 2000);</script>";
        }

    }

}
?>
<?php
function checkAge($bday){
    ///age checkerS
    if(!empty($bday)){
        $birth = new DateTime($bday);
        $today = new DateTime('today');
        $age = $birth->diff($today)->y;
        //return $age;
        if($age < 15)
            //echo "<script>alert('Age Restriction. You are only' + $age)</script>";
            return true;
    }


}
?>
