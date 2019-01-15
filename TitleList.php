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
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li class="active"><a href="Catalog.php">Library Search</a></li>
            <li class=""><a href="SearchTitle.php">Add Title</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

    </nav>

    <div id="content">

        <p>
        <h6 class="right-align blue-text"><a href="AddTitle.php">Add Title</a></h6>
            <b>Books with the Title "psychology"</b>
        </p>


        <table class="highlight grey lighten-2">
            <thead>
            <tr>
                <th>Titles: 1 - 25 of 165</th>
                <th>
                    <select class="browser-default">
                        <option value="" disabled selected>Sort by:</option>
                        <option value="1">Relevance</option>
                    </select>
                </th>
                <th class="blue-text right-align">1 2 3 4 15 [Show All]</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>
                    <a href="TitleDetails.php"><b>Abnormal child psychology</b></a> <br>
                    Mash, Eric J. ISBN: 978-1-30510542-3 <br>
                    Cengage Learning, 2016. Sixth Edition. xxiii 628 pages
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <b>Abnormal psychology</b> <br>
                    Beltran, Jane O. ISBN: 978-9-71235072-6 <br>
                    Rex: Books Store, 2008. xvi, 205 p.
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <b>Abnormal psychology</b> <br>
                    Butcher, Jamies N. ISBN: 978-9-81464829-5 <br>
                    Pearson Education South Asia Pte Ltd, 2015. 784 pages
                </td>
                <td></td>
                <td></td>
            </tr>


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