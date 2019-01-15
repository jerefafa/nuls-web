<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="CSS/Style4.css">
    <link rel="stylesheet" type="text/css" href="MaterializeCSS/materialize/css/materialize.min.css">
    <title>Catalog</title>
</head>
<body>

<page size="A4">
    <div style="margin-left: 3%; margin-right: 3%; padding-top: 5%;">
        <h5>Title and Copy Lists</h5>
        <h6>Date: 05/06/2018 - 05/07/2018</h6><br>
        <table class="responsive-table">
            <tbody>
            <?php
            require "connection.php";
            $sql="";
            if(isset($_GET["start"])){
                $startDate= date_format(date_create($_GET['start']),"Y-m-d");
                $endDate=  date_format(date_create($_GET['end']),"Y-m-d");
                $sql="SELECT `acquisition`.`acquisition_number`,`acquisition`.`title`,`catalog`.`call_number`,`catalog`.`publisher`,`catalog`.`publication_date` FROM `acquisition` INNER JOIN `catalog` WHERE `catalog`.`publication_date` BETWEEN '$startDate' AND '$endDate' AND `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` ORDER BY `catalog`.`publication_date` ASC";
            }else{
                $sql="SELECT `acquisition`.`acquisition_number`,`acquisition`.`title`,`catalog`.`call_number`,`catalog`.`publisher`,`catalog`.`publication_date` FROM `acquisition` INNER JOIN `catalog` WHERE `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` ORDER BY `catalog`.`publication_date` ASC";
            }

            if($stmt=$conn->query($sql)){
                while ($row=$stmt->fetch_object()){
                    echo "
                    <tr>
                        <td>
                            <b>$row->title</b> <br>
                            Call #: $row->call_number edited by $row->publisher <br>
                            Published $row->publication_date
                        </td>
                    </tr>
                    ";
                }
            }

            ?>
            </tbody>
        </table>
    </div>
</page>


</body>
</html>