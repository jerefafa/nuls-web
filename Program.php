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

        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="Assets.php">Subject</a></li>
            <li><a href="Supplier.php">Supplier</a></li>
            <li><a href="MaterialType.php">Material Type</a></li>
            <li><a href="Subtype.php">Subtype</a></li>
            <li class="active"><a href="Program.php">Colleges</a></li>
            <li><a href="Courses.php">Courses</a> </li>
            <li><a href="Users.php">Patrons</a></li>
        </ul>
    </nav>

    <div id="content">

        <div class="fixed-action-btn horizontal click-to-toggle">
            <a class="btn-floating btn-large red" href="Add_Program.php">
                <i class="material-icons">add</i>
            </a>
        </div>

        <table class="highlight">
            <thead>
            <tr>
                <th>Colleges</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require "connection.php";
            $stmt  = $conn->query("SELECT * FROM programs WHERE `date_deleted` IS NULL");
            $ctr = mysqli_num_rows($stmt);
            $page = $ctr/10;
            $page = ceil($page);
            for($b=1; $b<=$page; $b++){
                ?> <a href="Program.php?page=<?php echo $b;?>"><?php echo $b.' '?></a>  <?php
            }
            $a = 1;
            if(isset($_GET["page"])) {
                $a = $_GET["page"];
            };
            if($a =="" || $a == "1") {
                $page1=0;
            }
            else {
                $page1=($a*10)-10;
            }

            $stmt2  = $conn->query("SELECT * FROM programs WHERE `date_deleted` IS NULL LIMIT $page1,10");

            while ($row = $stmt2->fetch_object()){
                echo "<tr><td>".$row->program." </td> <td style='display: flex'><form action='Update_Program.php' method='get'><input type='hidden' value='".$row->program_id. "' name='program_id'>
        <input class='btn-floating material-icons' type='submit' value='edit' style='border: 0px;color: #e4ffda;font-size: x-large;margin-right:25px'></form>
        <form action='program_delete.php' method='post' id='$row->program_id'><button onclick='showPrompt(`".$row->program."`,`".$row->program_id."`)' class='btn-floating material-icons' type='button' value='delete' style='border: 0px;color: white;font-size: x-large;'>delete</button><input type='hidden' name='program_id' value='".$row->program_id."'></form></td></tr>";
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
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: false // Close upon selecting a date,
    });
</script>
</html>