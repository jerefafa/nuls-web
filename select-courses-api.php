<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");

$conn =  new mysqli( "localhost", "nulsx10h_je", "Pithecus2013", "nulsx10h_nuls");
$stmt = $conn->query("SELECT * FROM `courses`");
$courses = array();
while ($row = $stmt->fetch_object()) {
    array_push($courses, $row);
}
echo json_encode($courses);