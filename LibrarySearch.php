<?php
include "startup.php";
if(!isset($_GET["title"])){
    header("location:Catalog.php");
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
        <?php
        include "nav.php";
        ?>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li class="active"><a href="Catalog.php">Library Search</a></li>

        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

    </nav>

    <div id="content">

        <h6><b>Search for (library). Searched in: National University Learning Resource Center</b></h6>
        <?php
        $stmt = $conn->query("SELECT `acquisition_number`,`title`,`author`,`edition`,`copyright_date` FROM `acquisition` WHERE `title` LIKE '%".$_GET["title"]."%' OR `author` LIKE '%".$_GET["title"]."%'");

        ?>
        <table class="highlight grey lighten-2">
            <thead>
            <tr>
                <th>Titles: <?php echo mysqli_num_rows($stmt)?></th>
                <th>
                    <select class="browser-default">
                        <option value="" disabled selected>Sort by:</option>
                        <option value="1">Relevance</option>
                    </select>
                </th>
            </tr>
            </thead>

            <tbody>
            <?php
            $getSearch = $_GET["title"];
            if(!preg_match("/^[a-zA-Z0-9#_.+&(),\-\s]*$/", $getSearch)){
                ?>
                <script>
                    alert('Please Check Your Input | Only Allows Alphanumeric & Special Characters (e.g #,_, +, &, .)');
                    location.href="Catalog.php";
                </script>
                <?php
            }
            else {
                while ($row = $stmt->fetch_object()) {
                    echo "<tr><td colspan='2'>
                    <a href='SearchDetails.php?acquisition_number=" . $row->acquisition_number . "'><b>" . $row->title . "</b></a><br>
                    Author : " . $row->author . "<br>
                    Edition : " . $row->edition . "<br>
                    Copyright Date: " . date_format(date_create($row->copyright_date), 'd M, Y') . "<br>
                    
                    
                </td></tr>";
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