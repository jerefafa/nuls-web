<?php
include "startup.php";
if(!isset($_GET["acquisition_number"])){
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        function showPrompt(title, formId) {
            swal({
                title: "Are you sure you want to delete "+title+"?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                showCancelButton: true
            }, function (isDelete) {
                if(isDelete) {
                    console.log(formId);
                    var form = document.getElementById(formId);
                    form.submit();
                }
            });
        }
    </script>
    <title>NULRC</title>
</head>
<body>

<div id="container">
    <nav class="nav-background">
        <?php
        include "nav.php";
        ?>
        <span style="color: whitesmoke; margin-left: 10px">Welcome, <?= $_SESSION['fname'] ?> </span>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li class="active"><a href="Catalog.php">Library Search</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

    </nav>

    <div id="content">
        <?php
        error_reporting(0);
        $stmt = $conn->query("SELECT `title`,`author` FROM `acquisition` WHERE `acquisition_number`='".$_GET["acquisition_number"]."'");
        while ($row=$stmt->fetch_object()){
            echo "<h5><b>".$row->title."</b></h5>
        <h6>edited by ".$row->author."</h6><hr>
        <h6>Copies at National University Learning Resource Center</h6>";
        }
        ?>

        <table class="highlight grey lighten-2">
            <thead>

            <tr>
                <th>Call #</th>
                <th>Barcode</th>
                <th>Status</th>
                <th>Description</th>

                <th>Action</th>
            </tr>
            </thead>
            <?php
            $stmt = $conn->query("SELECT `catalog_id`,`call_number`,`barcode`,`is_borrowed`,`remarks`,`is_missing`,`other_details` FROM `catalog` WHERE `acquisition_number`='".$_GET["acquisition_number"]."' AND `date_deleted` IS NULL");
            while ($row=$stmt->fetch_object()){
                $status;
                if($row->is_missing==1){
                    $status="Missing";
                }
                elseif ($row->is_borrowed==1){
                    $status="Borrowed";
                }
                elseif($row->remarks==null){
                    $status ="Available";
                }
                else{
                    $status = $row->remarks;
                }
                echo "<tr>
                <td>".$row->call_number."</td>
                <td>".$row->barcode."</td>
                <td>".$status."</td>
                <td>".$row->other_details."</td>
                 <td style=\"display: flex\">
                    <form action='Edit_Title.php' method='get'>
                    <input type='hidden' name='catalog_id' value='".$row->catalog_id."'>
                    <input type=\"submit\" value=\"edit\" class=\"material-icons btn-floating\" style=\"border:0px;color:white;margin-right: 5px;\">
                    </form>
                    <form action='DeleteCatalog.php' method='post' id='$row->catalog_id'>
                     <input type='hidden' name='catalog_id' value='".$row->catalog_id."'>
                        <button onclick='showPrompt(`$row->barcode`,`$row->catalog_id`)' type=\"button\" value=\"delete\" class=\"material-icons btn-floating\" style=\"border:0px;color:white\">delete</button>
                    </form>
                    </td>
            </tr>";
            }
            ?>

        </table>

    </div>
    <div class="row">
        <form action="AddTitle.php" method="GET">
        <div class="col s12" style="display: flex">
            <input type="hidden" name="acquisition_number" value="<?php echo $_GET["acquisition_number"]?>">
            <input class="btn" value="ADD COPY" type="submit" name="addCopy">
            </form>
<!--            <form action="AddTopics.php">-->
<!--                <input type="hidden" name="acquisition_number" value="--><?php //echo $_GET["acquisition_number"]?><!--">-->
<!--            <input class="btn" value="ADD TOPICS" type="submit" style="margin-left: 5px;">-->
<!--            </form>-->
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