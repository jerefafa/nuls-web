<?php
include "startup.php";
error_reporting(0);
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
    <script>
        function showPrompt(title, formId) {
            swal({
                title: "Are you sure you want to delete "+title+"?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                showCancelButton: true
            }, function (isDelete) {
                if(isDelete) {
                    console.log(formId);
                    var form = document.getElementById(formId);
                    form.submit();
                }
            });
        }
    </script>
    <title>NULRC</title>
</head>
<body>

<div id="container">
    <nav class="nav-background">
        <?php
        include "nav.php";
        ?>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li class=""><a href="AddCopies.php">Add Copies</a></li>
            <li class="active"><a href="ListOfCopies.php">List of Copies</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

    </nav>

    <div id="content">
        <div class="row">

                <form action="ListOfCopies.php" method="get">
                    <div class="col s8">
                <input type="text" name="search">
                    </div>
                    <div  class="col s4"> <input type="submit" value="search" name="searchButton" class="material-icons btn-floating" style="border:0px;font-size: x-large;color:white"></div>
                </form>
            </div>

        <table class="highlight">
            <thead>
            <tr>
                <th>Program</th>
                <th>Subject</th>
                <th>Author</th>
                <th>Title</th>
                <th>Edition</th>
                <th>Manage</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $getSearch = $_GET["search"];
            if(!preg_match("/^[a-zA-Z0-9#_.+&(),\-\s]*$/", $getSearch)){
                ?>
                <script>
                    alert('Please Check Your Input | Only Allows Alphanumeric & Special Characters (e.g #,_, +, &, .)');
                    location.href="ListOfCopies.php";
                </script>
                <?php
            }
            else{
                $sql = "";
                if (isset($_GET["searchButton"])) {
                    $keyword = $_GET["search"];
                    $sql = "SELECT `acquisition`.`acquisition_number`,`programs`.`program`,`subjects`.`subject_name`,`acquisition`.`author`,`acquisition`.`title`,`acquisition`.`edition` FROM `acquisition` INNER JOIN `programs` INNER JOIN `subjects` WHERE (`acquisition`.`title`='$keyword' OR `programs`.`program`='$keyword' OR `subjects`.`subject_name`='$keyword' OR `acquisition`.`author` = '$keyword') AND `programs`.`program_id` = `acquisition`.`program_id` AND `subjects`.`subject_id` = `acquisition`.`subject_id` AND `acquisition`.`date_deleted` IS NULL ORDER BY `title`";
                } else {
                    $sql = "SELECT `acquisition`.`acquisition_number`,`programs`.`program`,`subjects`.`subject_name`,`acquisition`.`author`,`acquisition`.`title`,`acquisition`.`edition` FROM `acquisition` INNER JOIN `programs` INNER JOIN `subjects` WHERE `programs`.`program_id` = `acquisition`.`program_id` AND `subjects`.`subject_id` = `acquisition`.`subject_id` AND `acquisition`.`date_deleted` IS NULL ORDER BY `title`";
                }
                if ($stmt = $conn->query($sql)) {
                $ctr = mysqli_num_rows($stmt);
                $page = $ctr / 10;
                $page = ceil($page);
                if (!isset($_GET["searchButton"])) {
                for ($b = 1;
                $b <= $page;
                $b++) {
                ?> <a href="ListOfCopies.php?page=<?php echo $b; ?>"><?php echo $b . ' ' ?></a>  <?php
            }
            }
                $a = 1;
                if (isset($_GET["page"])) {
                    $a = $_GET["page"];
                };
                if ($a == "" || $a == "1") {
                    $page1 = 0;
                } else {
                    $page1 = ($a * 10) - 10;
                }
                if (!isset($_GET["search"])) {
                    $sql2 = "SELECT `acquisition`.`acquisition_number`,`programs`.`program`,`subjects`.`subject_name`,`acquisition`.`author`,`acquisition`.`title`,`acquisition`.`edition` FROM `acquisition` INNER JOIN `programs` INNER JOIN `subjects` WHERE `programs`.`program_id` = `acquisition`.`program_id` AND `subjects`.`subject_id` = `acquisition`.`subject_id` AND `acquisition`.`date_deleted` IS NULL ORDER BY `title` LIMIT $page1, 10";
                } else {
                    $sql2 = "SELECT `acquisition`.`acquisition_number`,`programs`.`program`,`subjects`.`subject_name`,`acquisition`.`author`,`acquisition`.`title`,`acquisition`.`edition` FROM `acquisition` INNER JOIN `programs` INNER JOIN `subjects` WHERE (`acquisition`.`title`='$keyword' OR `programs`.`program`='$keyword' OR `subjects`.`subject_name`='$keyword' OR `acquisition`.`author` = '$keyword') AND `programs`.`program_id` = `acquisition`.`program_id` AND `subjects`.`subject_id` = `acquisition`.`subject_id` AND `acquisition`.`date_deleted` IS NULL ORDER BY `title`";

                }
                $stmt2 = $conn->query($sql2);
                while ($row = $stmt2->fetch_object()) {
                    echo "<tr>
                        <td>" . $row->program . "</td>
                        <td>" . $row->subject_name . "</td>
                        <td>" . $row->author . "</td>
                        <td>" . $row->title . "</td>
                        <td>" . $row->edition . "</td>
                        <td style='display: flex'> 
                        <form action='UpdateCopies.php' method='get'><input class='btn-floating material-icons' type='submit' value='edit' style='border: 0px;color: #e4ffda;font-size: x-large;margin-right:25px'><input type='hidden' name='acquisition_number' value='" . $row->acquisition_number . "'></form>
                        <form id='$row->acquisition_number' action='DeleteCopy.php' method='post'><button onclick='showPrompt(`".$row->title."`,`".$row->acquisition_number."`)' class='btn-floating material-icons' type='button'  style='border: 0px;color: white;font-size: x-large;' value='$row->id'>delete</button><input type='hidden' name='acquisition_number' value='" . $row->acquisition_number . "'></form>
                        </td>
                    </tr>";
                }
            } else {
                echo mysqli_error($conn);
            }
            }
            ?>

            </tbody>
        </table>

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
        closeOnSelect: false // Close upon selecting a date,
    });
</script>
</html>