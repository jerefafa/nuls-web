<?php
include "startup.php";
require "connection.php";
$query = "SELECT * FROM `courses`";
$result = mysqli_query($conn, $query);

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    $stmt = $conn->query("SELECT * FROM `users` WHERE `user_id`= '".$user_id."' ");
    while ($row = $stmt->fetch_object()){
        $fname = $row->user_fname;
        $lname = $row->user_lname;
        $mname = $row->user_mname;
        $idnum = $row->id_number;
        $uname = $row->username;
        $password = $row->password;
        $utype = $row->user_type;
        $course_id = $row->course_id;
    }
}
else{
    header("location:Users.php");
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
            <li><a href="Assets.php">Subject</a></li>
            <li><a href="Supplier.php">Supplier</a></li>
            <li><a href="MaterialType.php">Material Type</a></li>
            <li><a href="Subtype.php">Subtype</a></li>
            <li><a href="Program.php">Colleges</a></li>
            <li><a href="Courses.php">Courses</a> </li>
            <li class="active"><a href="Users.php">Patrons</a></li>
        </ul>
    </nav>

    <div id="content">
        <div class="row">
            <form class="col s12"  method="post" action="user_update.php">
                <input required type="hidden" name="user_id" value="<?php echo $user_id ?>">
                <div class="input-field col s4">
                    <input id="firstname" type="text" class="validate"  value="<?php  echo $fname?>" name="fname" pattern="[A-Za-z\s]{2,}">
                    <label for="firstname">First Name</label>
                </div>

                <div class="input-field col s4">
                    <input id="middlename" type="text" class="validate"  value="<?php  echo $mname ?>" name="mname" pattern="[A-Za-z\s]{2,}">
                    <label for="middlename">Middle Name</label>
                </div>

                <div class="input-field col s4">
                    <input id="lastname" type="text" class="validate" value="<?php  echo $lname ?>" name="lname" pattern="[A-Za-z\s]{2,}">
                    <label for="lastname">Last Name</label>
                </div>

                <div class="input-field col s4">
                    <input id="idnum" type="text" class="validate"  value="<?php  echo $idnum ?>" name="idnum">
                    <label for="idnum">ID Number</label>
                </div>

                <div class="input-field col s4">
                    <input id="uname" type="email" class="validate"  value="<?php  echo $uname ?>" name="uname">
                    <label for="uname">Username</label>
                </div>

                <div class="col s3">
                    <p>
                        <input type="checkbox" class="filled-in" value="Edit" name="ePass"  id="ePass"/>
                        <label for="ePass">Edit Password</label>
                    </p>
                </div>

                <div class="input-field col s4">

                    <input id="password" type="password" class="validate"  disabled="disabled" name="password" value="<?php  echo $password ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must have at least 1 digit, 1 uppercase and 1 lowercase letter. 8 or more characters.">
                    <label for="password">New Password</label>
                </div>

                <div class="input-field col s4">
                    <select name="utype" >
                        <?php
                        if($utype == "student"){
                            ?>
                            <option value="Student" selected>Student</option>
                        <?php
                        }
                        else {
                            ?>
                            <option value="Student">Student</option>
                        <?php
                        }
                        if($utype == "Teaching"){
                            ?>
                            <option value="Teaching" selected>Teaching</option>
                            <?php
                        }
                        else {
                            ?>
                            <option value="Teaching">Teaching</option>
                            <?php
                        }
                        if($utype == "Non-Teaching"){
                            ?>
                            <option value="Non-Teaching" selected>Non-Teaching</option>
                            <?php
                        }
                        else {
                            ?>
                            <option value="Non-Teaching">Non-Teaching</option>
                            <?php
                        }
                        ?>
                    </select>
                    <label>User Type</label>
                </div>

                <div class="input-field col s4">
                    <select required  name="program">
                        <option value="" disabled selected>Course</option>
                        <?php while($row1 = mysqli_fetch_array($result)):;?>
                            <option value="<?php echo $row1[0];?>"<?php
                            if($row1[0] ==$course_id){
                                ?>
                                selected
                                <?php
                            }
                            ?>><?php echo $row1[2];?></option>
                        <?php endwhile;?>

                    </select>
                    <label>Course</label>
                </div>
                <div class="input-field col s4 left">
                    <input class="waves-effect waves-light btn active" style="margin-left: 5%; margin-bottom: 5%;  margin-top: 1% " href="Users.php" value="UPDATE" type="submit">
                    <a class="waves-effect waves-light btn active" style="margin-bottom: 5%; margin-left:3%;  margin-top: 1%" href="Users.php">Cancel</a>
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

    $(function(){
        $("#ePass").change(function () {
            var a = this.checked;
            if(a){
                $("#password").prop("disabled", false);
            }
            else{
                $("#password").prop("disabled", true);
            }

        });
    });
</script>
</html>