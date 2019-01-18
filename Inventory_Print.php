<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="CSS/Style4.css">
    <link rel="stylesheet" type="text/css" href="MaterializeCSS/materialize/css/materialize.min.css">
    <title>Inventory</title>
</head>
<body>

<!--
<page size="A4"></page>
<page size="A4"></page>
<page size="A4" layout="portrait"></page>
<page size="A5"></page>
<page size="A5" layout="portrait"></page>
<page size="A3"></page>
<page size="A3" layout="portrait"></page>
-->

<page size="A4">
    <div style="margin-left: 3%; margin-right: 3%; padding-top: 5%;">
        <h5>List of Books</h5>
        <table class="responsive-table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Barcode Number</th>
                <th>Remarks</th>
                <th>Other Details</th>
            </tr>
            </thead>

            <tbody>
            <?php
            require "connection.php";
            if(isset($_GET["start"])){
                $startDate= date_format(date_create($_GET['start']),"Y-m-d");
                $endDate=  date_format(date_create($_GET['end']),"Y-m-d");
                $sql="SELECT `acquisition`.`acquisition_number`,`catalog`.`catalog_id`,`acquisition`.`title`,`acquisition`.`author`,`catalog`.`is_borrowed`,`catalog`.`remarks`,`catalog`.`is_missing`,`catalog`.`other_details`,`catalog`.`barcode`,`inventory`.`date_of_inventory` FROM `acquisition` INNER JOIN `catalog` INNER JOIN `inventory` WHERE `inventory`.`date_of_inventory` BETWEEN '$startDate' AND '$endDate' AND `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` AND `catalog`.`catalog_id` = `inventory`.`catalog_id` ORDER BY `inventory`.`date_of_inventory` ASC ";
            }else{
                $sql="SELECT `acquisition`.`acquisition_number`,`catalog`.`catalog_id`,`acquisition`.`title`,`acquisition`.`author`,`catalog`.`is_borrowed`,`catalog`.`remarks`,`catalog`.`is_missing`,`catalog`.`other_details`,`catalog`.`barcode`,`inventory`.`date_of_inventory` FROM `acquisition` INNER JOIN `catalog` INNER JOIN `inventory` WHERE `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` AND `catalog`.`catalog_id` = `inventory`.`catalog_id` ORDER BY `inventory`.`date_of_inventory` ASC";
            }

            if($stmt = $conn->query($sql)){

                while ($row=$stmt->fetch_object()){
                    echo "<tr>
                        <td>".$row->title."</td>
                        <td>".$row->author."</td>
                        <td>".$row->barcode."</td>
                        <td>".$row->remarks."</td>
                        <td>".$row->other_details."</td>
                        
                        
                    </tr>";


                }
            }
            ?>
            </tbody>
        </table>
    </div>
</page>

</body>
</html>