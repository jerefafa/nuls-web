 <?php
include "startup.php";
?>
<!DOCTYPE html>
<html>
<head>
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
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li class="active"><a href="AddCopies.php">Add Copies</a></li>
            <li class=""><a href="ListOfCopies.php">List of Copies</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

    </nav>

    <div id="content">
        <div class="row">
            <form action="AddCopiesCommand.php" method="post">
            <div class="col s12">
                <div class="col s4">
                    <select id="program" name="program" required>
                        <option disabled selected value="">Select Program</option>
                        <?php
                            $stmt = $conn->query("SELECT * FROM `programs` WHERE `date_deleted` IS NULL");
                            while ($row = $stmt->fetch_object()){
                                echo "<option value='".$row->program_id."'>".$row->program."</option>";
                            }
                        ?>
                    </select>
                    <label>Program</label>
                </div>



            </div>

            <div class="col s4 input-field">
                <select required name="subject" id="subjects">
                                  </select>

            </div>

            <div class="col s3 input-field">
                    <input id="author" type="text" class="validate" name="author" pattern="[A-Za-z\-\s\.\d,]{2,}" required>
                <label for="author">Author</label>
            </div>

            <div class="col s3 input-field">
                <input id="title" type="text" class="validate" name="title" pattern="[A-Za-z0-9#&*()+,\s\./-,:]{2,}" required>
                <label for="title">Title</label>
            </div>

            <div class="col s2 input-field">
                <input id="edition" type="text" class="validate" name="edition" pattern="[1-9]{1,2}" required>
                <label for="edition">Edition</label>
            </div>


            <div class="col s4 input-field">
                <input id="copyrightdate" type="text" class="datepicker" name="copyRightDate" required>
                <label for="copyrightdate">Copyright Date</label>
            </div>

            <div class="col s3 input-field">

                <select name="supplier1">
                   <option selected disabled value="">Select Supplier</option>
                    <?php
                        $stmt = $conn->query("SELECT * FROM `suppliers` WHERE `date_deleted` IS NULL");
                        while ($row=$stmt->fetch_object()){
                            echo "<option value='".$row->supplier_id."'>".$row->supplier_name."</option>";
                        }
                    ?>
               </select>

            </div>

            <div class="col s3 input-field">
                <input id="price" type="number" class="validate" name="price" pattern="[1-9]{2,}" required>
                <label for="price">Price</label>
            </div>

            <div class="col s2 input-field">
                <input id="qty" type="number" class="validate" name="quantity" min="1" max="99" pattern="[0-9]{1,2}" required>
                <label for="qty">Quantity</label>
            </div>

            <p><b>c/o LRC</b></p>

            <div class="col s3 input-field">
                <input type="text" class="datepicker" id="date-canvassed" name="dateCanvassed" required>
                <label class="active center" for="date-canvassed">Date Canvassed</label>
            </div>

            <div class="col s3 input-field">
                <input type="text" class="datepicker" id="date-of-rs/pr" name="dateRs" required>
                <label class="active center" for="date-of-rs/pr">Date of rs/pr</label>
            </div>

            <div class="col s3 input-field">
              <select name="supplier2">
                  <option selected disabled value="">Select Supplier</option>
                  <?php
                  $stmt = $conn->query("SELECT * FROM `suppliers` WHERE `date_deleted` IS NULL");
                  while ($row=$stmt->fetch_object()){
                      echo "<option value='".$row->supplier_id."'>".$row->supplier_name."</option>";
                  }
                  ?>
              </select>
            </div>

            <div class="col s3 input-field">
                <input id="prc" type="number" required class="validate" pattern="[0-9]{2,}" name="lrcPrice">
                <label for="prc">Price</label>
            </div>

            <div class="col s4 input-field">
                <select name="lrcNeedForJustification" required>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <label for="nfj">Need for Justification</label>
            </div>

            <div class="col s4 input-field">
                <input type="text" class="datepicker" id="date-of-justification" name="justificationDate" required>
                <label class="active center" for="date-of-justification">Date of Justification Matrix</label>
            </div>

            <div class="col s4 input-field">
                <input type="text" class="datepicker" id="date-of-signature" name="dateOfSignature" required>
                <label class="active center" for="date-of-signature">Date of Signature</label>
            </div>

            <p><b>Date Received & Signature</b></p>
            <div class="col s12">
                <div class="col s3 input-field">
                    <input id="cl" type="text" class="datepicker" name="chiefLibrarianDate" required>
                    <label for="cl">Chief Librarian</label>
                </div>
                <div class="col s3 input-field">
                    <input id="liaison" type="text" class="datepicker" name="liasonDate" required>
                    <label for="liaison">Liaison</label>
                </div>
                <div class="col s3 input-field">
                    <input id="vppa" type="text" class="datepicker" name="vpaaDate" required>
                    <label for="vppa">VPPA</label>
                </div>
                <div class="col s3 input-field">
                    <input id="controllership" required type="text" class="datepicker" name="controllershipDate">
                    <label for="controllership">Controllership</label>
                </div>
                <div class="col s3 input-field">
                    <input id="pyt" type="text"  required class="datepicker" name="pytDate">
                    <label for="pyt">PYT</label>
                </div>
                <div class="col s3 input-field">
                    <input id="purchasing" type="text" class="datepicker" name="purchasingDate" required>
                    <label for="purchasing">Purchasing</label>
                </div>
            </div>


            <p><b>c/o Purchasing</b></p>

            <div class="col s12">
                <div class="col s3 input-field">
                    <input type="text" class="datepicker" id="date-ordered" name="dateOrdered" required>
                    <label class="active center" for="date-ordered">Date Ordered</label>
                </div>

                <div class="col s3 input-field">
                    <input type="text" class="datepicker" id="date-delivered" name="dateDelivered" required>
                    <label class="active center" for="date-delivered">Date Delivered</label>
                </div>
            </div>

            <p><b>c/o LRC</b></p>

            <div class="col s4 input-field">
                <input type="text" class="datepicker" id="date-delivered-to-LRC" name="dateDeliveredToLrc" required>
                <label class="active center" for="date-delivered-to-LRC">Date Delivered to LRC</label>
            </div>

            <div class="col s4 input-field">
                <input id="nod" type="number" class="validate" name="numDays" pattern="[0-9]{1,}" required>
                <label for="nod">No. of days</label>
            </div>

            <div class="col s4 input-field">
                <input type="text" class="datepicker" id="date-processed" name="dateProcessed" required>
                <label class="active center" for="date-processed">Date Processed</label>
            </div>

            <div class="col s4 input-field">
                <input type="text" class="datepicker" id="date-of-shelving" name="dateShelving" required>
                <label class="active center" for="date-of-shelving">Date of Shelving</label>
            </div>

            <div class="col s4 input-field">
                <input id="nod" type="number" class="validate" name="totalNumDays" pattern="[0-9]{1,}" required>
                <label for="nod">Total No. of days</label>
            </div>

            <div class="col s4 input-field">
                <textarea id="remarks" class="materialize-textarea" name="remarks" pattern="[A-Za-z0-9.-#&*()+,\s]{2,}"></textarea>
                <label for="remarks">Remarks</label>
            </div>

            <div class="right-align">
                <input class="waves-effect waves-light btn" href="#" type="submit" value="Add Copy" name="AddCopy">
                <a class="waves-effect waves-light btn" href="#">Cancel</a>
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
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 30, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        format: 'mmm dd yyyy',
        closeOnSelect: true, // Close upon selecting a date,
        max: new Date()
    });
    $(document).ready(function(){
        $("#program").change(function () {
            var program_id = $(this).val();
            $.ajax({
                url:"get_subjects.php",
                type:"POST",
                data:{program_id:program_id},
                dataType:"Text",
                success:function (data) {
                    var selectName='subjects';
                    $('#'+selectName).html(data);
                    $('#subjects').material_select();
                }
            });
        })

    });
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