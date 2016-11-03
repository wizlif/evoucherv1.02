
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>EzyVoucher | Pending Deliveries</title>

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
                  <h2>Pending Deliveries</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  
                  
                  <table id="datatable-fixed-header" class="table blue table-striped table-bordered">

                    <!--Modal for confirmation-->

                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Delivered BY</h4>
                      

            </div>


            <div class="row">
            <div class="col-md-8 col-xs-8">
              <div class="x_panel">
                
                <div class="x_content">
                  <br />
                 

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <input type="text" class="form-control has-feedback-left" id="inputname" placeholder="Name">
                      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>

          <input id="id" type="hidden" />
                 
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <input type="text" class="form-control" id="inputphone" placeholder="Phone">
                      <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                    </div>

                    </div>
                    
                   
                    
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="submit" data-dismiss="modal" class="btn btn-primary">Cancel</button>
                        <button type="submit"  data-dismiss="modal" onclick="registerDelivery()" class="btn btn-success">Submit</button>
                      </div>
                    </div>

                 
                </div>
              </div>


            </div>


            
          </div>



                     

                    </div>
                  </div>
                </div>
                    <!-- <tbody>
                      
                      
                    </tbody> -->
                  </table>
                  </div>
                  </div>
                  </div>
                

          </div><!--row end -->
          <!---footer -->
          <div id="push" style="height: 30em;"></div>
             
          </div>
        
           <?php  include('footer.php');?>
              
              </div><!-- end of main  wrap-->


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

		<!-- daterangepicker -->
  <script type="text/javascript" src="js/moment/moment.min.js"></script>
  <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
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
       
            getPending();
			
			
          });
          TableManageButtons.init();
		  
		  function getID(id){
		    
			var id_holder = document.getElementById("id");
			id_holder.value= id;
			 
		   }
		  
		   function registerDelivery(){
		    
			var name_holder = document.getElementById("inputname");
			 name=name_holder.value;
			 var phone_holder = document.getElementById("inputphone");
			 phone=phone_holder.value;
			 var id_holder = document.getElementById("id");
			 id=id_holder.value;
		  
              var token="register_delivery";
	          $.post('form_actions/get_tables.php', {token: token, id: id, name : name, phone: phone}, function(data){
		      closeModal();
			  location.reload();
			  
			  });
		  
		  }
		  
		   function getPending(){
		  
              var token="get_pending";
	          $.post('form_actions/get_tables.php', {token: token}, function(data){

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
			
			function closeModal(){
			  $('a.close').click();
			}
        </script>
</body>

</html>
