<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EzVoucher | Trainings Report</title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css"  rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css"  rel="stylesheet">
    <link href="css/printing/attendance_report_print.css" media="print">

    <link href="css/icheck/flat/green.css" rel="stylesheet">

    <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <script src="js/jquery.min.js"></script>


    <!-- PNotify -->
    <script type="text/javascript" src="js/notify/pnotify.core.js"></script>
    <script type="text/javascript" src="js/notify/pnotify.buttons.js"></script>
    <script type="text/javascript" src="js/notify/pnotify.nonblock.js"></script>


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

    <div id="data" style="width:100%" class="x_panel">
        <div id="remove" class="container">

            <div id="trainings_id" class="col-md-3 co-sm-12">
                <!--<select  class="form-control">
                    <option>All Trainings</option>
                    <option>Training one</option>
                    <option>Training two</option>
                    <option>Training three</option>
                </select>-->
            </div>

            <ul class="navbar-right"><a onclick="printContent('printpage');" class="btn btn-sm btn-default"><i
                        class="fa fa-print"></i> &nbsp; Print</a></ul>
        </div>
        <hr style="margin-top:3px;margin-bottom:10px;"/>
<!--        <div class="col-md-3 co-sm-12">-->
<!--            <h4 style="margin-bottom:0"><b>Partner </b>: Akorion co ltd</h4>-->
<!--            <p id="showing">Showing All Tranings</p>-->
<!--        </div>-->
        <div class="container" id="printpage">
            <div class="col-md-5 navbar-left">

                <table id="equipment_percentages" class="table table-bordered table-responsive">
                    <!--<tr><td>L.M.S</td><td>M.M.S</td><td>SGBS</td><td>TARGS</td></tr>
                    <tr><td>46.7%</td><td>4%</td><td>46.7%</td><td>4%</td></tr>-->
                </table>
            </div>

        <table id="report" class="table table-bordered table-responsive ">
            <!--<tr>
             <td colspan="7">Training</td>
             <td colspan="7">Equipments Ordered</td>
               </tr>
               <tr class="header">
                   <td>Training Date</td>
                   <td>Partner</td>
                   <td>District</td>
                   <td>Target</td>
                   <td>Total Trained</td>
                   <td>Male</td>
                   <td>Female</td>

                   <td>M.M. SILO</td>
                   <td>L.M. SILO</td>
                   <td>P. SILO</td>
                   <td>SGBS</td>
                   <td>TARPS</td>
                   <td>Orders</td>
                   <td>Orders Rate</td>
               </tr>

                 <tr>
                   <td>19TH-APRIL-2016</td>
                   <td>AKORION</td>
                   <td>Mubende</td>
                   <td>2,800</td>
                   <td>900</td>
                   <td>600</td>
                   <td>300</td>

                   <td>40</td>
                   <td>100</td>
                   <td>2</td>
                   <td>0</td>
                   <td>9</td>
                   <td>151</td>
                   <td>0.38</td>
               </tr><tr>
                   <td>19TH-APRIL-2016
           </td>
                   <td>AKORION
           </td>
                   <td>Mubende</td>
                   <td>2,800</td>
                   <td>900</td>
                   <td>600</td>
                   <td>300</td>

                   <td>40</td>
                   <td>100</td>
                   <td>2</td>
                   <td>0</td>
                   <td>9</td>
                   <td>151</td>
                   <td>0.38</td>
               </tr><tr>
                   <td>19TH-APRIL-2016
           </td>
                   <td>AKORION
           </td>
                   <td>Mubende</td>
                   <td>2,800</td>
                   <td>900</td>
                   <td>600</td>
                   <td>300</td>

                   <td>40</td>
                   <td>100</td>
                   <td>2</td>
                   <td>0</td>
                   <td>9</td>
                   <td>151</td>
                   <td>0.38</td>
               </tr><tr>
                   <td>19TH-APRIL-2016
           </td>
                   <td>AKORION
           </td>
                   <td>Mubende</td>
                   <td>2,800</td>
                   <td>900</td>
                   <td>600</td>
                   <td>300</td>

                   <td>40</td>
                   <td>100</td>
                   <td>2</td>
                   <td>0</td>
                   <td>9</td>
                   <td>151</td>
                   <td>0.38</td>
               </tr>-->
        </table>
        </div>
    </div>
