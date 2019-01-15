<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 07/05/2018
 * Time: 4:49 PM
 */
function check_access_control($access){
    $result = FALSE;
    foreach ($_SESSION["accesses"] as $arr){
        if($arr == $access){
            $result = TRUE;
            break;
        }
    }
    return $result;

}