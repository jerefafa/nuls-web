<?php
include "startup.php";
if(!isset($_GET["catalog_id"])){
    header("location:Catalog.php");
}
else{
    $stmt = $conn->query("SELECT * FROM `catalog` INNER JOIN `acquisition` WHERE `catalog_id` = '".$_GET["catalog_id"]."' AND `acquisition`.`acquisition_number` = `catalog`.`acquisition_number`");
    while ($row=$stmt->fetch_object()){
       $title = $row->title;
       $subtitle = $row->subtitle;
       $lccn = $row->lccn;
       $isbn = $row->isbn;
       $issn = $row->issn;
       $leading_article=$row->leading_article;
       $call_number = $row->call_number;
       $barcode = $row->barcode;
       $material_type = $row->material_type_id;
       $subtype = $row->subtype_id;
       $publication_place = $row->publication_place;
       $publisher = $row->publisher;
       $publication_date = date_format(date_create($row->publication_date),'d M, Y');
       $extent = $row->extent;
       $other_details = $row->other_details;
       $size = $row->size;
       $catalog_id = $row->catalog_id;
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
        <span style="color: whitesmoke; margin-left: 10px">Welcome, <?= $_SESSION['fname'] ?> </span>
        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="Catalog.php">Library Search</a></li>
        </ul>
    </nav>

    <div id="content">

        <div class="row">
            <form class="col s12" action="UpdateCatalog.php" method="post">

                <h6><b>Title Information</b></h6>

                <div class="row">
                    <div class="input-field col s3">
                        <input  value="<?php echo $leading_article?>" id="leading_article" name="leading_article" type="text" class="validate">
                        <label for="leading_article">Leading Article</label>
                    </div>
                    <div class="input-field col s9">
                        <input type="hidden" name="catalog_id" value="<?php echo $catalog_id ?>">
                        <input disabled value="<?php echo $title?>" id="title" type="text" class="validate">
                        <label for="title">Title</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="subtitle" type="text" class="validate" value="<?php echo $subtitle ?>" name="subtitle">
                        <label for="subtitle">Subtitle</label>
                    </div>
                </div>

                <h6><b>Standard Numbers</b></h6>
                <div class="row">
                    <div class="input-field col s4">
                        <input id="LCCN" type="text" class="validate" value="<?php echo $lccn ?>" name="lccn">
                        <label for="LCCN">LCCN</label>
                    </div>
                    <div class="input-field col s4">
                        <input value="<?php echo $isbn ?>" id="ISBN" type="text" class="validate" name="isbn">
                        <label for="ISBN">ISBN</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="ISSN" type="text" class="validate" value="<?php echo $issn?>" name="issn">
                        <label for="ISSN">ISSN</label>
                    </div>


                </div>
                <div class="row">

                    <div class="input-field col s4">

                            <input type="text" name="barcode" id="barcode" class="validate" value="<?php echo $barcode ?>">
                            <label for="barcode">Barcode</label>

                    </div>

                    <div class="input-field col s4">
                        <input id="callnumber" type="text" class="validate" value="<?php echo $call_number ?>" name="callnumber">
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
                            if ($material_type==$row->material_type_id){
                                echo "<option value='".$row->material_type_id."' selected>".$row->material_type."</option>";
                            }
                            else {
                                echo "<option value='" . $row->material_type_id . "'>" . $row->material_type . "</option>";
                            }
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
                        <input id="place" type="text" class="validate" value="<?php echo $publication_place?>" name="publication_place">
                        <label for="place">Place</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="publisher" type="text" class="validate" value="<?php echo $publisher ?>" name="publisher">
                        <label for="publisher">Publisher</label>
                    </div>
                    <div class="input-field col s4">
                        <input value="<?php echo $publication_date?>" id="dates" type="text" class="datepicker" name="publication_date">
                        <label for="dates">Date</label>
                    </div>
                </div>

                <h6><b>Physical Description</b></h6>
                <div class="row">
                    <div class="input-field col s4">
                        <input id="extent" type="text" class="validate" value="<?php echo $extent?>" name="extent">
                        <label for="extent">Extent</label>
                    </div>
                    <div class="input-field col s4">
                        <input value="<?php echo $other_details ?>" id="details" type="text" class="validate" name="other_details">
                        <label for="Details">Other Details</label>
                    </div>
                    <div class="input-field col s4">
                        <input value="<?php echo $size?>" id="size" type="text" class="validate" name="size">
                        <label for="size">Size</label>
                    </div>
                </div>

                <div class="right-align">
                    <input class="waves-effect waves-light btn" value="Update Copy" type="submit" name="UpdateCopy">
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
            $('#barcode').attr("disabled", "disabled");
        }else {
            $('#barcode').removeAttr("disabled");
        }
    });
</script>
</html>