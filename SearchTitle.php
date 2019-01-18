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
            <li class=""><a href="Catalog.php">Library Search</a></li>
            <li class="active"><a href="SearchTitle.php">Add Title</a></li>
        </ul>
    </nav>
    <div id="content" class="white">

        <div class="valign-wrapper row ">
            <div class="col s10 pull-s1 m6 pull-m3 12 pull-l4">
                <div class="input-field col s12">

                    <div class="col s6">
                        <select class="browser-default">
                            <option value="" disabled selected>Find</option>
                            <option value="1">Any Type</option>
                            <option value="2">Artifact</option>
                            <option value="3">Books</option>
                            <option value="4">Computer Files</option>
                            <option value="5">Electronic Books</option>
                            <option value="6">Equipments</option>
                            <option value="7">Kits</option>
                            <option value="8">Manuscripts</option>
                            <option value="9">Maps, Globes, Atlases</option>
                            <option value="10">Mixed Materials</option>
                            <option value="11">Music (printed)</option>
                            <option value="12">Pictures</option>
                            <option value="13">Recording (musical)</option>
                            <option value="14">Recording (nonmusical)</option>
                            <option value="15">Serials</option>
                            <option value="16">Videos</option>
                        </select>
                    </div>
                    <div class="col s6">
                        <select class="browser-default">
                            <option value="" disabled selected>with</option>
                            <option value="1">Title</option>
                            <option value="2">Author</option>
                            <option value="3">Subject</option>
                            <option value="1">LCCN</option>
                            <option value="2">ISBN</option>
                            <option value="3">ISSN</option>
                        </select>
                    </div>

                    <div class="input-field col s8">
                        <input id="title" placeholder="Book Title" type="text" class="validate">
                    </div>

                    <div class="col s4" style="margin-top: 13px">
                        <a class="waves-effect waves-light btn" href="TitleList.php">Search</a>
                    </div>

                </div>


            </div>
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