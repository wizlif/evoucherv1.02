
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>EzYvoucher | Payments</title>

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
        border-top-right-radius:10px;
    }
    
    .table-installments tr:first-child td:first-child{
        border-top-left-radius:10px;
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
    caption{
     padding-left:10px;
    }
</style>
<div class="container-fluid">
<div class="col-md-4">
    <h4><a>Payments</a> / Payment Details</h4>
    
    </div>
    
    <ul class="navbar-right" style=" margin-top:10px;">
      <a class="btn btn-sm btn-success"><i class="fa fa-arrow-down"></i> Export Report</a>
      <a class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print Report</a>
     
    </ul>

</div>
<div class="x_panel">

    <div class="container-fluid">
     
      <div class="col-md-12">  
          <div class="row" id="farmer_profile">
            
          </div>
          
          <hr/>
          <div class="row">
              
          
          
          <div class="col-md-12">
          <table id="datatable" class="table table-rounded table-installments" style="opacity:0.8">
              <caption>Installment Details</caption>
                    
                      <tr class="headings">
                       

                        <td>Date</td>
                        <td>Amount paid</td>
                        <td>Balance</td>
                        <td>Cummulative payment</td>
                        <td>Total payment(%)</td>
                        <td>Received by</td>
                                    
                      </tr>
                    
                      <?php for($i=0; $i<3;$i++){
                echo ' <tr onclick="openProduct(32)" class="even pointer">
                        
                        <td class=" ">2/June/2016</td>
                        <td class=" ">12,000</td>
                        <td class=" ">60,000</td>
                        <td class=" ">800,000</td>
                        <td class=" ">12%</td>
                        <td class=" ">Hellen</td>
                       
                        
                      </tr>';}
                      ?>
                    
                  </table>
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


          <!-- Modal -->
    <div class="modal fade" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h1><i class="fa fa-truck"></i> Order Delivery</h1>
                </div>
				<input type="hidden" id="id"/>
                <div class="modal-body">
                Are you sure you want to Order the delivery of the Equipment to this Farmer.?
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="getOrderDelivery()"class="btn btn-success pull-right" data-dismiss="modal">Order Delivery</button>
                     <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" onclick="">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Modal -->

   
      

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
function goBack() {
    window.history.back();
}

function printContent(el,el1){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML + document.getElementById(el1).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
 </script>
  
        </script>




  <!--script for notification Ends here-->


</body>

</html>
