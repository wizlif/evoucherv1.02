<?php
include "./user_functions/session_store.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EzyVoucher | Training Schedule </title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="css/datepicker.min.css">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">

    <link href="css/calendar/fullcalendar.css" rel="stylesheet">
    <link href="css/calendar/fullcalendar.print.css" rel="stylesheet" media="print">


    <!-- Bootstrap Date-Picker Plugin -->

    <link rel="stylesheet" href="css/bootstrap-datepicker3.css"/>

    <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="css/datepicker.min.css">

    <script src="js/jquery.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>


    <style type="text/css">

        .fc-time:after {
            content: "M";
        }

        .fc-axis.fc-time:after {
            content: " ";
        }

        .bootstrap-datetimepicker-widget {
            z-index: 1200 !important;
        }

    </style>
    <!--[if lt IE 9]>
    <script src="../assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body class="nav-md">

<div class="container body">


    <div class="main_container">

        <!---header-->
        <?php
        include('sidemenu.php');
        ?>
    </div>
</div>

<!-- top navigation -->
<?php
include('navbar.php')

?>
<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main">
    <div class="">


        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Training Schedules</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <table id="schedule" class="table table-bordered table-responsive">

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!---footer -->

    <?php

    include('footer.php');

    ?>

</div>


<!-- Start Calender modal -->
<div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Create Training Event</h4>
            </div>
            <div class="modal-body">

                <form id="demo-form" data-parsley-validate>

                    <label for="email">District of Training * :</label>
                    <input type="text" id="training_district" class="form-control" data-parsley-trigger="change"
                           required/>
                    <label for="email">SubCounty of Training * :</label>
                    <input type="text" id="training_subcounty" class="form-control" data-parsley-trigger="change"
                           required/>
                    <label for="email">Parish of Training * :</label>
                    <input type="text" id="training_parish" class="form-control" data-parsley-trigger="change"
                           required/>
                    <label for="email">Village of Training * :</label>
                    <input type="text" id="training_village" class="form-control" data-parsley-trigger="change"
                           required/>
                    <label for="email">Venue * :</label>
                    <input type="text" id="training_venue" class="form-control" data-parsley-trigger="change" required/>

                    <label for="fullname">Training Date *:</label>
                    <!-- <input type="text" id="training_date" class="form-control" name="fullname" required /> -->
                    <input readonly class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"
                           required/>

                    <label for="email">Time *Of the form HH:MM Eg. 2:30 PM :</label>

                    <div class="input-append date time">
                        <input class="form-control" id="time" name="time" placeholder="hh:mm" type="text" required/>
                    </div>


                    <label for="message">Target Farmers * :</label>
                    <input type="number" id="training_target" class="form-control" data-parsley-trigger="change"
                           required/>

                    <label for="message">Topics to be covered * :</label>
                    <input type="text" id="training_topic" class="form-control" data-parsley-trigger="change" required/>
                    <br/>
                    <a class="btn btn-primary" onclick="registerTraining();">Create Event</a>
                </form>

            </div>

        </div>
    </div>
</div>
<?php
if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Client") {
} else {

    echo ' <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>';
}

?>


<!-- End Calender modal -->
<!-- /page content -->
</div>

</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>


<script src="js/bootstrap.min.js"></script>

<script src="js/nprogress.js"></script>

<!-- bootstrap progress js -->
<script src="js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="js/icheck/icheck.min.js"></script>

<script src="js/custom.js"></script>

<script src="js/moment/moment.min.js"></script>
<!-- include moment js and datetimepicker js file-->
<script type="text/javascript" src="js/moment.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>

<script src="js/calendar/fullcalendar.min.js"></script>
<!-- pace -->
<script src="js/pace/pace.min.js"></script>


<script>
    $(document).ready(function () {
        var date_input = $('input[name="date"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var options = {
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };
        //date_input.datepicker(options);

    });

    $(function () {
        $('#time').datetimepicker({
            pickDate: false,
            format: "hh:mm a",
        });


    })
</script>


<script>
    $(window).load(function () {

        getSchedule();

    });


    function getSchedule() {

        var token = "get_schedule";

        $.post('form_actions/get_tables.php', {token: token}, function (data) {
            $("#schedule").html(data);
        });


    }


    function registerTraining() {

        var doc_training_date = document.getElementById("date");
        training_date = doc_training_date.value;

        var doc_training_district = document.getElementById("training_district");
        training_district = doc_training_district.value;

        var doc_training_subcounty = document.getElementById("training_subcounty");
        training_subcounty = doc_training_subcounty.value;

        var doc_training_parish = document.getElementById("training_parish");
        training_parish = doc_training_parish.value;

        var doc_training_village = document.getElementById("training_village");
        training_village = doc_training_village.value;

        var doc_training_venue = document.getElementById("training_venue");
        training_venue = doc_training_venue.value;

        var doc_training_starttime = document.getElementById("time");
        training_starttime = doc_training_starttime.value;

        var doc_training_target = document.getElementById('training_target');
        training_target = doc_training_target.value;

        var doc_training_topic = document.getElementById("training_topic");
        training_topic = doc_training_topic.value;

        var token = "register_training";
        $.post('form_actions/get_tables.php', {
            token: token,
            training_district: training_district,
            training_subcounty: training_subcounty,
            training_parish: training_parish,
            training_village: training_village,
            training_venue: training_venue,
            training_date: training_date,
            training_starttime: training_starttime,
            training_target: training_target,
            training_topic: training_topic
        }, function (data) {

            location.reload();
        })
    }

</script>


</body>

</html>
