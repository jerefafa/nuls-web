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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
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
            <li class="active"><a href="Statistics.php">Circulation by Day</a></li>
            <li class=""><a href="CirculationByMonth.php">Circulation by Month</a></li>
            <li class=""><a href="CirculationByYear.php">Circulation by Year</a></li>
        </ul>

        <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

    </nav>

    <div id="content">

        <div class="row">
            <h6>Date:</h6>
            <div class="input-field col s2">
                <input type="text" class="datepicker" id="to">
                <label class="active center" for="to">To</label>
            </div>
            <div class="input-field col s2">
                <input type="text" class="datepicker" id="from">
                <label class="active center" for="from">From</label>
            </div>
            <div class="col s3">
                <label>Circulation</label>
                <select class="browser-default">
                    <option value="0">Check In</option>
                    <option value="1">Check Out</option>
                </select>
            </div>
            <div class="col s3">
                <label>Course</label>
                <select class="browser-default">
                    <option value="0">BSIT</option>
                    <option value="1">BSCS</option>
                </select>
            </div>
            <div class="col s2">
                <a class="waves-effect waves-light btn active" style="margin-top: 18%" href="">Go!</a>
            </div>
        </div>

        <canvas id="Chart1"></canvas>


        <script>
            let Chart1 = document.getElementById('Chart1').getContext('2d');

            // Global Options
            Chart.defaults.global.defaultFontFamily = 'Lato';
            Chart.defaults.global.defaultFontSize = 18;
            Chart.defaults.global.defaultFontColor = '#777';

            let massPopChart = new Chart(Chart1, {
                type:'line', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                data:{
                    labels:['6:00AM', '7:00AM', '8:00AM', '9:00AM', '10:00AM', '11:00AM'],
                    datasets:[{
                        label:'',
                        data:[
                            7,
                            5,
                            5,
                            6,
                            4,
                            0,

                        ],
                        //backgroundColor:'green',
                        backgroundColor:[
                            'rgba(38, 166, 154, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)',
                            'rgba(255, 99, 132, 0.6)'
                        ],
                        borderWidth:1,
                        borderColor:'#777',
                        hoverBorderWidth:3,
                        hoverBorderColor:'#000'
                    }]
                },
                options:{
                    title:{
                        display:true,
                        text:'Library Circulation by Monday 05/03/2018',
                        fontSize:25
                    },
                    legend:{
                        display:true,
                        position:'right',
                        labels:{
                            fontColor:'#000'
                        }
                    },
                    layout:{
                        padding:{
                            left:50,
                            right:0,
                            bottom:0,
                            top:0
                        }
                    },
                    tooltips:{
                        enabled:true
                    }
                }
            });
        </script>



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