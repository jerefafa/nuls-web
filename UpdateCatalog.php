<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>
</html>
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
                swal('','Successfully Updated','success');
                setTimeout(() => {
                                    window.history.go(-2);                    
                }, 2000)
            </script>";
   }else{
       echo "<script>
                swal('','Barcode should be unique','error');
                setTimeout(() => {
                window.history.back();                    
                }, 2000);
            </script>";
   }
}
