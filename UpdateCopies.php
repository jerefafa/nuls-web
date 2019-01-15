<?php
include "startup.php";
if(!isset($_GET["acquisition_number"])){
    header("Location:ListOfCopies.php");
}
else{
    $stmt=$conn->query("SELECT * FROM `acquisition` WHERE `acquisition_number` = '".$_GET["acquisition_number"]."'");
    while ($row = $stmt->fetch_object()){
        $acquisition_number = $row->acquisition_number;
        $proram_id = $row->program_id;
        $subject_id = $row->subject_id;
        $author = $row->author;
        $title = $row->title;
        $edition = $row->edition;
        $copyRightDate = $row->copyright_date;
        $supplier = $row->supplier_id;
        $price = $row->price;
        $quantity = $row->quantity;
        $date_canvassed = $row->lrc_date_canvassed;
        $date_rs = $row->lrc_date_rs_ps;
        $lrc_supplier = $row->lrc_supplier_id;
        $lrcPrice = $row->lrc_price;
        $lrcNeedForJustification = $row->lrc_need_for_justification;
        $dateOfJustificationMatrix = $row->date_of_justification_matrix;
        $dateOfSignature = $row->date_of_signature;
        $chiefLibrarian = $row->chief_librarian_date;
        $liaison = $row->liaison_date;
        $vpaa = $row->vpaa_date;
        $controllership = $row->controllership_date;
        $pyt = $row->pyt_date;
        $purchasing = $row->purchasing_date;
        $date_ordered = $row->date_ordered;
        $date_delivered = $row->date_delivered;
        $date_delivered_to_lrc = $row->date_delivered_to_lrc;
        $num_of_days = $row->no_of_days;
        $date_processed = $row->date_processed;
        $date_of_shelving = $row->date_of_shelving;
        $total_number_of_days = $row->total_no_of_days;
        $remarks = $row->remarks;
    }
}
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
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li class="active"><a href="AddCopies.php">Add Copies</a></li>
            <li class=""><a href="ListOfCopies.php">List of Copies</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

    </nav>

    <div id="content">
        <div class="row">
            <form action="UpdateCopiesCommand.php" method="post">
                <div class="col s12">
                    <div class="col s4">
                        <input type="hidden" name="acquisition_number" value="<?php echo $acquisition_number ?>">
                        <select id="program" name="program" required>
                            <option disabled value="">Select Program</option>
                            <?php
                            $stmt = $conn->query("SELECT * FROM `programs` WHERE `date_deleted` IS NULL");
                            while ($row = $stmt->fetch_object()){
                                if($row->program_id==$proram_id){
                                    echo "<option value='".$row->program_id."' selected>".$row->program."</option>";
                                }else {
                                    echo "<option value='" . $row->program_id . "'>" . $row->program . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <label>Program</label>
                    </div>



                </div>

                <div class="col s4 input-field">
                    <select required name="subject" id="subjects">
                    </select>
                    <input type="hidden" value="<?php echo $subject_id?>" name="subject_id" id="subject_id">
                </div>

                <div class="col s3 input-field">
                    <input id="author" type="text" class="validate" name="author" pattern="[A-Za-z\-\s\.]{2,}" required value="<?php echo $author ?>">
                    <label for="author">Author</label>
                </div>

                <div class="col s3 input-field">
                    <input id="title" type="text" class="validate" name="title" pattern="[A-Za-z0-9#&*()+,\s\.]{2,}" required value="<?php echo $title ?>">
                    <label for="title">Title</label>
                </div>

                <div class="col s2 input-field">
                    <input id="edition" type="text" class="validate" name="edition" pattern="[0-9]{1,}" required value="<?php echo $edition ?>">
                    <label for="edition">Edition</label>
                </div>


                <div class="col s4 input-field">
                    <input id="copyrightdate" type="text" class="datepicker" name="copyRightDate" value="<?php echo date_format(date_create($copyRightDate),'M d Y') ?>"  required>
                    <label for="copyrightdate">Copyright Date</label>
                </div>
                <div class="col s3 input-field">

                    <select name="supplier1">
                        <option selected disabled value="">Select Supplier</option>
                        <?php
                        $stmt = $conn->query("SELECT * FROM `suppliers` WHERE `date_deleted` IS NULL");
                        while ($row=$stmt->fetch_object()){
                            if($row->supplier_id!=$supplier) {
                                echo "<option value='" . $row->supplier_id . "'>" . $row->supplier_name . "</option>";
                            }else{
                                echo "<option value='" . $row->supplier_id . "' selected>" . $row->supplier_name . "</option>";
                            }
                        }
                        ?>
                    </select>

                </div>

                <div class="col s3 input-field">
                    <input id="price" type="number" class="validate" name="price" pattern="[0-9]{2,}" value="<?php echo $price ?>" required>
                    <label for="price">Price</label>
                </div>

                <div class="col s2 input-field">
                    <input id="qty" type="number" class="validate" name="quantity" pattern="[0-9]{1,}" required value="<?php echo $quantity ?>">
                    <label for="qty">Quantity</label>
                </div>

                <p><b>c/o LRC</b></p>

                <div class="col s3 input-field">
                    <input type="text" class="datepicker" id="date-canvassed" name="dateCanvassed" required value="<?php echo date_format(date_create($date_canvassed),'M d Y')?>">
                    <label class="active center" for="date-canvassed">Date Canvassed</label>
                </div>

                <div class="col s3 input-field">
                    <input type="text" class="datepicker" id="date-of-rs/pr" name="dateRs" required value="<?php echo date_format(date_create($date_rs),'M d Y')?>">
                    <label class="active center" for="date-of-rs/pr">Date of rs/pr</label>
                </div>

                <div class="col s3 input-field">
                    <select name="supplier2">
                        <option selected disabled value="">Select Supplier</option>
                        <?php
                        $stmt = $conn->query("SELECT * FROM `suppliers` WHERE `date_deleted` IS NULL");
                        while ($row=$stmt->fetch_object()){
                            if($row->supplier_id!=$lrc_supplier) {
                                echo "<option value='" . $row->supplier_id . "'>" . $row->supplier_name . "</option>";
                            }else{
                                echo "<option value='" . $row->supplier_id . "' selected>" . $row->supplier_name . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="col s3 input-field">
                    <input id="prc" type="number" required class="validate" name="lrcPrice" pattern="[0-9]{2,}" value="<?php echo $lrcPrice?>">
                    <label for="prc">Price</label>
                </div>

                <div class="col s4 input-field">
                    <input id="nfj" type="text" class="validate" name="lrcNeedForJustification" pattern="[(YES|NO)]{2,}" required title="Enter only YES or NO" value="<?php echo $lrcNeedForJustification?>">
                    <label for="nfj">Need for Justification</label>
                </div>

                <div class="col s4 input-field">
                    <input type="text" class="datepicker" id="date-of-justification" name="justificationDate" required value="<?php echo date_format(date_create($dateOfJustificationMatrix),'M d Y')?>">
                    <label class="active center" for="date-of-justification">Date of Justification Matrix</label>
                </div>

                <div class="col s4 input-field">
                    <input type="text" class="datepicker" id="date-of-signature" name="dateOfSignature" required value="<?php echo date_format(date_create($dateOfSignature),'M d Y') ?>">
                    <label class="active center" for="date-of-signature">Date of Signature</label>
                </div>

                <p><b>Date Received & Signature</b></p>
                <div class="col s12">
                    <div class="col s3 input-field">
                        <input id="cl" type="text" class="datepicker" name="chiefLibrarianDate" required value="<?php echo date_format(date_create($chiefLibrarian),'M d Y')?>">
                        <label for="cl">Chief Librarian</label>
                    </div>
                    <div class="col s3 input-field">
                        <input id="liaison" type="text" class="datepicker" name="liasonDate" required value="<?php echo date_format(date_create($liaison),'M d Y')?>">
                        <label for="liaison">Liaison</label>
                    </div>
                    <div class="col s3 input-field">
                        <input id="vppa" type="text" class="datepicker" name="vpaaDate" required value="<?php echo date_format(date_create($vpaa),'M d Y')?>">
                        <label for="vppa">VPPA</label>
                    </div>
                    <div class="col s3 input-field">
                        <input id="controllership" required type="text" class="datepicker" name="controllershipDate" value="<?php echo date_format(date_create($controllership),'M d Y')?>">
                        <label for="controllership">Controllership</label>
                    </div>
                    <div class="col s3 input-field">
                        <input id="pyt" type="text"  required class="datepicker" name="pytDate" value="<?php echo date_format(date_create($pyt),'M d Y')?>">
                        <label for="pyt">PYT</label>
                    </div>
                    <div class="col s3 input-field">
                        <input id="purchasing" type="text" class="datepicker" name="purchasingDate" required value="<?php echo date_format(date_create($purchasing),'M d Y') ?>">
                        <label for="purchasing">Purchasing</label>
                    </div>
                </div>


                <p><b>c/o Purchasing</b></p>

                <div class="col s12">
                    <div class="col s3 input-field">
                        <input type="text" class="datepicker" id="date-ordered" name="dateOrdered" required value="<?php echo date_format(date_create($date_ordered),'M d Y')?>">
                        <label class="active center" for="date-ordered">Date Ordered</label>
                    </div>

                    <div class="col s3 input-field">
                        <input type="text" class="datepicker" id="date-delivered" name="dateDelivered" required value="<?php echo date_format(date_create($date_delivered),'M d Y') ?>">
                        <label class="active center" for="date-delivered">Date Delivered</label>
                    </div>
                </div>

                <p><b>c/o LRC</b></p>

                <div class="col s4 input-field">
                    <input type="text" class="datepicker" id="date-delivered-to-LRC" name="dateDeliveredToLrc" required value="<?php echo date_format(date_create($date_delivered_to_lrc),'M d Y')?>">
                    <label class="active center" for="date-delivered-to-LRC">Date Delivered to LRC</label>
                </div>

                <div class="col s4 input-field">
                    <input id="nod" type="number" class="validate" name="numDays" pattern="[0-9]{1,}" required value="<?php echo $num_of_days ?>">
                    <label for="nod">No. of days</label>
                </div>

                <div class="col s4 input-field">
                    <input type="text" class="datepicker" id="date-processed" name="dateProcessed" required value="<?php echo date_format(date_create($date_processed),'M d Y') ?>">
                    <label class="active center" for="date-processed">Date Processed</label>
                </div>

                <div class="col s4 input-field">
                    <input type="text" class="datepicker" id="date-of-shelving" name="dateShelving" required value="<?php echo date_format(date_create($date_of_shelving),'M d Y')?>">
                    <label class="active center" for="date-of-shelving">Date of Shelving</label>
                </div>

                <div class="col s4 input-field">
                    <input id="nod" type="number" class="validate" name="totalNumDays" pattern="[0-9]{1,}" required value="<?php  echo $total_number_of_days ?>">
                    <label for="nod">Total No. of days</label>
                </div>

                <div class="col s4 input-field">
                    <textarea id="remarks" class="materialize-textarea" pattern="[A-Za-z0-9.-#&*()+,\s]{2,}" name="remarks"> <?php echo $remarks ?></textarea>
                    <label for="remarks">Remarks</label>
                </div>

                <div class="right-align">
                    <input class="waves-effect waves-light btn" href="#" type="submit" value="Save" name="SaveCopy">
                    <a class="waves-effect waves-light btn" href="ListOfCopies.php">Cancel</a>
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
        closeOnSelect: true // Close upon selecting a date,
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
    var program_id = $("#program").val();
    $.ajax({
        url:"get_subjects.php",
        type:"POST",
        data:{program_id:program_id,subject_id:$("#subject_id").val()},
        dataType:"Text",
        success:function (data) {
            var selectName='subjects';
            $('#'+selectName).html(data);
            $('#subjects').material_select();
        }
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
<script>
    function getSubjects(){

    }
</script>

</html>