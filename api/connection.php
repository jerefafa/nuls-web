<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 28/12/2018
 * Time: 12:00 PM
 */
$conn = new mysqli("nuls-mysqldbserver.mysql.database.azure.com","nuls-user@nuls-mysqldbserver","National1","nuls");
if(!$conn) {
    echo $conn->connect_error;
}