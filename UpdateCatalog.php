<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 22/07/2018
 * Time: 2:22 AM
 */
require "connection.php";
if(!isset($_POST["UpdateCopy"])){
    header("Location:Catalog.php");
}
else{
    $sql;
    if(empty($_POST["subtype"])){
        $sql="UPDATE `catalog` SET `subtitle` = '".$_POST["subtitle"]."',`lccn`='".$_POST["lccn"]."',`isbn`='".$_POST["isbn"]."',`issn`='".$_POST["issn"]."',`barcode`='".$_POST["barcode"]."',`call_number`='".$_POST["callnumber"]."',`material_type_id`='".$_POST["material_type"]."',`publication_place`='".$_POST["publication_place"]."',`publisher` = '".$_POST["publisher"]."',`publication_date`='".date_format(date_create($_POST["publication_date"]),"Y-m-d")."',`extent`='".$_POST["extent"]."',`other_details`='".$_POST["other_details"]."',`size`='".$_POST["size"]."',`leading_article`='".$_POST["leading_article"]."' WHERE `catalog_id`='".$_POST["catalog_id"]."'";
    }
    else{
        $sql = "UPDATE `catalog` SET `subtitle` = '".$_POST["subtitle"]."',`lccn`='".$_POST["lccn"]."',`isbn`='".$_POST["isbn"]."',`issn`='".$_POST["issn"]."',`barcode`='".$_POST["barcode"]."',`call_number`='".$_POST["callnumber"]."',`material_type_id`='".$_POST["material_type"]."',`subtype_id`='".$_POST["subtype"]."',`publication_place`='".$_POST["publication_place"]."',`publisher` = '".$_POST["publisher"]."',`publication_date`='".date_format(date_create($_POST["publication_date"]),"Y-m-d")."',`extent`='".$_POST["extent"]."',`other_details`='".$_POST["other_details"]."',`size`='".$_POST["size"]."',`leading_article`='".$_POST["leading_article"]."' WHERE `catalog_id`='".$_POST["catalog_id"]."'";
    }
   if($stmt = $conn->query($sql)){
       echo "<script>
                alert('Successfully Updated');
                window.history.go(-2);
            </script>";
   }else{
       echo "<script>
                alert('Barcode should be unique');
                window.history.back();
            </script>";
   }
}
