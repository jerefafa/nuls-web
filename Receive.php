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
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>NULRC</title>
</head>
<body>

<div id="container">
    <nav class="nav-background">
        <?php
        include "nav.php";
        ?>
        <span style="color: whitesmoke; margin-left: 10px">Welcome, <?= $_SESSION['fname'] ?> </span>
        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="Checkout.php">Check out</a></li>
            <li><a href="Checkin.php">Check in</a></li>
            <li><a href="Lend.php">Lend</a></li>
            <li class="active"><a href="Receive.php">Receive</a></li>
        </ul>
    </nav>

    <div id="content">

        <div class="row">
            <form action="lend-or-receive.php" method="post">
            <h6><b>Student Information</b></h6><br>
            <div class="input-field col s4">
                <input required id="StudName" type="text" class="validate" name="barcode" pattern="[A-Z0-9]{2,}">
                <label class="active center" for="StudName">Barcode</label>
            </div>
            <div class="col s4">
                <!--<a class="waves-effect waves-light btn active" style="margin-top: 11%" href="Acquisition_Print.html">Print</a>-->
                <button type="submit" class="waves-effect waves-light btn active" style="margin-top: 6%" type="submit" value="search" name="receiveButton">Receive</button>
            </div>
            </form>
        </div>
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