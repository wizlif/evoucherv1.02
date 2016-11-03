
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Ezy Voucher | Dashboard</title>

  <!-- Bootstrap core CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.3.css" />
  <link href="css/icheck/flat/green.css" rel="stylesheet" />
  <link href="css/floatexamples.css" rel="stylesheet" type="text/css" />

  <script src="js/jquery.min.js"></script>
  <script src="js/nprogress.js"></script>

  <!--For the highcharts-->
  <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>



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
<style>
    .stats .panel{
      padding:0 10px !important;
     height:80px;
        border-radius:10px;
    }
    
    .stats .panel .i{
      display:block;
      color:#fff;
      background:rgba(0,0,0,0.4);
      height:80px;
        text-align:center;
        
    } 
    
    
    .stats .panel .i i{
      font-size:2em;
     margin-top:25px;
        
      
        
    } 
    
    .stats .panel .tiny{
     font-size:0.8em;
        margin:0px;
        color:#fff;
        
    }
    
    .stats .panel .value{
      margin:0px;
        font-size:1.8em;
        color:#fff;
        opacity:0.9;
    }
    
    .stats .stat:nth-child(1) .stats{   
      background:#EF6C00;
    } 
    
    .stats .stat:nth-child(2) .stats{   
      background:#43A047;
    } 
    .stats .stat:nth-child(3) .stats{   
      background:#00838F;
    } 
    .stats .stat:nth-child(4) .stats{   
      background:#4DD0E1;
    } 
    .stats .stat:nth-child(5) .stats{   
      background:#EF6C00;
    } 
    
    .stats .col-md-3{
    
    }
    </style>

      <!-- page content -->
      <div class="right_col" role="main">
	  
	  <div class="row x_title">
	  <div class="col-md-12 col-sm-12 " >
				
                  <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                    <span></span> <b class="caret"></b>
                  </div>
				  
      </div>
	  </div>

    <div class="row x_panel" style="margin-bottom: 25px;">
      <div class="col-md-12">
        <div id="category4" 
            style="min-width: 230px; background: #888; height: 190px; margin: 0 auto"></div>
      </div>
<!--        <hr style="min-width: 100%; background: #fff; height: 0px; margin: 10px auto"/>-->
       <!--   
        <div  class="row top_tiles text-center" style="margin: 10px 0;">
            
			<div class="col-md-3 col-sm-3 col-xs-6 tile">
              <span>Total Trainings</span>
              <h2>231,809</h2>
              <span class="sparkline_one" style="height: 160px;">
                    <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                </span>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 tile">
              <span>Total Orders</span>
              <h2> 231,809</h2>
              <span class="sparkline_one" style="height: 160px;">
                    <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                </span>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 tile">
              <span>Total Payments</span>
              <h2> $ 231,809</h2>
              <span class="sparkline_two" style="height: 160px;">
                    <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                </span>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 tile">
              <span>Total Equipments Delivered</span>
              <h2>231,809</h2>
              <span class="sparkline_one" style="height: 160px;">
                    <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                </span>
            </div>
			
          </div>
        -->

          <div class="stats row" id="top_stats">
           
             
          </div>


    </div>
				
          
       <!-- top tiles -->
<!--
        <div id="top_stats" class="row tile_count" style="display:none">
        

        </div>
