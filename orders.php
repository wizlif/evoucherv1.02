
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>EzyVoucher | Equipment Orders</title>

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
                  <h2>Equipment Orders</h2>
                  
                  <div class="clearfix"></div>
                  
				  <?php 
				 
				  //echo $_SESSION["user_type"];
				  if(isset($_SESSION["user_type"])&&$_SESSION["user_type"]=="Client"){
				  
				  
				  }else{
				  
				  echo"<a class=\"btn-default btn btn-xs right\" data-toggle='modal' data-target='.export'>Import Payments</a>";
				  
				  echo"<a class=\"btn-default btn btn-xs right\" data-toggle='modal' data-target='.export_orders'>Import Orders</a>";
				  }
				  
				  
				  ?>
                  
                </div>
                <div class="x_content">
                  
                  
                  <table id="datatable-fixed-header" class="table blue table-striped table-bordered">
                    


                    <?php 
                    
/*
                    for ($x = 0; $x <= 30; $x++) {
                      echo "<tr>
                        <td>Mulimi Akorion</td>
                        <td>0788116118</td>
                        <td>WFP-007</td>
                        <td>Large Metallic Sillo</td>
                        <td>360,000</td>
                        <td>40,000</td>
                        <td>320,000</td>
                        <td>18/04/2016</td>
                        
                        <td> <a href='details.php' class='btn btn-default btn-xs'>View Details</an> </td>
                      </tr>";
                        } 
*/
                    ?>


                    <tbody>
                      
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                  
                </div>
             
              
              <!---footer -->
              
              <!--modal-->
            <div class="modal fade bs-example-modal-lg export" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                     <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Import CSV</h4>
                      </div>
                      
					  	<form id="import_payments"  method="post" action="form_actions/get_tables.php" enctype="multipart/form-data">
                       <div class="panel" style="padding: 20px;">
					   
					   <input type="hidden"  name="token" value="import_csv"/>
					   <input id="csv" type="file" accept=".csv" name="csv" value="choose csv"/>
                       
                       </div>
                       
					   <div class="modal-footer">
			
                        <a onclick="submitCSV();" class='btn btn-warning btn-sm'>Submit</a>   
                       </div>

                       </form> 
            
                      </div>


            </div>
            
            </div>
			
			
			  <!--modal-->
            <div class="modal fade bs-example-modal-lg export_orders" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                     <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Import Orders CSV</h4>
                      </div>
                      
					  	<form id="import_orders"  method="post" action="form_actions/get_tables.php" enctype="multipart/form-data">
                       <div class="panel" style="padding: 20px;">
					   
					   <input type="hidden"  name="token" value="import_orders_csv"/>
					   <input id="csv" type="file" accept=".csv" name="csv" value="choose csv"/>
                       
                       </div>
                       
					   <div class="modal-footer">
			
                        <a onclick="submit_Orders_CSV();" class='btn btn-warning btn-sm'>Submit</a>   
                       </div>

                       </form> 
            
                      </div>


            </div>
            
            </div>
            <div id="push" style="height:30em;"></div>
            </div>
            
            <?php include('footer.php');?>
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
		  
			 getOrders();
            
          });
          TableManageButtons.init();
		  
		  function submit_Orders_CSV(){
		  
		  document.getElementById("import_orders").submit();
		  }
		  
		  function submitCSV(){
	        document.getElementById("import_payments").submit()
	      }
		  function getOrders(){
		  
              var token="get_orders";
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
              scrollY: 700,
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
        </script>
</body>

</html>
