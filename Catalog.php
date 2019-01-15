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
        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li class="active"><a href="Catalog.php">Library Search</a></li>

        </ul>
    </nav>
    <div id="content">
        <?php
        include "nav.php";
        ?>
        <form action="LibrarySearch.php" method="get">
        <div class="valign-wrapper row">

            <div class="col s10 pull-s1 m6 pull-m3 l6 pull-l4">
                <div class="input-field col s12 white">
                    <input id="search" placeholder="Search" type="text" class="validate" name="title">
                    <input type="submit" class="suffix btn darken-2"  style="border:0px;color:white;font-size:medium;float: right" value="search" name="submit">


                </div>
                <div class="col s12">
                    <ul class="collapsible white" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header black-text">Narrow your search to...
                                <i class="material-icons right-align">arrow_drop_down</i>
                            </div>
                            <div class="collapsible-body">
                                    <span>
                                        <select>
                                          <option value="" disabled selected>Location:</option>
                                          <option value="1">National University Learning Resource Center</option>
                                        </select>

                                        <select>
                                          <option value="" disabled selected>Material Type:</option>
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

                                        <h6>Reading Level:</h6>
                                        <input id="readinglevel_From" type="text" class="validate" placeholder="From" style="width: 47%">
                                        to
                                        <input id="readinglevel_To" type="text" class="validate" style="width: 47%">

                                        <h6>Interest Level:</h6>
                                         <select>
                                          <option value="1">Unlimited</option>
                                          <option value="2">Preschool</option>
                                          <option value="3">K</option>
                                          <option value="4">1</option>
                                          <option value="5">2</option>
                                          <option value="6">3</option>
                                          <option value="7">4</option>
                                          <option value="8">5</option>
                                          <option value="9">6</option>
                                          <option value="10">7</option>
                                          <option value="11">8</option>
                                          <option value="12">9</option>
                                          <option value="13">10</option>
                                          <option value="14">11</option>
                                          <option value="15">12</option>
                                          <option value="16">Young Adult</option>
                                          <option value="16">Adult</option>
                                          <option value="16">Professional</option>
                                        </select>
                                        to
                                         <select>
                                          <option value="" disabled selected>Material Type:</option>
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
                                    </span>
                            </div>
                        </li>

                    </ul>
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