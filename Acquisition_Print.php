<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 09/01/2019
 * Time: 10:43 PM
 */
require "connection.php";
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="CSS/Style4.css">
    <link rel="stylesheet" type="text/css" href="MaterializeCSS/materialize/css/materialize.min.css">
    <title>Acquisition</title>
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

        <h5>List of Acquired books</h5>
        <h6>Date: 05/06/2018 - 05/07/2018</h6><br>
        <table class="responsive-table">
            <thead>
            <th>Book Title</th>
            <th>Author</th>
            <th>Edition</th>
            <th>Copyright Date</th>
            <th>Price</th>
            <th>Date Delivered</th>
            <th>Date of Shelving</th>
            <th>Remarks</th>
            <th>Quantity</th>
            </thead>
            <tbody>
            <?php
            if(isset($_GET["start"])){
                $startDate= date_format(date_create($_GET['start']),"Y-m-d");
                $endDate=  date_format(date_create($_GET['end']),"Y-m-d");
                $sql="SELECT * FROM `acquisition` WHERE `date_delivered` BETWEEN '$startDate' AND '$endDate' AND `date_deleted` IS NULL ORDER BY `date_delivered` ASC";
            }else{
                $sql="SELECT * FROM `acquisition` WHERE `date_deleted` IS NULL ORDER BY `date_delivered` ASC";
            }

            if($stmt = $conn->query($sql)){

                while ($row=$stmt->fetch_object()){

                    echo "<tr>
                    <td>".$row->title."</td>
                    <td>".$row->author."</td>
                    <td>".$row->edition."</td>
                    <td>".date_format(date_create($row->copyright_date),"M d Y")."</td>
                    <td>".$row->price."</td>
                    <td>".date_format(date_create($row->date_delivered),"M d Y")."</td>
                    <td>".date_format(date_create($row->date_of_shelving),"M d Y")."</td>
                    <td>".$row->remarks."</td>
                    <td>".$row->quantity."</td>
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