-->
        <!-- /top tiles -->

        
        <!--The pie charts start here-->

       <div class="row">
	   
	   
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="x_panel">



            <div class="row">
		
            <div class="col-md-6 col-sm-6 col-xs-12">
              
			<div id="category2" 
		     style="min-width: 250px; background: #888; height: 250px; margin: 0 auto"></div>
  
          
				<input type="hidden" id="trained_p"/>
				 <input type="hidden" id="untrained_p"/>
				<input type="hidden" id="complete_p"/>
               <input type="hidden" id="incomplete_p"/>
			  <input type="hidden"id="paid_p"/>
			  <input type="hidden"id="unpaid_p"/>
            </div>
			
			 <div class="col-md-6 col-sm-6 col-xs-12">
              
			<div id="pie" 
		     style="min-width: 250px; background: #888; height: 250px; margin: 0 auto"></div>
           
            </div>
			
          </div>




          </div>
          </div>
          </div>

        

        <!--The pie charts end here-->



      <!--the line graph starts here-->
        <div class="row">
         
		 <div class="col-md-12 col-sm-12 col-xs-12">
            
			<div class="dashboard_graph">
			  <div class="row x_title">
               
              </div>

              <!--For the line graph-->
              <div class="col-md-6 col-sm-6 col-xs-12 bg-white" >
                  <div id="container" style="min-width: 210px; height: 400px; margin: 0 auto"></div>
              </div>
			  
			   <!--For the line graph-->
			  <div class="col-md-6 col-sm-6 col-xs-12 bg-white" >
                  <div id="category3" style="min-width: 210px; height: 400px; margin: 0 auto"></div>
              </div>

            
              <div class="clearfix"></div>
            </div>
          </div>

        </div>
        <br />

        <div class="row">


            <!--Highchart pie charts-->

           <div class="col-md-4 col-sm-4 col-xs-12">
             <div id="container" style="min-width: 100px; height: 0px; max-width: 400px; margin: 0 auto"></div>
           </div>

		   

        </div>

        <!---footer -->

              <?php

              include('footer.php');

              ?>
      </div>
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

  <!-- gauge js -->
  <script type="text/javascript" src="js/gauge/gauge.min.js"></script>
  <script type="text/javascript" src="js/gauge/gauge_demo.js"></script>
  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="js/moment/moment.min.js"></script>
  <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
  <!-- chart js -->
  <script src="js/chartjs/chart.min.js"></script>

  <script src="js/custom.js"></script>

  <!-- flot js -->
  <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
  <script type="text/javascript" src="js/flot/jquery.flot.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.pie.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.orderBars.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.time.min.js"></script>
  <script type="text/javascript" src="js/flot/date.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.spline.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.stack.js"></script>
  <script type="text/javascript" src="js/flot/curvedLines.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.resize.js"></script>
  <script>
    
  </script>

  <!-- worldmap -->
  <script type="text/javascript" src="js/maps/jquery-jvectormap-2.0.3.min.js"></script>
  <script type="text/javascript" src="js/maps/gdp-data.js"></script>
  <script type="text/javascript" src="js/maps/jquery-jvectormap-world-mill-en.js"></script>
  <script type="text/javascript" src="js/maps/jquery-jvectormap-us-aea-en.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <!-- sparkline -->
  <script src="js/sparkline/jquery.sparkline.min.js"></script>
 
 
  <!-- /dashbord linegraph -->
  <!-- datepicker -->
  <script type="text/javascript">
  var start_date="";
  var end_date="";
  
  var refreshIntervalId=setInterval(getTopStatsRefresh,5000,start_date,end_date);
	
    $(document).ready(function() {
	$(".sparkline_two").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 4, 5, 4, 3, 5, 6], {
        type: 'line',
        width: '200',
        height: '40',
        lineColor: '#26B99A',
        fillColor: 'rgba(223, 223, 223, 0.57)',
        lineWidth: 2,
        spotColor: '#26B99A',
        minSpotColor: '#26B99A'
      });
        
        $(".sparkline_one").sparkline([2, 4, 3, 4, 5, 4, 5,9, 6, 9, 5, 4, 3, 5, 6], {
        type: 'line',
        width: '200',
        height: '40',
        lineColor: '#26B99A',
        fillColor: 'rgba(223, 223, 223, 0.57)',
        lineWidth: 2,
        spotColor: '#26B99A',
        minSpotColor: '#26B99A',
        tooltip: false
      });

      Chart.defaults.global.legend = {
        enabled: false
      };
	  
	
	  getTopStats(start_date,end_date);

	  getGraph(start_date,end_date);
      getGraph2(start_date,end_date);
      getGraph3(start_date,end_date);
      getGraph4(start_date,end_date);
      getGraph5(start_date,end_date);
	  
      var cb = function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        
		start_date=start.format('YYYY-MM-D');
		end_date=end.format('YYYY-MM-D');
		getGraph(start.format('YYYY-MM-D'),end.format('YYYY-MM-D'));
        getGraph2(start.format('YYYY-MM-D'),end.format('YYYY-MM-D'));
        getGraph3(start.format('YYYY-MM-D'),end.format('YYYY-MM-D'));
        getGraph4(start.format('YYYY-MM-D'),end.format('YYYY-MM-D'));
         getGraph5(start.format('YYYY-MM-D'),end.format('YYYY-MM-D'));
		getTopStats(start.format('YYYY-MM-D'),end.format('YYYY-MM-D'));
		clearInterval(refreshIntervalId);
		refreshIntervalId=setInterval(getTopStatsRefresh,5000,start.format('YYYY-MM-D'),end.format('YYYY-MM-D'));
		//setInterval(getTopStatsRefresh(start.format('YYYY-MM-D'),end.format('YYYY-MM-D')),5000);
		//alert("Callback has fired: [" + start.format('YYYY-MM-D') + " to " + end.format('YYYY-MM-D') + ", label = " + label + "]");
      }

      var optionSet1 = {
        startDate: moment().subtract(365, 'days'),
        endDate: moment(),
        minDate: '01/01/2010',
        maxDate: '12/31/2030',
        dateLimit: {
          days: 366
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
		  'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
		  'Last 1 Year': [moment().subtract(365, 'days'), moment()]
        },
        opens: 'right',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
        format: 'MM/DD/YYYY',
        separator: ' to ',
        locale: {
          applyLabel: 'Submit',
          cancelLabel: 'Clear',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom',
          daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          firstDay: 1
        }
      };
      $('#reportrange span').html(moment().subtract(365, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
      $('#reportrange').daterangepicker(optionSet1, cb);
      $('#reportrange').on('show.daterangepicker', function() {
        console.log("show event fired");
      });
      $('#reportrange').on('hide.daterangepicker', function() {
        console.log("hide event fired");
      });
      $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
      });
      $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
        console.log("cancel event fired");
      });
      $('#options1').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
      });
      $('#options2').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
      });
      $('#destroy').click(function() {
        $('#reportrange').data('daterangepicker').remove();
      });
    });
	
	
	 function getTopStats(date1,date2){
		  
              var token="get_top_stats";
	          $.post('form_actions/get_tables.php', {token: token,date1 : date1, date2 : date2}, function(data){

	          $("#top_stats").html(data);
			  ////////////////////////////////////////////////////////////
			  var trained=document.getElementById("trained").value;
	

	          var untrained=3500-trained;
			  
			  trainedp=(trained/3500)*100
			  trainedp =  trainedp.toFixed(2);
			  
			   $("#trained_p").html(trainedp+"%");
			   untrainedp=100-trainedp;
			   
			    $("#untrained_p").html(untrainedp+"%");
				
				//$('#reached').html("<div  class='progress-bar bg-green' role='progressbar' data-transitiongoal='"+30+"' ></div>");
			 
             var data = {labels: ["Trained","Not Trained"], 
			             datasets: [{ data: [trained, untrained],backgroundColor: ["#9B59B6","#BDC3C7"],
						 hoverBackgroundColor: ["#B370CF","#CFD4D8"]
						 }]
						 };
	
	         var canvasDoughnut = new Chart(document.getElementById("canvas1"), {
             type: 'doughnut',
             tooltipFillColor: "rgba(51, 51, 51, 0.55)",
             data: data
             });
             ////////////////////////////////////////////////////////////////
			 
			  var complete=document.getElementById("complete").value;
			   var incomplete=document.getElementById("incomplete").value;
			 
			 ttl=complete+incomplete;
			 
			 completep=(complete/ttl)*100
			 completep=completep.toFixed(2);
			 $("#complete_p").html(completep+"%");
			 
			 incompletep=100-completep;
			 incompletep=incompletep.toFixed(2);
			 $("#incomplete_p").html(incompletep+"%");
			 
			 
	         var data1 = {labels: ["Complete","Incomplete"],
                          datasets: [{ data: [ complete, incomplete],backgroundColor: ["#9B59B6","#BDC3C7"],
                          hoverBackgroundColor: ["#B370CF","#CFD4D8"]
						  }]
						  };
		   var canvasDoughnut1 = new Chart(document.getElementById("canvas2"), {
           type: 'doughnut',
           tooltipFillColor: "rgba(51, 51, 51, 0.55)",
            data: data1
           });
		   
		   ///////////////////////////////////////////////////////////////////////////////
		  
		  
		   var paid=document.getElementById("paid").value;
		   var unpaid=document.getElementById("unpaid").value;
		   
		   ttl2=paid+unpaid;
		 
		     paidp=(paid/ttl2)*100
			 paidp=paidp.toFixed(7);
			 $("#paid_p").html(paidp+"%");
			 
			 unpaidp=100-paidp;
			 unpaidp=unpaidp.toFixed(7);
			 $("#unpaid_p").html(unpaidp+"%");
		   
           var data2 = {labels: [ "Paid","Unpaid"],
           datasets: [{data: [paid, unpaid],backgroundColor: ["#9B59B6","#BDC3C7"],
           hoverBackgroundColor: ["#B370CF","#CFD4D8"]}]
           };

           var canvasDoughnut2 = new Chart(document.getElementById("canvas3"), {
           type: 'doughnut',
           tooltipFillColor: "rgba(51, 51, 51, 0.55)",
           data: data2
           });
		   
		   })
			  
	 }
	 
	 function getTopStatsRefresh(date1,date2){
		  
              var token="get_top_stats_refresh";
	          $.post('form_actions/get_tables.php', {token: token,date1 : date1, date2 : date2}, function(data){

	          $("#top_stats").html(data);
		//alert(date1+"" +date2);
	          });
			  
	 }
	 
	
  </script>
  <script>
    NProgress.done();
  </script>
  <!-- /datepicker -->
  <!-- /footer content -->



