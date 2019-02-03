<?php
include "startup.php";
if(isset($_GET['librarian_id'])){
    $librarian_id = $_GET['librarian_id'];
    $stmt = $conn->query("SELECT * FROM `librarians` WHERE `librarian_id`= '".$librarian_id."' ");
    while ($row = $stmt->fetch_object()){
        $fname = $row->fname;
        $lname = $row->lname;
        $mname = $row->mname;
        $bdate = $row->birthdate;
        $email = $row->email;
        $password = $row->password;
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

    </nav>

    <div id="content">

        <div class="row">
            <div class="col s12">
                <form method="post" action="update_user.php">
                <h6><b>User Information</b></h6><br>
                <input required type="hidden" name="librarian_id" value="<?php echo $librarian_id ?>">
                <div class="input-field col s4">
                    <input required id="LastName" type="text" class="validate" name="lname" value="<?php echo $lname ?>" pattern="[A-Za-z\s]{2,}">
                    <label class="active center" for="LastName">Last Name</label>
                </div>

                <div class="input-field col s4">
                    <input id="MiddleName" type="text" class="validate" name="mname" value="<?php echo $mname ?>" pattern="[A-Za-z\s]{2,}">
                    <label class="active center" for="MiddleName">Middle Name</label>
                </div>

                <div class="input-field col s4">
                    <input required id="FirstName" type="text" class="validate" name="fname" value="<?php echo $fname ?>" pattern="[A-Za-z\s]{2,}">
                    <label class="active center" for="FirstName">First Name</label>
                </div>

                <div class="col s6">
                    <select required class="browser-default" required name="gender">
                        <option value="Female"  <?php
                        $sql = $conn->query("SELECT `gender` FROM `librarians` WHERE   `librarian_id` = '".$_GET["librarian_id"]."'");
                        while ($row = $sql->fetch_object()) {
                            if($row->gender == "Female") {
                                echo "selected";
                            }
                        }
                        ?>>Female</option>
                        <option value="Male" <?php
                        $sql = $conn->query("SELECT `gender` FROM `librarians` WHERE   `librarian_id` = '".$_GET["librarian_id"]."'");
                        while ($row = $sql->fetch_object()) {
                            if($row->gender == "Male") {
                                echo "selected";
                            }
                        }
                        ?>>Male</option>
                    </select>
                </div>

                <div class="input-field col s6">
                    <input required type="text" class="datepicker" id="date" name="bdate" value="<?php echo $bdate ?>" title="Must be at least 15 years old and above.">
                    <label class="active center" for="date">Birthdate</label>
                </div>

                <div class="col s6">
                    <select class="browser-default" name="position">
                        <option value="" disabled selected>Position</option>
                        <option value="Chief Librarian"  <?php
                        $sql = $conn->query("SELECT `position` FROM `librarians` WHERE   `librarian_id` = '".$_GET["librarian_id"]."'");
                        while ($row = $sql->fetch_object()) {
                            if($row->position == "Chief Librarian") {
                                echo "selected";
                            }
                        }
                        ?>>Chief Librarian</option>
                        <option value="Reference Librarian"  <?php
                        $sql = $conn->query("SELECT `position` FROM `librarians` WHERE   `librarian_id` = '".$_GET["librarian_id"]."'");
                        while ($row = $sql->fetch_object()) {
                            if($row->position == "Reference Librarian") {
                                echo "selected";
                            }
                        }
                        ?>>Reference Librarian</option>
                        <option value="Technical Librarian and Archivist"  <?php
                        $sql = $conn->query("SELECT `position` FROM `librarians` WHERE   `librarian_id` = '".$_GET["librarian_id"]."'");
                        while ($row = $sql->fetch_object()) {
                            if($row->position == "Technical Librarian and Archivist") {
                                echo "selected";
                            }
                        }
                        ?>
                        >Technical Librarian and Archivist</option>
                        <option value="Graduate School Librarian"  <?php
                        $sql = $conn->query("SELECT `position` FROM `librarians` WHERE   `librarian_id` = '".$_GET["librarian_id"]."'");
                        while ($row = $sql->fetch_object()) {
                            if($row->position == "Graduate School Librarian") {
                                echo "selected";
                            }
                        }
                        ?>>Graduate School Librarian</option>
                        <option value="Librarian Assistant"  <?php
                        $sql = $conn->query("SELECT `position` FROM `librarians` WHERE   `librarian_id` = '".$_GET["librarian_id"]."'");
                        while ($row = $sql->fetch_object()) {
                            if($row->position == "Librarian Assistant") {
                                echo "selected";
                            }
                        }
                        ?>>Librarian Assistant</option>
                    </select>
                </div>

                <div class="input-field col s6">
                    <input required id="Email" type="text" class="validate" name="email" value="<?php  echo $email ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                    <label class="active center" for="Email" >Email</label>
                </div>

                    <div class="col s3">
                        <p>
                            <input type="checkbox" class="filled-in" value="Edit" name="ePass"  id="ePass"/>
                            <label for="ePass">Edit Password</label>
                        </p>
                    </div>

                <div class="input-field col s4">

                    <input id="password" type="password" class="validate"  disabled="disabled" name="password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must have at least 1 digit, 1 uppercase and 1 lowercase letter. 8 or more characters.">
                    <label for="password">New Password</label>
                </div>

                <div class="col s4">
                        <p><b>User Access:</b></p>
                        <p>
                            <input type="checkbox" class="filled-in" value="Acquisition" name="access[]"  id="Chief-Librarian"  <?php
                            $sql = $conn->query("SELECT * FROM `access_levels` WHERE   `librarian_id` = '".$_GET["librarian_id"]."'");
                            while ($row = $sql->fetch_object()) {
                                if($row->access_level == "Acquisition") {
                                    echo "checked";
                                }
                            }
                            ?>/>
                            <label for="Chief-Librarian">Acquisition</label>
                        </p>
                        <p>
                            <input type="checkbox" class="filled-in" value="Catalog" id="Reference-Librarian" name="access[]"  <?php
                            $sql = $conn->query("SELECT * FROM `access_levels` WHERE   `librarian_id` = '".$_GET["librarian_id"]."'");
                            while ($row = $sql->fetch_object()) {
                                if($row->access_level == "Catalog") {
                                    echo "checked";
                                }
                            }
                            ?>/>
                            <label for="Reference-Librarian">Catalog</label>
                        </p>
                        <p>
                            <input type="checkbox" class="filled-in" value="Circulation"  name="access[]"  id="Technical-Librarian-and-Archivist"  <?php
                            $sql = $conn->query("SELECT * FROM `access_levels` WHERE   `librarian_id` = '".$_GET["librarian_id"]."'");
                            while ($row = $sql->fetch_object()) {
                                if($row->access_level == "Circulation") {
                                    echo "checked";
                                }
                            }
                            ?>/>
                            <label for="Technical-Librarian-and-Archivist">Circulation</label>
                        </p>
                        <p>
                            <input type="checkbox" class="filled-in" value="Reports" name="access[]" id="Circulation-Librarian"   <?php
                            $sql = $conn->query("SELECT * FROM `access_levels` WHERE   `librarian_id` = '".$_GET["librarian_id"]."'");
                            while ($row = $sql->fetch_object()) {
                                if($row->access_level == "Reports") {
                                    echo "checked";
                                }
                            }
                            ?>/>
                            <label for="Circulation-Librarian">Reports</label>
                        </p>
                </div>


                    <input class="waves-effect waves-light btn active" style="margin-left: 5%; margin-bottom: 5%;  margin-top: 1% " href="UserManagementList.php" value="UPDATE" type="submit">
                    <a class="waves-effect waves-light btn active" style="margin-bottom: 5%; margin-left:3%;  margin-top: 1%" href="UserManagementList.php">Cancel</a>
                </form>

            </div>
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