<?php  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>EzyVoucher | Tranings</title>

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


            <div class="col-md-6 col-sm-12 col-xs-12">
            <h2 class="page-header">Settings</h2>
                
				<form class="form-horizontal" method="" action="" >
                  <div class="form-group">
                    <label>Targeted Farmers To Be Trained </label><input id="farmer" type="number"   name="farmer" class="form-control col-sm-10"  />
                  </div>
                  <div class="form-group">
                    <label>Targeted Equipment To Be Ordered </label><input id="order" type="number"   name="order" class="form-control col-sm-10"  />
                  </div>
                  <div class="form-group">
                    <label>Targeted Equipment To Be Distributed </label><input id="distribution" type="number"  name="distribution" class="form-control col-sm-10"  />
                  </div>
                  <button type="submit" onclick="insertConstants();" class="btn btn-primary">Save Changes</button>
                </form>
				
            </div>
                </div>
                <div id="push" style="height:28em;"></div>
              </div>
              <!---footer -->

        <?php include('footer.php');?>
            </div>


            <!-- /page content -->


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


		 <!-- daterangepicker -->
  <script type="text/javascript" src="js/moment/moment.min.js"></script>
  <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
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

          getConstants();

          });


       
		   function insertConstants(){

			 var doc_farmer = document.getElementById("farmer");
			 farmer=doc_farmer.value;

			 var doc_order = document.getElementById("order");
			 order=doc_order.value;

			 var doc_distribution = document.getElementById("distribution");
			 distribution=doc_distribution.value;


              var token="add_constants";
	          $.post('form_actions/get_tables.php', {token: token ,farmer: farmer,order :order ,distribution :distribution}, function(data){

				 location.reload();
		      })
		   }
		   
		    function getConstants(){
		  
              var token="get_constants";
			  
			  $.ajax({
			   dataType: "json",
              type: "POST",
              url: "form_actions/get_tables.php",
              data: {token: token},
              success: function(data) {
			
		   var doc_farmer = document.getElementById("farmer");
			doc_farmer.value=data.farmers;

			 var doc_order = document.getElementById("order");
			 doc_order.value=data.orders;

			 var doc_distribution = document.getElementById("distribution");
			doc_distribution.value=data.distribution;
              }
              });
		  
	 }

        </script> 
</body>

</html>
