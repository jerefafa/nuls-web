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
               <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

    </nav>
    <form method="post" name="f" action="UserManagement_Add.php">
    <div id="content">

        <div class="row">
            <div class="col s12">
                <h6><b>User Management</b></h6><br>

                <div class="input-field col s4">
                    <input required id="lname" type="text" class="validate" name="lname" pattern="[A-Za-z\s]{2,}">
                    <label class="active center" for="LastName">Last Name</label>
                </div>

                <div class="input-field col s4">
                    <input required id="mname" type="text" class="validate" name="mname" pattern="[A-Za-z\s]{2,}">
                    <label class="active center" for="MiddleName">Middle Name</label>
                </div>

                <div class="input-field col s4">
                    <input required id="fname" type="text" class="validate" name="fname" pattern="[A-Za-z\s]{2,}">
                    <label class="active center" for="FirstName">First Name</label>
                </div>

                <div class="col s3">
                    <select required class="browser-default" name="gender">
                        <option value="" disabled selected>Gender</option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                    </select>
                </div>

                <div class="input-field col s4">
                    <input required type="text" class="datepicker" id="date" name="birthdate" title="Must be at least 15 years old and above.">
                    <label class="active center" for="date">Birthdate</label>
                </div>

                <div class="input-field col s5">
                    <input required id="Email" type="text" class="validate" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                    <label class="active center" for="Email">Email</label>
                </div>

                <div class="input-field col s4">
                    <input required id="password" type="password" class="validate" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must have at least 1 digit, 1 uppercase and 1 lowercase letter. 8 or more characters.">
                    <label for="password">New Password</label>
                </div>

                <div class="input-field col s4">
                    <input required id="password2" type="password" class="validate" name="fpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must have at least 1 digit, 1 uppercase and 1 lowercase letter. 8 or more characters.">
                    <label for="password2">Confirm Password</label>
                </div>

                <div class="col s6">
                    <select required class="browser-default" name="position">
                        <option value="" disabled selected>Position</option>
                        <option value="Chief Librarian">Chief Librarian</option>
                        <option value="Reference Librarian">Reference Librarian</option>
                        <option value="Technical Librarian">Technical Librarian and Archivist</option>
                        <option value="Circulation Librarian">Circulation Librarian</option>
                        <option value="Librarian Assistant">Librarian Assistant</option>
                    </select>
                </div>

                <div class="col s4">


                        <p><b>User Access:</b></p>
                    <p>
                        <input type="checkbox" class="filled-in" value="Acquisition" name="access[]"  id="Chief-Librarian"/>
                        <label for="Chief-Librarian">Acquisition</label>
                    </p>
                    <p>
                        <input type="checkbox" class="filled-in" value="Catalog" id="Reference-Librarian" name="access[]"/>
                        <label for="Reference-Librarian">Catalog</label>
                    </p>
                    <p>
                        <input type="checkbox" class="filled-in" value="Circulation"  name="access[]"  id="Technical-Librarian-and-Archivist" />
                        <label for="Technical-Librarian-and-Archivist">Circulation</label>
                    </p>
                    <p>
                        <input type="checkbox" class="filled-in" value="Reports" name="access[]" id="Circulation-Librarian"  />
                        <label for="Circulation-Librarian">Reports</label>
                    </p>

                </div>

                <div class="right-align">
                    <input type="submit" class="waves-effect btn waves-light" style="margin-left:5%; margin-bottom: 5%; margin-top: 5%" href="UserManagementList.php" value="save" name="registerAdmin">
                    <a class="waves-effect waves-light btn active" style="margin-bottom: 5%; margin-left:3%;  margin-top: 5%" href="UserManagementList.php">Cancel</a>
                </div>
            </div>
        </div>

    </div>
    </form>
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
  /**  function check(){
        var check;
        //password checker
        var pwd1 = f.password.value;
        var pwd2 = f.fpassword.value;
        //var msg = (pwd1==pwd2)?"":"Password Mismatch";
        if(pwd1!=pwd2)
        alert("Passwword Mismatch");
        return check = true;
        ///age checkerS
        var bday = f.birthdate.value;
        var dob = new Date(bday);
        var today = new Date();
        var age = today.getTime() - dob.getTime();
        age = Math.floor(age / (1000 * 60 * 60 * 24 *365.25));
        if(age < 15)
        alert("Age Restriction. You're only " + age);
        return check = true;

        if(check = true)
            location.href='UserManagement.php';
        else
            alert("GO ");

    }**/

</script>
</html>