<!--script for the line graph-->

<script type="text/javascript">

 function getGraph(date1,date2){
	var token="get_graph";
			  
	 $.ajax({
	          dataType: "json",
              type: "POST",
              url: "form_actions/get_tables.php",
              data: {token: token,date1 : date1,date2 : date2},
              success: function(data) {
		       $('#container').highcharts(data);
              }
              });			   	 	  
              	   		  
	 }
	 
	 function getGraph2(date1,date2){
		  
              var token="get_graph2";
			  
			  $.ajax({
			   dataType: "json",
              type: "POST",
              url: "form_actions/get_tables.php",
              data: {token: token,date1 : date1, date2 : date2},
              success: function(data) {
		       $('#category3').highcharts(data);
		  
              }
              });
	        
			
			  
	 }
	 
	 function getGraph3(date1,date2){
		  
              var token="get_graph3";
			  
			  $.ajax({
			   dataType: "json",
              type: "POST",
              url: "form_actions/get_tables.php",
              data: {token: token,date1 : date1, date2 : date2},
              success: function(data) {
		       $('#category2').highcharts(data);
		  
              }
              });
	        
			
			  
	 }
	 
	  function getGraph4(date1,date2){
		  
              var token="get_graph4";
			  
			  $.ajax({
			   dataType: "json",
              type: "POST",
              url: "form_actions/get_tables.php",
              data: {token: token,date1 : date1, date2 : date2},
              success: function(data) {
		       $('#pie').highcharts(data);
		  
              }
              });  
	 }
	 
	 function getGraph5(date1,date2){
		  
              var token="get_graph5";
			  
			  $.ajax({
			   dataType: "json",
              type: "POST",
              url: "form_actions/get_tables.php",
              data: {token: token,date1 : date1, date2 : date2},
              success: function(data) {
		       $('#category4').highcharts(data);
		  
              }
              });  
	 }
	 
	

</script>

 <!-- dashbord linegraph -->
  <script>
    Chart.defaults.global.legend = {
      enabled: false
    };
 
 
 //window.alert(1);

  </script>

</body>

</html>