</div>
</body>


<script src="js/bootstrap.min.js"></script>

<!-- bootstrap progress js -->
<script src="js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="js/icheck/icheck.min.js"></script>

<script src="js/custom.js"></script>


<!-- Datatables -->
<!-- <script src="js/datatables/js/jquery.dataTables.js"></script>
<script src="js/datatables/tools/js/dataTables.tableTools.js"></script> -->

<!-- Datatables-->
<script src="js/datatables/jquery.dataTables.min.js"></script>
<script src="js/datatables/dataTables.bootstrap.js"></script>
<script src="js/datatables/dataTables.buttons.min.js"></script>
<script src="js/datatables/buttons.bootstrap.min.js"></script>
<script src="js/datatables/jszip.min.js"></script>
<script src="js/datatables/pdfmake.min.js"></script>
<script src="js/datatables/vfs_fonts.js"></script>
<script src="js/datatables/buttons.html5.min.js"></script>
<script src="js/datatables/buttons.print.min.js"></script>
<script src="js/datatables/dataTables.fixedHeader.min.js"></script>
<script src="js/datatables/dataTables.keyTable.min.js"></script>
<script src="js/datatables/dataTables.responsive.min.js"></script>
<script src="js/datatables/responsive.bootstrap.min.js"></script>
<script src="js/datatables/dataTables.scroller.min.js"></script>


<!-- pace -->
<script src="js/pace/pace.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        getTrainings();
    });

    function getTrainings() {

        var token = 'get_trainings_for_training';
        $.post('form_actions/get_tables.php', {token: token}, function (data) {
            $("#trainings_id").html(data);
            var e = document.getElementById("training_id");
            var id = e.options[e.selectedIndex].value;
            getReport(id);
            getEquipmentReport(id);
        });
    }


    function getEquipmentReport(id) {

        var token = 'get_equipment_report';
        $.post('form_actions/get_tables.php', {token: token, id: id}, function (data) {
            $("#equipment_percentages").html(data);
        });
    }

    function getReport(id) {

        var token = 'get_trainings_report';
        $.post('form_actions/get_tables.php', {token: token, id: id}, function (data) {
            $("#report").html(data);
        });
    }


    (function () {

        var beforePrint = function () {


            addClass("remove", "hide-before-print");

        };

        var afterPrint = function () {

            removeClass("remove", "hide-before-print");
            getTrainings();


        };

        if (window.matchMedia) {
            var mediaQueryList = window.matchMedia('print');

            mediaQueryList.addListener(function (mql) {
                //alert($(mediaQueryList).html());
                if (mql.matches) {
                    beforePrint();
                } else {
                    afterPrint();
                }
            });
        }

        window.onbeforeprint = beforePrint;
        window.onafterprint = afterPrint;

    }());
    function printContent(el0) {

        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el0).innerHTML;

        document.body.innerHTML = printcontent;
        window.print();

        document.body.innerHTML = restorepage;
    }


    function selectTraining() {
        var e = document.getElementById("training_id");
        var id = e.options[e.selectedIndex].value;
        var training = e.options[e.selectedIndex].text;

        $("#showing").html("Showing " + training + " training(s)");
        getReport(id);
        getEquipmentReport(id);
    }


    function hasClass(id, className) {
        var el = document.getElementById(id)
        if (el.classList)
            return el.classList.contains(className)
        else
            return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'))
    }

    function ViewDetails(tid) {

        window.location.href = "attendance_report.php?id=" + tid;
    }


    function addClass(id, className) {
        var el = document.getElementById(id)
        if (el.classList)
            el.classList.add(className)
        else if (!hasClass(el, className)) el.className += " " + className
    }

    function removeClass(id, className) {
        var el = document.getElementById(id)
        if (el.classList)
            el.classList.remove(className)
        else if (hasClass(el, className)) {
            var reg = new RegExp('(\\s|^)' + className + '(\\s|$)')
            el.className = el.className.replace(reg, ' ')
        }
    }
</script>

</html>