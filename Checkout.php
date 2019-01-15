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
            <li class="active"><a href="Checkout.php">Check out</a></li>
            <li><a href="Checkin.php">Check in</a></li>
        </ul>
    </nav>

    <div id="content">
        <?php
        include "nav.php";
        ?>
        <form action="ListOfCheckout.php" method="get">
        <div class="row">
            <div class="col s12 m4 l3"></div>

            <div class="col s12 m8 l9">

                <div class="row">
                    <div class="col s12">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">search</i>
                            <input id="icon_prefix" type="text" class="validate" name="find">
                            <label for="icon_prefix">Find</label>
                        </div>

                        <div class="col s6" style="margin-top: 10px">
                            <input type="submit" class="waves-effect waves-light btn" style="margin-top: 1%" value="GO!" name="go">
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="col s4" style="margin-left: 100px">
                            <select class="browser-default" name="findwhat">
                                <option value="1">Patron's Name</option>
                                <option value="2">Book Title</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>
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