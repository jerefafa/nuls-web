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
 * Date: 15/05/2018
 * Time: 12:34 PM
 */

require "connection.php";
if(isset($_POST['registerAdmin'])){
    $lib_lname = $_POST['lname'];
    $lib_mname = $_POST['mname'];
    $lib_fname = $_POST['fname'];
    $lib_gender = $_POST['gender'];
    $lib_bday = date_create($_POST['birthdate']);
    $lib_email = $_POST['email'];
    $lib_password = $_POST['password'];
    $lib_fpassword = $_POST['fpassword'];
    $lib_position = $_POST['position'];
    $lib_access = $_POST['access'];
    $date = date_format($lib_bday,"Y-m-d");


//Check Librarians
   $check_lib = "SELECT * FROM `librarians` WHERE `email` = '$lib_email'";
   $run_query=mysqli_query($conn,$check_lib);

   if(mysqli_num_rows($run_query)>0) {
       echo "<script>swal('','Email Already Taken.','error');
        setInterval(() => {
            location.href='UserManagement.php';
        }, 2000);</script>";
   }

 //Check Password and Age
    if(checkPassword($lib_password, $lib_fpassword) == true && checkAge($date) == true){
        echo "<script>swal('','Password Mismatch and/or Age Restriction','error');
        setInterval(() => {
location.href='UserManagement.php';
        }, 2000);</script>";
    }
    elseif (checkPassword($lib_password, $lib_fpassword) == false && checkAge($date) == true){
        echo "<script>swal('','Age Restriction','error');
        setInterval(() => {
            location.href='UserManagement.php';
        }, 2000);</script>";
    }
    elseif (checkPassword($lib_password, $lib_fpassword) == true && checkAge($date) == false){
        echo "<script>swal('','Password Mismatch','error');
        setInterval(() => {
location.href='UserManagement.php';
        }, 2000);</script>";
    }
//Insert Librarian
    else

//password hashing
        $hash = password_hash($lib_fpassword, PASSWORD_DEFAULT);

    $stmt2  = $conn->query("INSERT INTO `librarians` (lname, mname, fname, gender, birthdate, email, password, `position`, date_deleted) VALUES ('$lib_lname', '$lib_mname', '$lib_fname', '$lib_gender', '$date' , '$lib_email', '$hash', '$lib_position', NULL)");
    $id = $conn->insert_id;


    if(!empty($_POST['access'])){
        $accesses = $_POST['access'];
        foreach ($accesses as $acc){
            $stmt3 = $conn->query("INSERT INTO `access_levels`(librarian_id,access_level) VALUES('$id','".$acc."')");
        }
    }

    /**if(!empty($_POST['access'])){
    $accesses = $_POST['access'];
    foreach ($accesses as $acc){
    $stmt3 = $conn->query("INSERT INTO `access_levels`(librarian_id,access_level) VALUES('".$last_id."','".$acc."')");
    }
    }**/
    if($stmt2){
        echo "<script>swal('','Librarian Registered Successfully','success');
        setInterval(() => {
location.href='UserManagementList.php';
        }, 2000);</script>";
    }
}

?>
<?php
function checkPassword($pwd1, $pwd2){
    //password checker
    //var msg = (pwd1==pwd2)?"":"Password Mismatch";
    if($pwd1!=$pwd2)
        //echo "<script>alert('Password Mismatch')</script>";
    return true;
}

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
