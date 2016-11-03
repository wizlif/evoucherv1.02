<style>
    
</style>
<?php  session_start();?>
<?php 
include "./user_functions/session_store.php";

?>
<div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
            <a href="dashboard.php" class="site_title"><img style="width:25px"  src="images/logo.png" > <span>EzyVoucher</span></a>
          </div>
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <div class="profile hide">
            <div class="profile_pic">
              <img src="images/user.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2><?php echo $_SESSION["user_name"];
			  //echo $_SESSION["user_type"];?></h2>
            </div>
          </div>
          <!-- /menu prile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
<!--              <h3>Pay Easily!</h3>-->
              <ul class="nav side-menu">
                <li><a href="dashboard.php"><i class="fa fa-home"></i> DashBoard </span></a>
                  
                </li>
               <li><a><i class="fa fa-language"></i> Trainings <span class="fa fa-chevron-right"></span></a>
                  <ul class="nav child_menu" style="">
                    <li><a href="training.php">View Trainings</a>
                    </li>
                    <li><a href="calender.php">Training Schedules</a>
                    </li>
                    
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i> Orders & Payments <span class="fa fa-chevron-right"></span></a>
                  <ul class="nav child_menu" style="">
                    <li><a href="orders.php">Equipment Orders</a>
                    </li>
                    <li><a href="payments.php">Payments</a>
                    </li>
                  
                   
                  </ul>
				  </li>
				  
				  <li><a><i class="fa fa-truck"></i> Distribution<span class="fa fa-chevron-right"></span></a>
                  <ul class="nav child_menu" style="">
                 
				   <li><a href="delivery.php">Deliveries</a>
                    </li>
                    <li><a href="pending.php">Pending Deliveries</a>
                    </li>
                    
                   
                  </ul>
				  </li>
				  
                
                <li><a><i class="fa fa-pie-chart"></i>Reports<span class="fa fa-chevron-right"></span></a>
                  <ul class="nav child_menu" style="">
                    <li><a href="training_report.php">Trainings</a>
                   </li><!-- <li><a href="attendance_report.php">Attendance</a>
                    </li>-->
                    
                    
                  </ul>
                </li>
                
                
              </ul>
            </div>
            
          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <!--<a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>-->
            <a data-toggle="tooltip" href="index.php?logout=1" data-placement="top" title="Logout">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->