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
 * User: USER
 * Date: 05/03/2018
 * Time: 8:07 AM
 */
require "connection.php";
session_start();
error_reporting(0);
if(isset($_POST["username"])){
    $email = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);


    $stmt = $conn->query("SELECT librarian_id, password FROM  `librarians` WHERE email = '".$email."'");
    if($stmt->num_rows > 0){
        $data = $stmt->fetch_array();
        if(password_verify($password, $data['password']))
            $password = $data['password'];

        $stmt1 = $conn->query("SELECT * FROM  `librarians` WHERE email = '".$email."' AND password = '".$password."'");
        $rows = mysqli_num_rows($stmt1);
        if($rows>0){
            while($res = $stmt1->fetch_object()) {
                $_SESSION['fname'] = $res->fname;
                $_SESSION['username'] = $res->email;
                $_SESSION['position'] = $res->position;
                if($res->position=="Chief Librarian" || $res->position=="Super Admin"){
                    $_SESSION["accesses"] = array();
                    ?>
                    <script>
                        swal("","Login Success", "success");
                        setInterval(() => {
                            location.href="Home.php";
                        }, 2000);
                    </script>
                    <?php
                }
                else{
                    $query = $conn->query("SELECT * FROM `access_levels` WHERE `librarian_id` = '".$res->librarian_id."'");
                    $_SESSION["accesses"] = array();
                    while($row = $query->fetch_object()){
                        array_push($_SESSION["accesses"],$row->access_level);
                    }
                    ?>
                    <script>
                        swal("","Login Success", "success");
                        setInterval(() => {
                            location.href="Home.php";
                        }, 2000);
                    </script>
                    <?php
                }

            }
        }



        else
            echo "<script>
            swal(\"\",\"Invalid Username and/or Password\", \"error\");
            setInterval(() => {
                location.href=\"Home.php\";
            }, 2000);
        </script>";

    }
    else{
        ?>
        <script>
            swal("","Login Success", "success");
            setInterval(() => {
                location.href="Home.php";
            }, 2000);
        </script>

        <?php
    }
}
else{
    session_unset();
    session_destroy();
    header("location:Login.html");
}
