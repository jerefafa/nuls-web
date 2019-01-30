<?php
require "connection.php";
    if(!isset($_GET["acquisition_num"])){
        header("location:index.php");
    }
    $acquisition_num = $_GET["acquisition_num"];
    $bookObject = null;
    $stmt = $conn->query("SELECT * FROM `acquisition` WHERE `acquisition_number` = '".$acquisition_num."'");
    while ($row = $stmt->fetch_object()) {
        $bookObject = $row;
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
            <li class="active"><a href="index.php">Library Search</a></li>
            <li class=""><a href="Login.html">Login</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

    </nav>

    <div id="content">
        <h4><?= $bookObject->title ?></h4>
        <h6>Author: <?= $bookObject->author ?></h6>
        <h6>Edition: <?= $bookObject->edition     ?></h6>
        <h6>Copies at National University Learning Resource Center</h6>
        <table class="highlight grey lighten-2">
            <thead>
            <tr>
                <th>Call #</th>
                <th>Copyright Year</th>
                <th>Material Type</th>
                <th>Status</th>
                <th>Description</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $stmt = $conn->query("SELECT * FROM `catalog` INNER JOIN `material_types` WHERE `catalog`.`material_type_id` = `material_types`.`material_type_id` AND `catalog`.`acquisition_number` = '".$acquisition_num."'");
            while ($row = $stmt->fetch_object()){
                $availability = mysqli_num_rows($conn->query("SELECT * FROM `circulation` WHERE `barcode` = '".$row->barcode."' AND `date_returned` IS NULL")) ==0 ?"Available":"Not Available";
                echo "<tr><td>$row->call_number</td>
                        <td>".date_format(date_create($bookObject->copyright_date),"Y")."</td>
                        <td>$row->material_type</td>
                        <td>$availability</td>
                        <td>$row->other_details</td>
                        </tr>
                    
                ";
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