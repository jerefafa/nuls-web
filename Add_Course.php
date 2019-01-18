

<?php
include "startup.php";
$query = "SELECT * FROM `programs`";
$result = mysqli_query($conn, $query);

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
            <li><a href="Assets.php">Subject</a></li>
            <li><a href="Supplier.php">Supplier</a></li>
            <li><a href="MaterialType.php">Material Type</a></li>
            <li><a href="Subtype.php">Subtype</a></li>
            <li><a href="Program.php">Colleges</a></li>
            <li class="active"><a href="Courses.php">Programs</a> </li>
            <li><a href="Users.php">Patrons</a></li>
        </ul>
    </nav>

    <div id="content">
        <div class="row">
            <form class="col s12" method="post" action="course_add.php">
                <div class="input-field col s4">
                    <input id="course" type="text" name="course" class="validate"">
                    <label for="course">Course</label>
                </div>

                <div class="input-field col s4">
                    <select required  name="program">
                        <option value="" disabled selected>Program</option>
                        <?php while($row1 = mysqli_fetch_array($result)):;?>
                            <option value="<?php echo $row1[0];?>"><?php echo $row1[1];?></option>
                        <?php endwhile;?>

                    </select>
                </div>

                <div class="col s4" >
                    <input type="submit" class="waves-effect btn waves-light" style="margin-left:5%; margin-bottom: 5%; margin-top: 5%" href="Assets.php" value="save" name="asubject">
                    <a class="waves-effect waves-light btn active" style="margin-bottom: 5%; margin-left:3%;  margin-top: 5%" href="Assets.php">Cancel</a>
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
</script>
</html>