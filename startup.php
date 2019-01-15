<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 07/05/2018
 * Time: 5:36 PM
 */
session_start();
if(!isset($_SESSION["username"])){
    header("location:login.php");
}
require "connection.php";
include "access_control_checker.php";






