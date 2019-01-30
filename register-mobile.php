<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");

$conn =  new mysqli( "localhost", "nulsx10h_je", "Pithecus2013", "nulsx10h_nuls");
$user = json_decode($_POST["user"]);

if(mysqli_num_rows($conn->query("SELECT * FROM `users` WHERE `username` = '$user->username' OR `id_number` = '$user->id_num'")) == 0 ) {
    if ($conn->query("INSERT INTO `users`(`user_fname`,`user_lname`,`user_mname`,`id_number`,`username`,`password`,`user_type`,`course_id`) VALUES ('$user->fname','$user->lname','$user->mname','$user->id_num','$user->username','" . password_hash($user->password, PASSWORD_DEFAULT) . "','$user->user_type','$user->course_id')")) {
        echo json_encode(json_encode($conn->insert_id));
    } else {
        echo json_encode("failed");
    }
}
else {
    echo json_encode("taken");
}

