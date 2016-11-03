
  
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>EzyVoucher | Attendance</title>

  <!-- Bootstrap core CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">

  
  <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

    

   <link rel="stylesheet" type="text/css" href="main.css" media="screen">
  <link rel="stylesheet" type="text/css" href="print.css" media="print">
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
    </div></div>
      

      <!-- top navigation -->
      <?php
        include('navbar.php')

      ?>
      <!-- /top navigation -->

      <!-- page content -->
	  
<div class="right_col" role="main" style="background:#fff">
<div class="container-fluid">
<div id="image1"class="row ">
  <div class="col-md-4 col-sm-offset-6">
    <div class="logo">
      <img id="image" src="WFP_logo.gif" class="img-responsive hide-before-print">
    </div>
  </div>
</div>
<div class="container">
     
	    <div id="trainings_id_attendance"class="col-md-3 co-sm-12">
		<!--<select id="training_id" class="form-control">
            <option value="">Select</option>
            <option value="">Opt 2</option>
            <option Value="">Opt 1</option>
        </select>-->
		</div>
	  
	  <ul class="navbar-right"><a onclick=" printContent('image1','heading','table'); "class="btn btn-sm btn-default"><i class="fa fa-print"></i> &nbsp; Print Report</a></ul>
	  </div>

<div  id="heading" class="row">
  <div id="attendance_heading" class="col-md-12 wfp">
    <h4 id="attendance_heading_inner" class="text-center hide-before-print"> &nbsp; &nbsp;WFP POST-HARVEST LOSS FARMER TRAINING ATTENDANCE SHEET</h4>
  </div>
  
</div>

<div id="data"><!-- -->
  <div id="table"class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
        <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
          <caption  id="help" class="text-center hide-before-print">***To be completed by NGO partner (PLEASE FILL OUT FORM COMPLETELY AND WRITE LEGIBLY IN PEN)            ***CROSS OUT all unfilled cells to avoid tampering  
          </caption>
          <div id="details" >
          <caption id="partner" class="text-center hide-before-print"><!--Private Sector Partner: <b>AKORION</b> | Training Venue: <b>KIYUNI COMMUNITY HALL</b> |District: <b>MUBENDE</b> | Date: <b>19/042016</b> | WFP SPA in attendance? (circle one): <span><b>YES</b></span> &nbsp; | <span><b>NO</b></span>--></caption>
          </div>
		  <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Sex(M/F)</th>
              <th>Village</th>
              <th>Mobile Number</th>
              <th>Equipment</th>
              <th>Deposit Amount Paid</th>
              <th>Extra Payment Received</th>
              <th>Total Payment Received</th>
              <th>Total Remaining Balance Owed</th>
              <th>Voucher Serial Number</th>
            </tr>
          </thead>
          <tbody  id="attendence">
            <?php

            /*for ($i=1; $i<=20 ; $i++) { 
              # code...
              echo '

              <tr>
              <td>1</td>
              <td>SARAH KUTEESA</td>
              <td>F</td>
              <td>KAWUMU</td>
              <td>0774246306</td>
              <td>MMS</td>
              <td>20000</td>
              <td>N/A</td>
              <td>20000</td>
              <td>221000</td>
              <td>N/A</td>
            </tr>
              ';
            }*/

             ?>
          </tbody>
        </table>
      </div><!--end of .table-responsive-->
    </div>
  </div>

  </div><!-- -->
  
  </div>
    </div>
	
 <script src="js/bootstrap.min.js"></script>

        <!-- bootstrap progress js -->
        <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="js/icheck/icheck.min.js"></script>

        <script src="js/custom.js"></script>

<script type="text/javascript">
//window.alert(1);
$(document).ready(function() {


//removeClass("attendance_heading_inner", "hide-before-print");

//window.alert(hasClass("attendance_heading_inner", "hide-before-print"));

getTrainings();
//var id= getQueryVariable('id');
//getAttendance(id);
});

function getTrainings(){
		  
          var token="get_trainings_for_attendance";
			  $.post('form_actions/get_tables.php', {token: token}, function(data){
	          $("#trainings_id_attendance").html(data);
			  var id= getQueryVariable('id');
			  //var e = document.getElementById("training_id");
			  $('#training_id').val(id);
             // e.options[e.selectedIndex].value=id;
			   ;
			  getAttendance(id);
	          });	  
}

function getAttendance(id){
		  getTrainingDetails(id);
          var token="get_attendance_report";
			  $.post('form_actions/get_tables.php', {token: token,id:id}, function(data){
	          $("#attendence").html(data);
	          });	  
}


function getTrainingDetails(id){
		  
          var token="get_attendance_report_details";
			  $.post('form_actions/get_tables.php', {token: token,id:id}, function(data){
	          $("#details").html(data);
	          });	  
}

(function () {

        var beforePrint = function () {
           // alert('Functionality to run before printing.');
			removeClass("attendance_heading_inner", "hide-before-print");
			removeClass("image","hide-before-print");
			removeClass("help","hide-before-print");
			removeClass("partner","hide-before-print");
			//alert(hasClass("attendance_heading_inner", "text-center"));
        };

        var afterPrint = function () {
            //alert('Functionality to run after printing');
			addClass("attendance_heading_inner", "hide-before-print");
			addClass("image", "hide-before-print");
			addClass("help","hide-before-print");
			addClass("partner","hide-before-print");
			
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
function selectTraining(){
var e = document.getElementById("training_id");
var id = e.options[e.selectedIndex].value;
 
getAttendance(id);
}

 function getQueryVariable(variable) {
         var query = window.location.search.substring(1);
         var vars = query.split("&");
         for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        if (pair[0] == variable) {
         return pair[1];
         }
         }

         }
function printContent(el0,el,el1){
    var e = document.getElementById("training_id");

    var title = e.options[e.selectedIndex].text;
    $("#attendance_heading").html(' <h4 id="attendance_heading_inner" class="text-center hide-before-print">'+ ''+title+' FARMER TRAINING ATTENDANCE SHEET'+'</h4>');	  
	
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el0).innerHTML + document.getElementById(el).innerHTML + document.getElementById(el1).innerHTML;
	
	document.body.innerHTML = printcontent;
	window.print();
	
	document.body.innerHTML = restorepage;
}



function hasClass(id, className) {
  var el = document.getElementById(id)
  if (el.classList)
    return el.classList.contains(className)
  else
    return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'))
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
    el.className=el.className.replace(reg, ' ')
  }
}
</script>

</body>


</html>