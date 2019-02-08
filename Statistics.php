<?php
include "startup.php";
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
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
            <li class=""><a href="Statistics.php">Circulation Statistics</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

    </nav>

    <div id="content">
        <form action="Statistics.php" method="post">
        <div class="row">
            <h6>Date:</h6>
            <div class="input-field col s3">
                <input type="text" class="datepicker" id="from" name="from" required>
                <label class="active center" for="to">From</label>
            </div>
            <div class="input-field col s3">
                <input type="text" class="datepicker" id="to" name="to" required>
                <label class="active center" for="from">To</label>
            </div>
            <div class="col s2">
                <label>Circulation</label>
                <select class="browser-default" name="cmbText" required>
                    <option value="0">Check In</option>
                    <option value="1">Check Out</option>
                </select>
            </div>
            <div class="col s2">
                <label>College</label>
                <select class="browser-default" name="cmbCourse" required>
                    <option value="all" selected>All</option>
                    <?php
                    $stmt = $conn->query("SELECT * FROM `programs` WHERE `date_deleted` IS NULL");
                    while ($row = $stmt->fetch_object()) {
                        echo "<option value='$row->program_id'>".$row->program."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col s2">
               <!-- <a class="waves-effect waves-light btn active" style="margin-top: 11%" href="">Go!</a>-->
               <button type="submit" class="waves-effect waves-light btn active" style="margin-top: 17%" type="submit" value="search" name="goBtn">GO!</button>
            </div>
        </div>
        </form>
        <?php
            if (isset($_POST["goBtn"])){
                if(!empty($_POST["from"]) && !empty($_POST["to"])) {
                    $objects = array();
                    if ($_POST["cmbCourse"] != "all") {
                        $stmt1 = $conn->query("SELECT * FROM `courses` WHERE `program_id` = '" . $_POST["cmbCourse"] . "' ");
                        while ($row1 = $stmt1->fetch_object()) {
                            if ($_POST["cmbText"] == "0") {
                                $from = date_format(date_create($_POST["from"]), "Y-m-d");
                                $to = date_format(date_create($_POST["to"]), "Y-m-d");
                                $stmt2 = $conn->query("SELECT `circulation`.`circulation_id` FROM `circulation` INNER JOIN `users` INNER JOIN `courses`  WHERE `circulation`.`borrower_id` = `users`.`user_id` AND `users`.`course_id` = `courses`.`course_id` AND `courses`.`course_id` = '$row1->course_id' AND `circulation`.`date_returned` BETWEEN '$from' AND '$to'");
                                $object = [
                                    "program_id" => $row1->course_id,
                                    "program" => $row1->course,
                                    "numCirculation" => mysqli_num_rows($stmt2)
                                ];
                                array_push($objects, $object);
                            } else {
                                $from = date_format(date_create($_POST["from"]), "Y-m-d");
                                $to = date_format(date_create($_POST["to"]), "Y-m-d");
                                $stmt2 = $conn->query("SELECT `circulation`.`circulation_id` FROM `circulation` INNER JOIN `users` INNER JOIN `courses`  WHERE `circulation`.`borrower_id` = `users`.`user_id` AND `users`.`course_id` = `courses`.`course_id` AND `courses`.`course_id` = '$row1->course_id' AND `circulation`.`date_borrowed` BETWEEN '$from' AND '$to'");
                                $object = [
                                    "program_id" => $row1->course_id,
                                    "program" => $row1->course,
                                    "numCirculation" => mysqli_num_rows($stmt2)
                                ];
                                array_push($objects, $object);
                            }
                        }
                    } else {
                        $stmt1 = $conn->query("SELECT * FROM `programs` WHERE `date_deleted` IS NULL ");
                        while ($row1 = $stmt1->fetch_object()) {
                            if ($_POST["cmbText"] == "0") {
                                $from = date_format(date_create($_POST["from"]), "Y-m-d");
                                $to = date_format(date_create($_POST["to"]), "Y-m-d");
                                $stmt2 = $conn->query("SELECT `circulation`.`circulation_id` FROM `circulation` INNER JOIN `users` INNER JOIN `courses` INNER JOIN `programs` WHERE `circulation`.`borrower_id` = `users`.`user_id` AND `users`.`course_id` = `courses`.`course_id` AND `courses`.`program_id` = `programs`.`program_id` AND `programs`.`program_id` = '$row1->program_id' AND `circulation`.`date_returned` BETWEEN '$from' AND '$to'");
                                $object = [
                                    "program_id" => $row1->program_id,
                                    "program" => $row1->program,
                                    "numCirculation" => mysqli_num_rows($stmt2)
                                ];
                                array_push($objects, $object);
                            } else {
                                $from = date_format(date_create($_POST["from"]), "Y-m-d");
                                $to = date_format(date_create($_POST["to"]), "Y-m-d");
                                $stmt2 = $conn->query("SELECT `circulation`.`circulation_id` FROM `circulation` INNER JOIN `users` INNER JOIN `courses` INNER JOIN `programs` WHERE `circulation`.`borrower_id` = `users`.`user_id` AND `users`.`course_id` = `courses`.`course_id` AND `courses`.`program_id` = `programs`.`program_id` AND `programs`.`program_id` = '$row1->program_id' AND `circulation`.`date_borrowed` BETWEEN '$from' AND '$to'");
                                $object = [
                                    "program_id" => $row1->program_id,
                                    "program" => $row1->program,
                                    "numCirculation" => mysqli_num_rows($stmt2)
                                ];
                                array_push($objects, $object);
                            }
                        }
                    }
                    echo " <canvas id=\"Chart1\"></canvas>";
                } else{
                    echo "<script>swal('','Please fill up all fields','error')</script>";
                }
            }
        ?>



        <script>
            function random_rgba() {
                var o = Math.round, r = Math.random, s = 255;
                return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
            }
        </script>
        <script>
            let Chart1 = document.getElementById('Chart1').getContext('2d');

            // Global Options
            Chart.defaults.global.defaultFontFamily = 'Lato';
            Chart.defaults.global.defaultFontSize = 18;
            Chart.defaults.global.defaultFontColor = '#777';
            let labels = [];
            let numCirculation = [];
            let bg = [];
            let obj;

            <?php
                foreach ($objects as $object) {
                    ?>
                    //console.log('<?//=json_encode($object)?>//');
                     obj = <?=json_encode($object)?>;
                     labels.push(obj.program);
                     numCirculation.push(obj.numCirculation);
                     bg.push(random_rgba());
                     <?php
                }
            ?>
            let massPopChart = new Chart(Chart1, {
                type:'horizontalBar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                data:{
                    labels:[...labels],
                    datasets:[{
                        label:'',
                        data: [...numCirculation],
                        backgroundColor: [...bg],
                        borderWidth:1,
                        borderColor:'#777',
                        hoverBorderWidth:3,
                        hoverBorderColor:'#000'
                    }]
                },
                options:{
                    title:{
                        display:true,
                        text:'Library Circulation',
                        fontSize:25
                    },
                    legend:{
                        display: false,
                        position:'right',
                        labels:{
                            fontColor:'#000'
                        }
                    },
                    layout:{
                        padding:{
                            left:50,
                            right:0,
                            bottom:0,
                            top:0
                        }
                    },
                    tooltips:{
                        enabled:true
                    }
                }
            });
        </script>

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
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        format: 'mmm dd yyyy',
        closeOnSelect: false // Close upon selecting a date,
    });
</script>
</html>