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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        function saveCirculation(title, formId) {
            swal({
                title: "Are you sure you want to update circulation #"+title+"?",
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
        function finePaid(title, formId) {
            console.log('test');
            swal({
                title: "Are you sure you want to clear this fine?",
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
        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

    </nav>

    <!--<div id="content">

        <h5>Casil, Dinaline Diaz (BSIT: 2015-102077)</h5><br>
        <div class="col s10 pull-s1 m6 pull-m4 l5 pull-l4">
        <div class="row">
                <div class="col s6">
                    <div class="col s12">
                        <label>Reason</label>
                        <select class="browser-default">
                            <option value="1">Overdue</option>
                        </select>
                    </div>

                    <div class="input-field col s6">
                        <input id="amount" type="number" class="validate">
                        <label for="amount">Amount</label>
                    </div>

                   

                    <div class="input-field col s12">
                        <i class="material-icons prefix">mode_edit</i>
                        <textarea id="icon_prefix2" class="materialize-textarea"></textarea>
                        <label for="icon_prefix2">Fine Note</label>
                    </div>
                </div>

                <div class="col s12 left-align">
                    <a class="waves-effect waves-light btn" href="ListOfCheckout.php">Save</a>
                    <a class="waves-effect waves-light btn" href="ListOfCheckout.php">Cancel</a>
                </div>

            </div>
        </div>

    </div>-->

    <div id="content">
        <table class="highlight">
            <thead>
                <tr>
                    <th>Circulation ID</th>
                    <th>Book Title</th>
                    <th>Amount</th>
                    <th>Note</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            $getID = $_GET["id"];
            if(isset($_GET["fines"])){
                    $stmt = $conn->query("SELECT `circulation`.`circulation_id` , `acquisition`.`title` , `fines`.`amount`, `fines`.`fine_id` , `fines`.`fine_note` FROM `circulation` INNER JOIN `fines` INNER JOIN `acquisition` INNER JOIN `catalog` WHERE `fines`.`is_paid` = false AND `circulation`.`borrower_id` = '$getID' AND `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` AND `catalog`.`barcode` = `circulation`.`barcode` AND `fines`.`circulation_id` =  `circulation`.`circulation_id`");
            }
            ?>
            <tbody>
            <?php
                while($row = $stmt->fetch_object()){
                    echo " <tr>
                    <td>$row->circulation_id</td>
                    <td>$row->title</td>
                    <td><input type='number' name='amount' value='$row->amount'></td>
                    <td>
                        <div class=\"input-field\">
                            <input id=\"note\" type=\"text\" name='notes' value='$row->fine_note' class=\"validate\">
                            <label for=\"note\">Note</label>
                        </div>
                    </td>

                    <td style='display: flex'>
                        <form action='update_fines.php' method='post' id='$row->circulation_id' style='margin-right: 3px'>
                        <input type='hidden' value='$row->circulation_id' name='id'>
                        <input type='hidden' value='$row->amount' name='amount'>
                        <input type='hidden' value='$row->fine_note' name='note'>
                        <input type='hidden' name='save' value='1'>
                        <button onclick='saveCirculation(`".$row->circulation_id."`,".$row->circulation_id.")' type='button' class=\"waves-effect waves-light btn\" href=\"#\" style=\" margin-left: 8%\" name='save'>Save</button>
                        </form>
                        <form action='update_fines.php' method='post' id='".$row->circulation_id."paid'>
                        <input type='hidden' value='$row->circulation_id' name='id'>
                        <input type='hidden' value='1' name='paid'>
                        <button type='button' onclick='finePaid(`".$row->circulation_id."`,`".$row->circulation_id."paid`)' class=\"waves-effect waves-light btn\" href=\"#\" style=\" margin-left: 8%\" name='paid'>Paid</button>
                        </form>
                    </td>
                </tr>   
                    ";
                }
                ?>

            </tbody>
        </table>

        <div class="right-align">
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