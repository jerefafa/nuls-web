<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");

$conn = new mysqli("nuls-mysqldbserver.mysql.database.azure.com","nuls-user@nuls-mysqldbserver","National1","nuls");
$stmt = $conn->query("SELECT * FROM `courses`");
$courses = array();
while ($row = $stmt->fetch_object()) {
    array_push($courses, $row);
}
echo json_encode($courses);