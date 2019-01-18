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
            <li><a href="Checkout.php">Check out</a></li>
            <li class="active"><a href="Checkin.php">Check in</a></li>
        </ul>
    </nav>

    <div id="content">
<form action="Checkin.php" method ="post">
        <div CLASS="row">
            <div class="col s12 m4 l3"></div>

            <div class="col s12 m8 l9">
                <div class="row">
                    <div class="col s12">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">search</i>
                            <input id="icon_prefix" type="text" class="validate" name = "booktitle" pattern="[a-zA-Z0-9#_.+&(),\-\s]*$  ">
                            <label for="icon_prefix">Find copy</label>
                        </div>

                        <div class="col s6" style="margin-top: 10px">
                            <button type = "submit" class = "waves-effect waves-light btn active" type = "submit" value = "search" name = "searchbtn">GO!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</form>
        <h6><b>Most Recently Checked In</b></h6>


        <table class="highlight grey lighten-2">
            <!--<thead>
            <tr>
                <th>Copyright</th>
                <th>Edition</th>
                <th>Format</th>
                <th>Content type term</th>
                <th>Media type term</th>
                <th>Carrier type term</th>
                <th>ISBN</th>
            </tr>
            </thead>-->

            <tbody>
            <?php
            $sql = "";
            if(isset($_POST["searchbtn"])){
                $title = $_POST["booktitle"];
                $sql="SELECT `acquisition`.`acquisition_number`,`acquisition`.`title`,`acquisition`.`author`,`catalog`.`barcode`,`users`.`user_id`,`users`.`user_fname`,`users`.`user_lname`,`users`.`user_mname`,`users`.`id_number`,`courses`.`course_id`,`courses`.`course`,`circulation`.`date_borrowed`,`circulation`.`date_returned` FROM `acquisition` INNER JOIN `catalog` INNER JOIN `circulation` INNER JOIN `users` INNER JOIN `courses` WHERE `acquisition`.`acquisition_number` = `catalog`.`acquisition_number` AND `catalog`.`barcode` = `circulation`.`barcode` AND `users`.`user_id` = `circulation`.`borrower_id` AND `courses`.`course_id` = `users`.`course_id` AND `acquisition`.`title` = '$title'";

            }
            else{
                $sql = "SELECT * FROM `circulation` INNER JOIN `users` ON `circulation`.`borrower_id` = `users`.`user_id` INNER JOIN `courses` ON `users`.`course_id` = `courses`.`course_id` INNER JOIN `programs` ON `courses`.`program_id` = `programs`.`program_id` INNER JOIN `catalog` ON `circulation`.`barcode` = `catalog`.`barcode` INNER JOIN `acquisition` ON `catalog`.`acquisition_number` = `acquisition`.`acquisition_number` WHERE `date_returned` = '" . date('Y-m-d') . "' OR `date_returned` = '" . date('Y-m-d', strtotime('-1 days')) . "' OR `date_returned` = '" . date('Y-m-d', strtotime('-3 days')) . "' OR `date_returned` = '" . date('Y-m-d', strtotime('-2 days')) . "'";

            }
            if($stmt = $conn->query($sql)){
            while ($row=$stmt->fetch_object()){
                echo"
                   <tr>
                    <td>
                        <b>".$row->title."</b> (Copy: ".$row->barcode.") <br>
                        <i>Checked out ".$row->date_borrowed."</i> to ".$row->user_lname.", ".$row->user_fname." ".$row->user_mname." (".$row->course." : ".$row->id_number.")<br>
                     
                    </td>
                    <td>
                        <b>Returned: </b> ".$row->date_returned."
                    </td>
                  
                </tr>";

            }}else{
               echo $conn->error;
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