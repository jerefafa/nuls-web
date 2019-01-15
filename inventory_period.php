<?php
require "connection.php";
if(isset($_POST["start"])){
    $stmt = $conn->query("SELECT `is_checked` FROM `periods`");
    while ($row = $stmt->fetch_object()){
        if($row->is_checked==0){
            $sql = $conn->query("UPDATE `periods` SET is_checked='1'");
            $sql = $conn->query("UPDATE `catalog` SET is_missing='1'");
            echo"<script>alert('Inventory Period Started Successfully'); location.href='Inventory.php';</script>";
        }
        else{
            echo"<script>alert('Inventory Period Already Started'); location.href='Inventory.php';</script>";
        }
    }
}
elseif(isset($_POST["end"])){
    $stmt = $conn->query("SELECT `is_checked` FROM `periods`");
    while ($row = $stmt->fetch_object()){
        if($row->is_checked==1){
            $sql = $conn->query("UPDATE `periods` SET is_checked='0'");
            echo"<script>alert('Inventory Period Ended Successfully'); location.href='Inventory.php';</script>";
        }
        else{
            echo"<script>alert('Inventory Period Already Ended'); location.href='Inventory.php';</script>";
        }
    }
}