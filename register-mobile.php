<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");

$conn = new mysqli("nuls-mysqldbserver.mysql.database.azure.com","nuls-user@nuls-mysqldbserver","National1","nuls");
$user = json_decode($_POST["user"]);
if($conn->query("INSERT INTO `users`(`user_fname`,`user_lname`,`user_mname`,`id_number`,`username`,`password`,`user_type`,`course_id`) VALUES ('$rser->fname','$user->lname','$user->mname','$user->id_num','$user->username','".password_hash($user->password)."','$user->user_type','$user->course_id')")) {
    echo json_encode($conn->insert_id);
} else {
    echo json_encode(0);
}

