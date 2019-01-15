<?php
include "startup.php";
if(!isset($_GET["addCopy"])){
    header("location:Catalog.php");
}
else{
    $stmt = $conn->query("SELECT `quantity`,`title` FROM `acquisition` WHERE `acquisition_number`='".$_GET["acquisition_number"]."'");
    $stmt2 = $conn->query("SELECT * FROM `catalog` WHERE `acquisition_number`='".$_GET["acquisition_number"]."' AND `date_deleted` IS NULL");
    while ($row=$stmt->fetch_object()){
        if($row->quantity<=mysqli_num_rows($stmt2)){
            echo"<script>
                alert('All the copies were cataloged');
                window.history.back();
                </script>";
        }
        else{
            $title = $row->title;
            $acquisition_number = $_GET["acquisition_number"];
        }
    }
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
        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="Catalog.php">Library Search</a></li>
        </ul>
    </nav>

    <div id="content">

        <div class="row">
            <form class="col s12" action="AddCopyCatalog.php" method="post">

                <h6><b>Title Information</b></h6>

                <div class="row">
                    <div class="input-field col s3">
                        <input type="hidden" name="acquisition_number" value="<?php echo $acquisition_number?>">
                        <input id="leading_article" type="text" class="validate" name="leading_article">
                        <label for="leading_article">Leading Article</label>
                    </div>
                    <div class="input-field col s9">
                        <input disabled value="<?php echo $title?>" id="title" type="text" class="validate">
                        <label for="title">Title</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="subtitle" type="text" class="validate" name="subtitle">
                        <label for="subtitle">Subtitle</label>
                    </div>
                </div>

                <h6><b>Standard Numbers</b></h6>
                <div class="row">
                    <div class="input-field col s4">
                        <input id="LCCN" type="text" class="validate" name="lccn">
                        <label for="LCCN">LCCN</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="ISBN" type="text" class="validate" name="isbn">
                        <label for="ISBN">ISBN</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="ISSN" type="text" class="validate" name="issn">
                        <label for="ISSN">ISSN</label>
                    </div>
                    <div class="col s4">
                        <p>
                            <input name="assign" type="checkbox" id="bc1">
                            <label for="bc1">Assign to next barcode</label>
                        </p>
                    </div>

                    <div class="col s4">
                        <p>
                            <input type="text" name="barcode" placeholder="Input Barcode" id="barcode">

                        </p>
                    </div>
                    <div class="input-field  col s4">

                            <input type="text" name="call_number" id="callnumber">
                             <label for="callnumber">Call Number</label>

                    </div>
                </div>

                <div class="row">
                    <div class="col s6">
                        <label>Material Type</label>
                        <select name="material_type">
                            <?php
                            $stmt = $conn->query("SELECT * FROM `material_types` WHERE `date_deleted` IS NULL");
                            while ($row=$stmt->fetch_object()){

                                    echo "<option value='" . $row->material_type_id . "'>" . $row->material_type . "</option>";

                            }

                            ?>
                        </select>
                    </div>
                    <div class="col s6">
                        <label>Subtype</label>
                        <select name="subtype">
                            <option selected  value="">None</option>
                            <?php
                            $stmt = $conn->query("SELECT * FROM `subtypes` WHERE `date_deleted` IS NULL");
                            while ($row=$stmt->fetch_object()){
                                if ($subtype==$row->subtype_id){
                                    echo "<option value='".$row->subtype_id."' selected>".$row->subtype."</option>";
                                }
                                else {
                                    echo "<option value='".$row->subtype_id."'>".$row->subtype."</option>";
                                }

                            }

                            ?>
                        </select>
                    </div>
                </div>



                <h6><b>Publication Information</b></h6>
                <div class="row">
                    <div class="input-field col s4">
                        <input id="place" type="text" class="validate" name="publication_place">
                        <label for="place">Place</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="publisher" type="text" class="validate" name="publisher">
                        <label for="publisher">Publisher</label>
                    </div>
                    <div class="input-field col s4">
                        <input  id="dates" type="text" class="datepicker" name="publication_date">
                        <label for="dates">Date</label>
                    </div>
                </div>

                <h6><b>Physical Description</b></h6>
                <div class="row">
                    <div class="input-field col s4">
                        <input id="extent" type="text" class="validate" name="extent">
                        <label for="extent">Extent</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="details" type="text" class="validate" name="other_details">
                        <label for="Details">Other Details</label>
                    </div>
                    <div class="input-field col s4">
                        <input  id="size" type="text" class="validate" name="size">
                        <label for="size">Size</label>
                    </div>
                </div>

                <div class="right-align">
                    <input type="submit" value="Add Copy" class="btn" name="add_copy">
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
    $('#bc1').change(function () {
        if(this.checked ==true ) {
            $('#barcode').val('');
            $('#barcode').attr("disabled", "disabled");
        }else {
            $('#barcode').removeAttr("disabled");
        }
    });
</script>
</html>