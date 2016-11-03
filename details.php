<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>EzyVoucher | Farmer Payment Details</title>

  <!-- Bootstrap core CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">


  <script src="js/jquery.min.js"></script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    
    <style>
    .user-info #name{
      font-size:1.4em;
      color:#555;   
    }
    
    .user-info #phone{
     color:#999;
    }
    
    p{
     margin:0px !important;
        line-height:1em;
        padding:5px;
        font-size:1em;
    }
    span{
     margin:0px;
       
    }
    
    .table-installments tr:first-child td:last-child{
        border-top-right-radius:0px;
    }
    
    .table-installments tr:first-child td:first-child{
        border-top-left-radius:0px;
    }
    .table-installments tr:first-child td{
     border-top:0px;
     background:#f0f0f0;
     color:#000;
    
    }
    
    .table-installments td{
     color:#555;
     padding: 3px 10px !important;
    }
        
    .table-summary td{
     border-top:1px solid #eee !important;
    }
    .table-summary tr td:nth-child(2){
     border-left:1px solid #eee !important;
    }
    caption{
     padding-left:10px;
     color:cadetblue
    }
        a{cursor:pointer}
        
        hr{
        margin:4px 0;}
    </style>
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
<div class="container-fluid">
<div class="col-md-4">
 <!--<div class="compose-btn pull-left">-->
                            <a onclick="history.back()" class="btn btn-sm btn-primary" style="margin-right:10px;" ><i class="fa fa-reply"></i> Back</a>

                         <!-- </div>-->
    <!--<h4><a onclick="history.back()"><i class="fa fa-angle-left" style="margin-right:10px;"></i>Back</a></h4>-->
    
    </div>
    
    <ul class="navbar-right" style=" margin-top:10px;">
<!--      <a class="btn btn-sm btn-success"><i class="fa fa-arrow-down"></i> Export Report</a>-->
      <a class="btn btn-sm btn-default" onclick=" printContent('farmer_profile','data1')" data-placement="top"><i class="fa fa-print"></i> Print Details</a>
     
    </ul>

</div>
          <div class="row">

            <div class="col-md-12">
              <div class="x_panel">
                <div class="x_content">


                  <div class="row">

                    
                    <!-- /MAIL LIST -->


						 

<!--						  <h4>Farmer Payment Details </h4>-->
                        
                          <div id="farmer_profile" class="col-md-12 header-details">
                           
						
						   
                          </div><!--dsdd -->
						 
                        </div>
                        <hr/>
                        
              <div id="data1" class="col-md-12 col-sm-12 col-xs-12"><!-- -->
             
                  
                  <table class="table table-bordered table-installments" id="datatable-fixed-header"style="opacity:1">
                    
                  </table>
                
            </div> <!-- -->

			
                        </div>

                      </div>
                      <!-- /CONTENT MAIL -->
                  </div>
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

        <!-- bootstrap progress js -->
        <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="js/icheck/icheck.min.js"></script>

        <script src="js/custom.js"></script>

        <!-- pace -->
        <script src="js/pace/pace.min.js"></script>
        
        
        <!-- pace -->
        <script src="js/pace/pace.min.js"></script>
         <script src="js/easypie/jquery.easypiechart.min.js"></script>
  <script src="js/pace/pace.min.js"></script>

  <script>
    $(function() {
      $('#chart_learning').easyPieChart({
        easing: 'easeOutElastic',
        delay: 1000,
        barColor: '#26B99A',
        trackColor: '#f0f0f0',
        scaleColor: false,
        lineWidth: 10,
        trackWidth: 16,
        lineCap: 'butt',
        onStep: function(from, to, percent) {
          $(this.el).find('.percent').text(Math.round(percent));
        }
      });
      var chart = window.chart = $('.chart').data('easyPieChart');
      $('.js_update').on('click', function() {
        chart.update(Math.random() * 200 - 100);
      });
    });
  </script>
   <script type="text/javascript">

 $(document).ready(function() {
 getProfiles();
 });
 
 function getInstallments(){
 var getId = getQueryVariable("id");
 
              var token="get_installments";
	          $.post('form_actions/get_tables.php', {token: token,id:getId}, function(data){
	          $("#datatable-fixed-header").html(data);
              });
}	
 
 function getProfiles(){
 var getId = getQueryVariable("id");
 
              var token="get_profile";
	          $.post('form_actions/get_tables.php', {token: token,id:getId}, function(data){
	          $("#farmer_profile").html(data);
			  getInstallments();
             
                  $('#chart_learning').easyPieChart({
                easing: 'easeOutElastic',
                delay: 1000,
                barColor: '#26B99A',
                trackColor: '#f0f0f0',
                scaleColor: false,
                lineWidth: 10,
                trackWidth: 16,
                lineCap: 'butt',
                onStep: function(from, to, percent) {
                  $(this.el).find('.percent').text(Math.round(percent));
        }
      });
              });
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

function printContent(el,el1){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML + document.getElementById(el1).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
 </script>
  
  
</body>

</html>
 