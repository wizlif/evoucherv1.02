

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>EzyVoucher | Training Details</title>

  <!-- Bootstrap core CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
    <link href="css/trainings.css" rel="stylesheet">

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
      <div class="right_col" role="main">
        <div class="">



          <div class="row">

            <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2> Training Details </h2>

                  <div class="clearfix"></div>
                </div>

                    <!-- /MAIL LIST -->


                    <!-- CONTENT MAIL -->
                    <div class="col-sm-12">
                      <div class="">


                        <div id="top_details" class="mail_heading row">




					   </div>




                          <div class="col-md-12 col-sm-12 col-xs-12">
              <hr>



                  <table id="datatable-fixed-header" class="table blue table-striped table-bordered">

                    <tbody>


                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                          <div class="compose-btn pull-left">
                            <a onclick="goBack()" class="btn btn-sm btn-primary" ><i class="fa fa-reply"></i> Back</a>

                          </div>
                        </div>

                      </div>


                     <div  id="get_trainings_side" class="col-sm-2 mail_list_column"><!-- trainings list--></div>


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
           getEvents();
            getTopDetails();


          });

		  function  getTopDetails(){


               var id= getQueryVariable('id');


				if (id === undefined) {

				getAttendance("all");

                } else {
                var token="get_top_details";
	          $.post('form_actions/get_tables.php', {token: token,id : id}, function(data){

	          $("#top_details").html(data);

			  getAttendance(id);
			  });

               }


		 }
		  function goBack() {
    window.history.back();
}


           function  getEvents(){

              var token="get_trainings_side";
	          $.post('form_actions/get_tables.php', {token: token}, function(data){

	     //  $("#get_trainings_side").html(data);
			  });
			 }
		   function  getAttendance(id){

              var token="get_attendance";
	          $.post('form_actions/get_tables.php', {token: token,id : id}, function(data){

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
       </script>


</body>

</html>
