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

        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="Assets.php">Subject</a></li>
            <li class="active"><a href="Supplier.php">Supplier</a></li>
            <li><a href="MaterialType.php">Material Type</a></li>
            <li><a href="Subtype.php">Subtype</a></li>
            <li><a href="Program.php">Colleges</a></li>
            <li><a href="Courses.php">Courses</a> </li>
            <li><a href="Users.php">Patrons</a></li>
        </ul>
    </nav>

    <div id="content">
        <div class="row">
            <form class="col s12" method="post" action="supplier_add.php">
                <div class="input-field col s3">
                    <input id="supplier_name" type="text" class="validate" name="sname" pattern="[A-Za-z\s]{2,}">
                    <label for="supplier_name">Supplier Name</label>
                </div>

                <div class="input-field col s3">
                    <input id="contact_number" type="text" class="validate" name="number" pattern="[0-9]{5,}" title="This only accepts numeric value">
                    <label for="contact_number">Contact Number</label>
                </div>

                <div class="input-field col s3">
                    <input id="contact_person" type="text" class="validate" name="person" pattern="[A-Za-z\s]{2,}">
                    <label for="contact_person">Contact Person</label>
                </div>

                <div class="col s3" >
                    <button class="waves-effect waves-light btn" value="save" style="margin-top: 5%; margin-left: 5%" name="nSupplier">Save</button>
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