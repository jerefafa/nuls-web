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
            <li class=""><a href="Catalog.php">Library Search</a></li>
            <li class="active"><a href="SearchTitle.php">Add Title</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

    </nav>

    <div id="content">

        <h5><b>Abnormal child psychology / [Book / Hardcover]</b></h5>
        <h6>Mash, Eric J.</h6><hr>
        <h6>RJ499 .M296 2016</h6>
        <h6 class="right-align blue-text">
        <a href="Edit_Title.php"> <u>Add Details</u> </a> <a> <u>Delete Title</u> </a>
        </h6>
        <!--<div class="row">
            <div class="col s4">
                <a class="waves-effect waves-light btn"><i class="material-icons left">cloud</i>button</a>
            </div>
            <div class="col s4">
                <a class="waves-effect waves-light btn"><i class="material-icons left">cloud</i>button</a>
            </div>
            <div class="col s4">
                <a class="waves-effect waves-light btn"><i class="material-icons left">cloud</i>button</a>
            </div>
        </div>-->

        <h6><b>Publication Info</b></h6>
        <table class="highlight grey lighten-2">
            <thead>
            <tr>
                <th>Copyright</th>
                <th>Edition</th>
                <th>Format</th>
                <th>Content type term</th>
                <th>Media type term</th>
                <th>Carrier type term</th>
                <th>ISBN</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>Australia: Cengage Learning, 2016</td>
                <td>Sixth Edition</td>
                <td>xxiii, 628 pages; 28 centimeters</td>
                <td>text</td>
                <td>unmediated</td>
                <td>volume</td>
                <td>978-1-30510542-3</td>
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