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
        <h5>Check in</h5>
        <h6>Date: 05/06/2018 - 05/07/2018</h6><br>
        <table class="responsive-table">
            <!--<thead>
            <tr>
                <th>Copyright</th>
                <th>Edition</th>
                <th>Format</th>
                <th>Content type term</th>
                <th>Media type term</th>
                <th>Carrier type term</th>
                <th>ISBN</th>
            </tr>
            </thead>-->

            <tbody>
            <?php
            require "connection.php";
            if(isset($_GET["start"])){
                $cmbValue = $_GET["cmbText"];
                $startDate= date_format(date_create($_GET['start']),"Y-m-d");
                $endDate=  date_format(date_create($_GET['end']),"Y-m-d");

                if($cmbValue == 0){
                    $sql="SELECT `acquisition`.`acquisition_number`,`acquisition`.`title`,`acquisition`.`author`,`catalog`.`barcode`,`users`.`user_id`,`users`.`user_fname`,`users`.`user_lname`,`users`.`user_mname`,`users`.`id_number`,`courses`.`course_id`,`courses`.`course`,`circulation`.`date_borrowed`,`circulation`.`date_returned` FROM `acquisition` INNER JOIN `catalog` INNER JOIN `circulation` INNER JOIN `users` INNER JOIN `courses` WHERE `circulation`.`date_returned` BETWEEN '$startDate' AND '$endDate' AND `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` AND `catalog`.`barcode` = `circulation`.`barcode` AND `users`.`user_id` = `circulation`.`borrower_id` AND `courses`.`course_id` = `users`.`course_id`";
                }else if ($cmbValue == 1){
                    $sql="SELECT `acquisition`.`acquisition_number`,`acquisition`.`title`,`acquisition`.`author`,`catalog`.`barcode`,`users`.`user_id`,`users`.`user_fname`,`users`.`user_lname`,`users`.`user_mname`,`users`.`id_number`,`courses`.`course_id`,`courses`.`course`,`circulation`.`date_borrowed`,`circulation`.`date_returned` FROM `acquisition` INNER JOIN `catalog` INNER JOIN `circulation` INNER JOIN `users` INNER JOIN `courses` WHERE `circulation`.`date_borrowed` BETWEEN '$startDate' AND '$endDate' AND `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` AND `catalog`.`barcode` = `circulation`.`barcode` AND `users`.`user_id` = `circulation`.`borrower_id` AND `courses`.`course_id` = `users`.`course_id`";
                }
            }
            else{
                $sql="SELECT `acquisition`.`acquisition_number`,`acquisition`.`title`,`acquisition`.`author`,`catalog`.`barcode`,`users`.`user_id`,`users`.`user_fname`,`users`.`user_lname`,`users`.`user_mname`,`users`.`id_number`,`courses`.`course_id`,`courses`.`course`,`circulation`.`date_borrowed`,`circulation`.`date_returned` FROM `acquisition` INNER JOIN `catalog` INNER JOIN `circulation` INNER JOIN `users` INNER JOIN `courses` WHERE `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` AND `catalog`.`barcode` = `circulation`.`barcode` AND `users`.`user_id` = `circulation`.`borrower_id` AND `courses`.`course_id` = `users`.`course_id`";
            }

            if($stmt = $conn->query($sql)){

                while ($row=$stmt->fetch_object()){
                    echo"
                    <tr>
                        <td>
                            <b>".$row->title." </b> ".$row->barcode."<br>
                            <i>Checked out ".$row->date_borrowed."</i> to <b>".$row->user_lname.", ".$row->user_fname." ".$row->user_mname."</b> (".$row->course.": ".$row->id_number.")<br>
        
                        </td>
                        <td>
                            <b>Returned</b> ".$row->date_returned."
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