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
            <li class="active"><a href="Acquisition_Report.php">Acquisition Reports</a></li>
            <li class=""><a href="Catalog_Report.php">Catalog Reports</a></li>
            <li class=""><a href="Circulation_Report.php">Circulation Reports</a></li>
            <li class=""><a href="Inventory.php">Inventory</a></li>
        </ul>

    </nav>

    <div id="content">
        <form action="Acquisition_Report.php" method="post">
            <div class="row">
                <h6>Date:</h6>
                <div class="input-field col s3">
                    <input type="text" class="datepicker" id="to" name="txtStartDate">
                    <label class="active center" for="to">From</label>
                </div>
                <div class="input-field col s3">
                    <input type="text" class="datepicker" id="from" name="txtEndDate">
                    <label class="active center" for="from">To</label>
                </div>
                <div class="col s3">
                    <!--<a class="waves-effect waves-light btn active" style="margin-top: 11%" href="Acquisition_Print.html">Print</a>-->
                    <button type="submit" class="waves-effect waves-light btn active" style="margin-top: 11%" type="submit" value="search" name="searchButton">Search</button>
                </div>

            </div>
        </form>

        <table class="highlight grey lighten-2">
            <thead>
            <th>Book Title</th>
            <th>Author</th>
            <th>Edition</th>
            <th>Copyright Date</th>
            <th>Price</th>
            <th>Date Delivered</th>
            <th>Date Processed</th>
            <th>Date of Shelving</th>
            <th>Quantity</th>
            </thead>
            <tbody>
            <?php
            $sql="";
            $flag = false;
            if(isset($_POST["searchButton"])){
                if(empty($_POST['txtStartDate']) || empty($_POST['txtEndDate'])) {
                    echo "<script>swal('','Input dates are required', 'error')</script>";
                } else {
                    $flag = true;
                }

                $startDate= date_format(date_create($_POST['txtStartDate']),"Y-m-d");
                $endDate=  date_format(date_create($_POST['txtEndDate']),"Y-m-d");
                $sql="SELECT * FROM `acquisition` WHERE (`date_delivered` BETWEEN '$startDate' AND '$endDate') AND `date_deleted` IS NULL ORDER BY `date_delivered` ASC";
            }else{
                $sql="SELECT * FROM `acquisition` WHERE `date_deleted` IS NULL ORDER BY `date_delivered` ASC";
            }
            if($flag) {
                if ($stmt = $conn->query($sql)) {
                    $flag = mysqli_num_rows($stmt) > 0;
                    while ($row = $stmt->fetch_object()) {
                        echo "<tr>
                    <td>" . $row->title . "</td>
                    <td>" . $row->author . "</td>
                    <td>" . $row->edition . "</td>
                    <td>" . date_format(date_create($row->copyright_date), "M d Y") . "</td>
                    <td>" . $row->price . "</td>
                    <td>" . date_format(date_create($row->date_delivered), "M d Y") . "</td>
                    <td>" . date_format(date_create($row->date_processed), "M d Y") . "</td>
                    <td>" . date_format(date_create($row->date_of_shelving), "M d Y") . "</td>
                    <td>" . $row->quantity . "</td>
                    </tr>";
                    }
                }
            }
            else
            {
                echo $conn->error;
            }
            ?>
            </tbody>
        </table>
        <div style="display: flex">
        <?php
        if(isset($_POST["searchButton"]) && $flag) {
            echo "<form action='Acquisition_Print.php' method='get' target='_blank' style='margin-right: 5px'>";
            $startDate = $_POST["txtStartDate"];
            $endDate = $_POST["txtEndDate"];
            echo "<input type='hidden' value='$startDate' name='start'>";
            echo "<input type='hidden' value='$endDate' name='end'>";
            echo "<button type=\"submit\" class=\"waves-effect waves-light btn active\" style=\"margin-top: 11%;\" type=\"submit\" value=\"search\" name=\"printButton\">Print</button>";
            echo "</form>";
            echo "<form action='generate_acquisition.php' method='get' target='_blank'>";
            $startDate = $_POST["txtStartDate"];
            $endDate = $_POST["txtEndDate"];
            echo "<input type='hidden' value='$startDate' name='start'>";
            echo "<input type='hidden' value='$endDate' name='end'>";
            echo "<button type=\"submit\" class=\"waves-effect waves-light btn active\" style=\"margin-top: 6%;\" type=\"submit\" value=\"search\" name=\"printButton\">Generate Report</button>";
            echo "</form>";
        }
        ?>
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
        format: 'mmm dd yyyy',
        closeOnSelect: false // Close upon selecting a date,
    });
</script>
</html>