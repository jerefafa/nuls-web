<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
if(isset($_POST['username'])) {
    
    function Login()
    {
        $conn =  new mysqli( "localhost", "nulsx10h_je", "Pithecus2013", "nulsx10h_nuls");
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = $conn->query("SELECT * FROM `librarians` WHERE  `email` = '".$username."' AND date_deleted IS NULL");
        $response = array();
        $numrow = mysqli_num_rows($sql);
        if($numrow > 0) {
            while ($row = $sql->fetch_object()) {
                $pass = $row->password;
                if (password_verify($password, $pass)) {
                    $response = $row;
                }
            }
        }
        else{
            $sql = $conn->query("SELECT * FROM `users` WHERE  `username` = '".$username."' AND date_deleted IS NULL");
            $numrow = mysqli_num_rows($sql);
            if($numrow>0){
                while ($row = $sql->fetch_object()){
                    $pass = $row->password;
                    if(password_verify($password,$pass)) {
                        $response = $row;
                    }
                }
            }
           
        }
        $jsonObject = json_encode($response);
        echo $jsonObject;
        return $jsonObject;
    }
    Login();

}