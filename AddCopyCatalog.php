<!DOCTYPE HTML>
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
 * Time: 3:40 AM
 */
require "connection.php";
if(!isset($_POST["add_copy"])){
    header("location:Catalog.php");
}
else{
    $barcode;
    $subtype;
    $sql;

    if(isset($_POST["assign"])){
        $getBarcode = $conn->query("SELECT `barcode` FROM `catalog` ORDER BY `barcode` DESC LIMIT 1");
        while ($row = $getBarcode->fetch_object()){
             $barcode = $row->barcode;
             $barcode++;

        }

    }
    else{
        $barcode = $_POST["barcode"];
    }
    if(empty($_POST["subtype"])){

          $sql="INSERT INTO `catalog`(`acquisition_number`, `leading_article`, `subtitle`, `lccn`, `isbn`, `issn`, `call_number`, `barcode`, `material_type_id`, `publication_place`, `publisher`, `publication_date`, `extent`, `other_details`, `size`, `is_borrowed`, `remarks`, `is_missing`, `date_deleted`) VALUES('".$_POST["acquisition_number"]."','".$_POST["leading_article"]."','".$_POST["subtitle"]."','".$_POST["lccn"]."','".$_POST["isbn"]."','".$_POST["issn"]."','".$_POST["call_number"]."','".$barcode."','".$_POST["material_type"]."','".$_POST["publication_place"]."','".$_POST["publisher"]."','".date_format(date_create($_POST["publication_date"]),'Y-m-d')."','".$_POST["extent"]."','".$_POST["other_details"]."','".$_POST["size"]."','0',null,'0',null)";
    }
    else{

        $subtype = $_POST["subtype"];
        $sql="INSERT INTO `catalog`(`acquisition_number`, `leading_article`, `subtitle`, `lccn`, `isbn`, `issn`, `call_number`, `barcode`, `material_type_id`, `subtype_id`, `publication_place`, `publisher`, `publication_date`, `extent`, `other_details`, `size`, `is_borrowed`, `remarks`, `is_missing`, `date_deleted`) VALUES('".$_POST["acquisition_number"]."','".$_POST["leading_article"]."','".$_POST["subtitle"]."','".$_POST["lccn"]."','".$_POST["isbn"]."','".$_POST["issn"]."','".$_POST["call_number"]."','".$barcode."','".$_POST["material_type"]."','".$subtype."','".$_POST["publication_place"]."','".$_POST["publisher"]."','".date_format(date_create($_POST["publication_date"]),'Y-m-d')."','".$_POST["extent"]."','".$_POST["other_details"]."','".$_POST["size"]."','0',null,'0',null)";

    }
    if($stmt=$conn->query($sql)){
        echo "<script>
                    swal('','Successfully Inserted','success');
                    setInterval(() => {
                        window.history.go(-2);
                    }, 2000);
                </script>";
    }
    else{
        echo "<script>
                swal('','Barcode must be unique','error');
                setInterval(() => {
                window.history.back();                    
                }, 2000);
              </script>";
    }
}