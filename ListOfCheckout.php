<?php
include "startup.php";
if(!isset($_GET["find"])){
    header("location:Checkout.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <!--background-color: #E6BF36;-->

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="MaterializeCSS/materialize/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="CSS/Style1.css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <title>NULRC</title>
</head>
<body>

<div id="container">
    <nav class="nav-background">
        <?php
        include "nav.php";
        ?>
        <span style="color: whitesmoke; margin-left: 10px">Welcome, <?= $_SESSION['fname'] ?> </span>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li class="active"><a href="Checkout.php">Check out</a></li>
            <li class=""><a href="Checkin.php">Check in</a></li>
            <li><a href="Lend.php">Lend</a></li>
            <li><a href="Receive.php">Receive</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

    </nav>

    <div id="content">
        <div class="row">
            <div class="col s12 m4 l3"></div>
        </div>

<form action = "Fines.php" method="get">
        <table class="highlight grey lighten-2">
            <thead>
            <tr>
               <!-- <th>Finds: <?php echo mysqli_num_rows($stmt)?></th>-->
            </tr>
            </thead>

            <tbody>
            <?php
            $getSearch = $_GET["find"];
            if(!preg_match("/^[a-zA-Z0-9#_.+&(),\-\s]*$/", $getSearch)){
                ?>
                <script>
                    swal("", "Please Check Your Input | Only Allows Alphanumeric & Special Characters (e.g #,_, +, &, .)", "info");
                    setInterval(() => {
                        location.href="Checkout.php";
                    }, 2000);
                </script>
                <?php
            }
            else {
                $sql = "";
                if (isset($_GET["find"])) {
                    $ddvalue = $_GET["findwhat"];
                    if ($ddvalue == 1) {
                        $sql = "SELECT * FROM `users` INNER JOIN `courses` WHERE `users`.`course_id` = `courses`.`course_id` AND `user_lname` LIKE '%".$_GET["find"]."%' OR '%".$_GET["find"]."%' AND `date_deleted` IS NULL";
                        $stmt = $conn->query($sql);
                        if(mysqli_num_rows($stmt) < 1) {
                            echo "<script>swal('','No Results Found', 'info')</script>";
                        }
                        while ($row = $stmt->fetch_object()){
                            ?>
                            <tr>
                                <td>
                                    <div style="margin-left: 25px">
                                        Name: <?= $row->user_fname . ' ' . $row->user_lname?> <br>
                                        ID Number: <?= $row->id_number ?><br>
                                        Course: <?= $row->course ?> <br>
                                        <div>
                                            <span style="font-weight: bold">Borrowed Books: </span> <br>
                                            <?php
                                            $stmt2 = $conn->query("SELECT * FROM `circulation` INNER JOIN `catalog` INNER JOIN `acquisition` WHERE `circulation`.`barcode` = `catalog`.`barcode` AND `catalog`.`acquisition_number` = `acquisition`.`acquisition_number` AND `circulation`.`borrower_id` = '$row->user_id' AND `circulation`.`date_returned` IS NULL");
                                            while ($row2 = $stmt2->fetch_object()) {
                                                ?>
                                                    <div>
                                                        Title: <?=$row2->title?> <br>
                                                        Barcode: <?=$row2->barcode?> <br>
                                                        Date Borrowed: <?=date_format(date_create($row2->date_borrowed), 'M d Y')?> <hr>
                                                    </div>
                                                <?php
                                            }
                                            ?>
                                            <div style="width: 100%; float: right" class="right-align">
                                                <form action="Fines.php" method="get">
                                                    <input type="hidden" name="id" value="<?=$row->user_id?>">
                                                    <input type="submit" value="fines" class="btn" name="fines">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }

                    } else if ($ddvalue == 2) {
                        $title = $_GET["find"];
                        $sql = "SELECT `acquisition`.`acquisition_number`,`acquisition`.`title`,`acquisition`.`author`,`catalog`.`barcode`,`users`.`user_id`,`users`.`user_fname`,`users`.`user_lname`,`users`.`user_mname`,`users`.`id_number`,`courses`.`course_id`,`courses`.`course`,`circulation`.`date_borrowed`,`circulation`.`date_returned` FROM `acquisition` INNER JOIN `catalog` INNER JOIN `circulation` INNER JOIN `users` INNER JOIN `courses` WHERE `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` AND `catalog`.`barcode` = `circulation`.`barcode` AND `users`.`user_id` = `circulation`.`borrower_id` AND `courses`.`course_id` = `users`.`course_id` AND `acquisition`.`title` = '$title'";
                        if ($stmt = $conn->query($sql)) {;
                            while ($row = $stmt->fetch_object()) {
                                echo "<tr><td colspan='2'>
                    <div style=\"margin-left: 25px\">
                    Name :<b> " . $row->user_lname . ", " . $row->user_fname . " " . $row->user_mname . "</b> (" . $row->course . " : " . $row->id_number . ")<br>                  
                    Program : <b>" . $row->course . "<br>
                    </div>
                    <br>
                    <b>Checked Out </b><br>
                    <div style=\"margin-left: 25px\">
                        <b>" . $row->title . " </b>
                        (Copy: " . $row->barcode . " )
                    </div>
                   <td>
                   <input type='hidden' value='$row->user_id' name='id'>
                     <input type=\"submit\" class=\"waves-effect waves-light btn\" style=\"margin-top: 1%\" value=\"FINES\" name=\"fines\">
                    <br><br>
                      

                </td>
                </tr>";

                            }
                        }
                    }

                }
                    }

            ?>


            </tbody>
        </table>
</form>
    </div>

</div>
</body>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="MaterializeCSS/materialize/js/materialize.min.js"></script>
<script>
    $('.button-collapse').sideNav({
            menuWidth: 300, // Default is 300
            edge: 'left', // Choose the horizontal origin
            closeOnClick: false, // Closes side-nav on <a> clicks, useful for Angular/Meteor
            draggable: true // Choose whether you can drag to open on touch screens,
        }
    );

    $(document).ready(function(){
        $('.collapsible').collapsible();
    });
    $(document).ready(function(){
        $('ul.tabs').tabs('select_tab', 'tab_id');
    });
    $(document).ready(function() {
        $('select').material_select();
    });
</script>
</html>