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
 * Date: 31/05/2018
 * Time: 2:30 PM
 */
require "connection.php";
if(isset($_POST['addUser'])){
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $idnum = $_POST['idnum'];
    $uname = $_POST['uname'];
    $password = $_POST['password'];
    $fpassword = $_POST['fpassword'];
    $utype = $_POST['utype'];
    $program = $_POST['program'];

    //Check User
    $check_lib = "SELECT * FROM `users` WHERE `username` = '$uname'";
    $run_query=mysqli_query($conn,$check_lib);

    if(mysqli_num_rows($run_query)>0) {
        echo "<script>swal('','Username Already Taken.','error');
        setInterval(() => {
            location.href='Add_User.php'
        }, 2000);
</script>";
    }

    //Check Password
    if (checkPassword($password, $fpassword) == true){
        echo "<script>swal('','Password Mismatch','error');
            setInterval(() => {
                window.history.back();
            }, 2000);   
        </script>";
    }
    //Insert User
    else {
        //password hashing
        $hash = password_hash($fpassword, PASSWORD_DEFAULT);
        $stmt = $conn->query("INSERT INTO `users` (user_fname, user_lname, user_mname, id_number, username, password, user_type, course_id, date_deleted) VALUES ('$fname', '$lname', '$mname', '$idnum',  '$uname', '$hash', '$utype', '$program', NULL)");
        if ($stmt) {
            echo "<script>swal('','User Added Successfully','success');
            setInterval(() => {
                window.history.go(-2);
            }, 2000);
</script>";
        } else {
            echo "<script>swal('','Error Adding the User','error');
            setInterval(() => {
                window.history.go(-2);
            }, 2000);
        </script>";
        }
    }

}?>

<?php
function checkPassword($pwd1, $pwd2){
    if($pwd1!=$pwd2)
        return true;
}
?>