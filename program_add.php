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
 * Time: 11:06 PM
 */
require "connection.php";
if(isset($_POST['addProg'])){
    $lib_program = $_POST['aprogram'];

    //Check Program
    $check_prog = "SELECT * FROM `programs` WHERE `program` = '$lib_program'";
    $run_query=mysqli_query($conn,$check_prog);

    if(mysqli_num_rows($run_query)>0) {
        echo "<script>swal('','College already exists.','error');
        setInterval(() => {
            window.history.go(-2);
        },2000);
</script>";
    }
    else

        $stmt = $conn->query("INSERT INTO `programs` (program, date_deleted) VALUES ('$lib_program', NULL)");
        if($stmt){
            echo "<script>swal('','College Added Successfully','success');
    setInterval(() => {
         window.history.go(-2);
    }, 2000);
</script>";
        }
}
?>

