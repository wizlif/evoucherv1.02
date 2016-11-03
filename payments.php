
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>EzyVoucher | Payments</title>

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
      <div class="right_col" role="main" id="wrap">
        <div class="">
          
          <div class="clearfix"></div>

          <div class="row">
           

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Payments</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  
                  
                  <table id="datatable-fixed-header" class="table blue table-striped table-bordered">
                    

                    <?php 
                   
                    ?>


                    <tbody>
                      
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                  
                </div>
               <div id="push" style="height: 30em;"></div>
              </div>
              <!---footer -->

              <?php

              include('footer.php');

              ?>

            </div>
            <!-- /page content -->
         


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
        
        <script type="text/javascript">
          $(document).ready(function() {
            
            //table.destroy();
            getPayments();

   
          });
		  
		  function setId(id){
		     var doc_id = document.getElementById("id");
			 doc_id.value=id;
		  }
		  
		  function getOrderDelivery(){
		  
		     var doc_id = document.getElementById("id");
			 id=doc_id.value;
              var token="get_order_delivery";
	          $.post('form_actions/get_tables.php', {token: token,id:id}, function(data){
             
			   maketoast();
	          
			  location.reload();
			  
			  });
			  
			  }
		  
		  function getPayments(){
		  
              var token="get_payments";
	          $.post('form_actions/get_tables.php', {token: token}, function(data){
//window.alert(data);
	          $("#datatable-fixed-header").html(data);
			  
			  $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#datatable-responsive').DataTable();
            $('#datatable-scroller').DataTable({
              ajax: "js/datatables/json/scroller-demo.json",
              deferRender: true,
              scrollY: 380,
              scrollCollapse: true,
              scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({
              
                    // fixedHeader: true,

               dom: "Bfrtip",
                
                buttons: [{
                  extend: "copy",
                  className: "btn-sm"
                }, {
                  extend: "csv",
                  className: "btn-sm"
                }, {
                  extend: "excel",
                  className: "btn-sm"
                }, {
                  extend: "pdf",
                  className: "btn-sm"
                }, {
                  extend: "print",
                  className: "btn-sm"
                }],
                responsive: !0,


         
              });

			  });
			  
			  
			  }
          TableManageButtons.init();
        </script>


<!--script for notification-->
<script type="text/javascript">
    var permanotice, tooltip, _alert;
    $(function() {
      
  //maketoast();
    });

    function maketoast(){
    new PNotify({
        title: "Delivery ordered",
        type: "info",
        text: "You have successfully ordered for the delivery of the Equipment. Check with the field Team",
        nonblock: {
          nonblock: true
		  
        },
        before_close: function(PNotify) {
          // You can access the notice's options with this. It is read only.
          //PNotify.options.text;

          // You can change the notice's options after the timer like this:
         
          return false;
        }
		
      });

    }
  </script>

  <!--script for notification Ends here-->


</body>

</html>
