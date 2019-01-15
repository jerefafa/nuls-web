<?php
require "connection.php";
if(!isset($_GET["wildcard"])){
    header("Location:Index.php");

}
$keyword = $_GET['wildcard'];
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

    <title>NULRC</title>
</head>
<body>

<div id="container">
    <nav class="nav-background">
        <div id="menu">
            <ul id="slide-out" class="side-nav fixed sidebar-background">

                <li class="sidebar-header user-view">
                    <img class="circle center-block" src="Images/NULOGO.png">
                    <p class="center">National University <br> Learning Resource Center</p>
                </li>

            </ul>
        </div>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li class="active"><a href="Index.php">Library Search</a></li>
            <li class=""><a href="Login.html">Login</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

    </nav>

    <div id="content">
        <?php
        $getSearch = $_GET["wildcard"];
        if(!preg_match("/^[a-zA-Z0-9#_.+&(),\-\s]*$/", $getSearch)){
            ?>
            <script>
                alert('Please Check Your Input | Only Allows Alphanumeric & Special Characters (e.g #,_, +, &, .)');
                location.href="Index.php";
            </script>
            <?php
        }
        else{

        $stmt = $conn->query("SELECT DISTINCT `acquisition`.`acquisition_number`,`acquisition`.`title`,`acquisition`.`author`,`acquisition`.`edition`,`acquisition`.`quantity` FROM `acquisition` INNER JOIN `keywords`,`subjects`,`catalog` WHERE (`acquisition`.`title` LIKE '%" . $keyword . "%' OR `acquisition`.`author` LIKE '%" . $keyword . "%') OR (`keywords`.`keyword` LIKE '%" . $keyword . "%' AND `keywords`.`acquisition_number` = `acquisition`.`acquisition_number`) OR (`subjects`.`subject_name` LIKE '%" . $keyword . "%' AND `acquisition`.`subject_id` = `subjects`.`subject_id`) AND (`acquisition`.`date_deleted` IS NULL)");
        ?>
        <h6><b>Search for (library). Searched in: National University Learning Resource Center</b></h6>

        <table class="highlight grey lighten-2">
            <thead>
            <tr>
                <th>Titles: <?php echo mysqli_num_rows($stmt) ?></th>

            </tr>
            </thead>

            <tbody>
            <?php
            while ($row = $stmt->fetch_object()) {
                $numAvailable = mysqli_num_rows($conn->query("SELECT * FROM `catalog` WHERE `acquisition_number` = '" . $row->acquisition_number . "'")) - mysqli_num_rows($conn->query("SELECT * FROM `circulation` INNER JOIN `acquisition` INNER JOIN `catalog` WHERE `circulation`.`barcode` = `catalog`.`barcode` AND `catalog`.`acquisition_number` = `acquisition`.`acquisition_number` AND `acquisition`.`acquisition_number` = '" . $row->acquisition_number . "' AND `circulation`.`date_returned` IS NULL"));
                echo "<tr>
                        <td>
                       <a href='Student_SearchDetails.php?acquisition_num=$row->acquisition_number'><b>$row->title</b></a><br>
                       Author: $row->author<br>
                       Edition: $row->edition  
                         </td>
                         <td> $numAvailable of $row->quantity Available</td>
                         <td></td>
                        </tr>";
            }
            }
            ?>


            </tbody>
        </table>

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