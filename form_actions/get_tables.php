<?php
session_start();
#includes
require_once "../user_functions/json_models_class.php";
require_once "../php_lib/lib_functions/utility_class.php";

$json_obj = new JSONModel();
$util_obj = new Utilties();

$page = !empty($_POST['page']) ? (int)$_POST['page'] : 1;
$per_page = !empty($_POST['per_page']) ? (int)$_POST['per_page'] : 10;//10

//$_POST['token']='get_graph3';

if (isset($_POST['token'])) {
    switch ($_POST['token']) {

        case 'login' :
            if (isset($_POST['useremail']) && $_POST['useremail'] != "" &&
                isset($_POST['password']) && $_POST['password'] != ""
            ) {
                $useremail = $_POST['useremail'];
                $password = $_POST['password'];

                if ($json_obj->get_count("evoucher_adminlogin_tb", " user_email = '$useremail' AND user_password = '$password' ") > 0) {

                    $rows = $json_obj->fetch_rows_byQuery("SELECT id ,user_name,user_type FROM evoucher_adminlogin_tb WHERE user_email='$useremail' AND user_password='$password'");
//echo $rows[0]['user_name']." ".$rows[0]['id'];
                    $_SESSION["user_name"] = $rows[0]['user_name'];//this is what the user uses to login
                    $_SESSION["login_id"] = $rows[0]['id'];
                    $_SESSION["user_type"] = $rows[0]['user_type'];

                    $util_obj->redirect_to("../dashboard.php");
                } else {

                    $util_obj->redirect_to("../index.php?sucess=0&flag=-1");
                }
            } else {


                $util_obj->redirect_to("../index.php?sucess=0&flag=0");
            }

            break;
        case 'get_top_stats' :
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
            if ($date1 != "" && $date2 != "") {

                $orders = $json_obj->get_count("evoucher_orders_tb", "DATE(time_stamp) >= DATE '$date1' AND DATE(time_stamp) <= DATE '$date2'");
                $equipments_delivered = $json_obj->get_count("evoucher_deliveries_tb", "DATE(time_stamp) >= DATE '$date1' AND DATE(time_stamp) <= DATE '$date2'");
                $pending_deliveries = $json_obj->get_count("evoucher_orders_tb", " deliver_status='Pending Delivery' AND DATE(time_stamp) >= DATE '$date1' AND DATE(time_stamp) <= DATE '$date2'");

                $ttl_fully_paid_equipments = $equipments_delivered + $pending_deliveries;

                $trainings = $json_obj->get_count("evoucher_attendace_v", " attendence>0 AND DATE(training_date) >= DATE '$date1' AND DATE(training_date) <= DATE '$date2'");

                $male = $json_obj->get_count("evoucher_attendace_sheet_v", " gender='male' AND DATE(training_date) >= DATE '$date1' AND DATE(training_date) <= DATE '$date2'");

                $female = $json_obj->get_count("evoucher_attendace_sheet_v", " gender='female' AND DATE(training_date) >= DATE '$date1' AND DATE(training_date) <= DATE '$date2' ");

                $trained_VAs = $json_obj->get_sum("evoucher_attendace_v", "attendence", "DATE(training_date) >= DATE '$date1' AND DATE(training_date) <= DATE '$date2'");;
                $total_cash = $json_obj->get_sum("evoucher_order_v", "deposit", "DATE(time_stamp) >= DATE '$date1' AND DATE(time_stamp) <= DATE '$date2'");

                $expected_cash = $json_obj->get_sum("evoucher_order_v", "selling_price", "DATE(time_stamp) >= DATE '$date1' AND DATE(time_stamp) <= DATE '$date2'");
                $trained = $male + $female;

                $total_cash = $total_cash == "" ? 0 : $total_cash;

                $paid = $json_obj->get_sum("evoucher_order_v", "deposit", 1);
                $unpaid = $expected_cash - $paid_cash;

                $complete = $json_obj->get_count("evoucher_order_v", " deposit=selling_price ");
                $incomplete = $orders - $complete;


            } else {
                $orders = $json_obj->get_count("evoucher_orders_tb", 1);
                $equipments_delivered = $json_obj->get_count("evoucher_deliveries_tb", 1);
                $pending_deliveries = $json_obj->get_count("evoucher_orders_tb", " deliver_status='Pending Delivery'");

                $ttl_fully_paid_equipments = $equipments_delivered + $pending_deliveries;

                $trainings = $json_obj->get_count("evoucher_attendace_v", " attendence>0 ");

                $male = $json_obj->get_count("evoucher_attendace_sheet_v", " gender='male' ");

                $female = $json_obj->get_count("evoucher_attendace_sheet_v", " gender='female' ");

                $trained_VAs = $json_obj->get_sum("evoucher_attendace_v", "attendence", 1);;
                $total_cash = $json_obj->get_sum("evoucher_order_v", "deposit", 1);

                $total_cash = $total_cash == "" ? 0 : $total_cash;
                $expected_cash = $json_obj->get_sum("evoucher_order_v", "selling_price", 1);
                $trained = $male + $female;


                $paid = $json_obj->get_sum("evoucher_order_v", "deposit", 1);
                $unpaid = $expected_cash - $paid_cash;

                $complete = $json_obj->get_count("evoucher_order_v", " deposit=selling_price ");
                $incomplete = $orders - $complete;

            }


            if ($total_cash > 1000000) {

                $total_cash_ = ($total_cash / 1000000);

                $total_cash = $total_cash_ . "M";
            }


            echo '

<div class="col-md-3 col-sm-6 col-xs-6 stat animated flipInX">
                 <a href="metrics.php">
                  <div class="stat-item panel tile">
                    <div class="stats row">
                      <div class="col-md-4 i">
                          <i class="fa fa-language"></i>
                        </div>
                        <div class="col-md-8" style="padding:10px;">
                          <p class="tiny">TRAININGS</p>
                          <p class="value">' . $trainings . '</p>

                          <table>
                          <tr>

                           <td>Male ' . $male . '</td>
                           <td>Female ' . $female . '</td>
                          </tr>
                          </table>
                        </div>
                    </div>
                  </div>
				  </a>
              </div>

<div class="col-md-3 col-sm-6 col-xs-6 stat animated flipInX">
              <a href="orders.php">
                  <div class="stat-item panel tile">
                    <div class="stats row">
                      <div class="col-md-4 i">
                          <i class="fa fa-edit"></i>
                        </div>
                        <div class="col-md-8" style="padding:10px;">
                          <p class="tiny">TOTAL ORDERS</p>
                          <p class="value">' . $orders . '</p>
						  <input id="trained" type="hidden" value="' . $trained_VAs . '"/>
                          <input id="complete" type="hidden" value="' . $complete . '"/>
			             <input id="incomplete" type="hidden" value="' . $incomplete . '"/>
                        </div>
                    </div>
                  </div>
				  </a>
              </div>

			  <div class="col-md-3 col-sm-6 col-xs-6 stat animated flipInX">
			    <a href="payments.php">
                  <div class="stat-item panel tile">
                    <div class="stats row">
                      <div class="col-md-4 i">
                          <i class="fa fa-money"></i>
                        </div>
                        <div class="col-md-8" style="padding:10px;">
                          <p class="tiny">TOTAL PAYMENTS</p>
                          <p class="value">' . $total_cash . '</p>
                           <input id="paid" type="hidden" value="' . $paid . '"/>
                           <input id="unpaid" type="hidden" value="' . $unpaid . '"/>
                        </div>
                    </div>
                  </div>
				   </a>
              </div>

			  <div class="col-md-3 col-sm-6 col-xs-6 stat animated flipInX">
			      <a href="delivery.php">
                  <div class="stat-item panel tile">
                    <div class="stats row">
                      <div class="col-md-4 i">
                          <i class="fa fa-truck"></i>
                        </div>
                        <div class="col-md-8" style="padding:10px;">
                            <p class="tiny"><b>EQUIPMENT DELIVERED</b></p>
                          <p class="value">' . $equipments_delivered . ' of ' . $ttl_fully_paid_equipments . '</p>
                        </div>
                    </div>
                  </div>
				  </a>
              </div>

';

//echo"
//
//<div class=\"animated flipInX col-md-2 col-sm-4 col-xs-4 tile_stats_count\">
//            <div class=\"left\"></div>
//            <div class=\"right\">
//              <span class=\"count_top\"><i class=\"fa fa-user\"></i> Total Trainings</span>
//              <div class=\"count green\">$trainings</div>
//              <span class=\"count_bottom\"><a href=\"training.php\" class=\"blue fa fa-sort-asc\"> view more</a></span>
//            </div>
//          </div>
//          <div class=\"animated flipInX col-md-2 col-sm-4 col-xs-4 tile_stats_count\">
//            <div class=\"left\"></div>
//            <div class=\"right\">
//              <span class=\"count_top\"><i class=\"fa fa-user\"></i> Farmers Trained</span>
//              <div class=\"container\">
//              <div class=\"count blue col-md-2\">
//               $trained_VAs
//              </div>
//              <ul class=\"navbar-right gender\">
//              <label>M : $male</label><br/>
//              <label>F : $female</label>
//              </ul>
//              </div>
//			  <input id=\"trained\" type=\"hidden\" value=\"$trained_VAs\"/>
//             <span class=\"count_bottom\"><a href=\"metrics.php\" class=\"blue fa fa-sort-asc\"> view more</a></span>
//            </div>
//          </div>
//          <div class=\"animated flipInX col-md-2 col-sm-4 col-xs-4 tile_stats_count\">
//            <div class=\"left\"></div>
//            <div class=\"right\">
//              <span class=\"count_top\"><i class=\"fa fa-user\"></i> Total Orders</span>
//              <div class=\"count blue\">$orders</div>
//			  <input id=\"complete\" type=\"hidden\" value=\"$complete\"/>
//			  <input id=\"incomplete\" type=\"hidden\" value=\"$incomplete\"/>
//             <span class=\"count_bottom\"><a href=\"orders.php\" class=\"blue fa fa-sort-asc\"> view more</a></span>
//            </div>
//          </div>
//
//          <div class=\"animated flipInX col-md-2 col-sm-4 col-xs-4 tile_stats_count\">
//            <div class=\"left\"></div>
//            <div class=\"right\">
//              <span class=\"count_top\"><i class=\"fa fa-user\"></i> Total Cash</span>
//              <div class=\"count green\">$total_cash</div>
//			    <input id=\"paid\" type=\"hidden\" value=\"$paid\"/>
//			   <input id=\"unpaid\" type=\"hidden\" value=\"$unpaid\"/>
//              <!--<span class=\"count_bottom\"><i class=\"green\"><i class=\"fa fa-sort-asc\"></i>34% </i> From Yesterday</span>-->
//            </div>
//          </div>
//		  <div class=\"animated flipInX col-md-2 col-sm-4 col-xs-4 tile_stats_count\">
//            <div class=\"left\"></div>
//            <div class=\"right\">
//              <span class=\"count_top\"><i class=\"fa fa-user\"></i> Equipments Delivered</span>
//              <div class=\"count\">$equipments_delivered</div>
//              <span class=\"count_bottom\"><a href=\"delivery.php\" class=\"blue fa fa-sort-asc\"> view more</a></span>
//            </div>
//          </div>
//          <div class=\"animated flipInX col-md-2 col-sm-4 col-xs-4 tile_stats_count\">
//            <div class=\"left\"></div>
//            <div class=\"right\">
//              <span class=\"count_top\"><i class=\"fa fa-user\"></i> Pending Deliveries</span>
//              <div class=\"count red\">$pending_deliveries</div>
//              <span class=\"count_bottom\"><a href=\"pending.php\" class=\"blue fa fa-sort-asc\"> view more</a></span>
//            </div>
//          </div>
//
//";


            break;

        case 'get_trainings_for_training':

            $rows = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_trainings_tb WHERE 1 ORDER BY training_date DESC");

            echo "<select id=\"training_id\" onchange=\"selectTraining();\" class=\"form-control\">";
            echo "<option value=\"all\">All</option>";
            foreach ($rows as $row) {
                $id = $row['id'];
                $training = $row['training_date'];
                $venue = $row['training_venue'];
                echo "<option value=\"$id\">$training($venue)</option>";
            }
            echo "</select>";


            break;

        case 'get_trainings_report':
            $id = $_POST['id'];

            echo '
            <colgroup>
            <col span="4"/>
            <col span="2" class="gender">
            <col span="3">
            <col class="gender">
            <col class="space">
            <col span="4" class="gender">
            </colgroup>
            <thead>
            <tr>
            <th rowspan="3">DATE OF TRAINING</th>
            <th rowspan="2">PARTNER</th>
            <th rowspan="2">DISTRICT</th>
            <th rowspan="2">TARGET</th>
            <th colspan="2">TRAINED</th>
            <th rowspan="2">TOTAL</th>
            <th rowspan="2">ATTENDANCE %</th>
            <th rowspan="2">% FEMALE</th>
            <th rowspan="2">PLACES TRAINED</th>
            <th rowspan="2" class="space"></th>
            <th colspan="7" class="blue">EQUIPMENT ORDERED</th>
            </tr>
            <tr>
            <th>M</th>
            <th>F</th>
            <th>M.M SILO</th>
            <th>L.M.SILO</th>
            <th>P.SILO</th>
            <th>SGBS</th>
            <th>TARPS</th>
            <th># ORDERS</th>
            <th>ORDER RATE</th>
</tr>
            
</thead>
<tbody>
';
            if ($id == "all") {

                $rows = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_attendace_v WHERE 1 ORDER BY DATE(training_date) DESC");

                $count = 0;
                foreach ($rows as $row) {
                    $tid = $row['id'];
                    $date = $row['training_date'];
                    $district = capitalizeText($row['training_district']);
                    $attendance = capitalizeText($row['attendence']);

                    $target = $row['training_target'];
                    $male = $json_obj->get_count("evoucher_attendace_sheet_v", " id='$tid' AND gender ='male' ");

                    $orders = $json_obj->get_count("evoucher_attendace_sheet_v", " id='$tid' ");

                    $female = $attendance - $male;
                    $count++;
                    $rate = $orders / $attendance;

                    $target = $target == "" ? "N/A" : $target;
                    $rate = $rate == "" ? 0 : $rate;

                    echo "
      <tr onclick=\"ViewDetails($tid);\">
	   
        <td>$date</td>
        <td>Akorion</td>
        <td>$district</td>
        <td>$target</td>
        <td>$male</td>
        <td>$female</td>
        <td>$trained</td>
        <td>$tid</td>";

                    foreach ($equipments as $equipment) {
                        $equipment_id = $equipment['id'];
                        $total_equipments = $json_obj->get_count("evoucher_attendace_sheet_v", " id='$tid' AND equipment_id ='$equipment_id' ");

                        echo "<td>$total_equipments</td>";
                    }

                    echo "
        <td>$orders</td>
        <td>$rate</td></a>
        <td style='border-top: hidden;border-bottom: hidden'></td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>21</td>
        <td>43</td>
        <td>76</td>
        <td>0.47</td>
    </tr>
    ";


                }
                echo "<tr style='background-color: black;font-weight: bold'>
                    <td style='color: #FFFFFF'>Total</td>
                    <td style='color: #FFFFFF'></td>
                    <td style='color: #FFFFFF'></td>
                    <td style='color: #FFFFFF'>480</td>
                    <td style='color: #FFFFFF'>380</td>
                    <td style='color: #FFFFFF'>353</td>
                    <td style='color: #FFFFFF'>143</td>
                    <td style='color: #FFFFFF'></td>
                    <td style='color: #FFFFFF'></td>
                    <td style='color: #FFFFFF'></td>
                    <td style='border-top: hidden;border-bottom: hidden;background-color: white'></td>
                    <td style='color: #FFFFFF'></td>
                    <td style='color: #FFFFFF'></td>
                    <td style='color: #FFFFFF'></td>
                    <td style='color: #FFFFFF'></td>
                    <td style='color: #FFFFFF'></td>
                    <td style='color: #FFFFFF'></td>
                    <td style='color: #FFFFFF'></td>
                    </tr>
                    <tr>
                    <td style='border: hidden;background-color: transparent'></td>
                    </tr>
                    <tr>
                    <td style='border: hidden;background-color: transparent'></td>
                    <td style='border: hidden;background-color: transparent'></td>
                    <td style='border: hidden;background-color: transparent'>Target</td>
                    <td style='border: hidden;background-color: transparent'>10466</td>
                    </tr>
                    </tr>
                    <tr class='space'></tr>
                    <tr>
                    <td style='border: hidden;background-color: transparent'></td>
                    <td style='border: hidden;background-color: transparent'></td>
                    <td style='border: hidden;background-color: transparent'>Total Trained</td>
                    <td style='border: hidden;background-color: transparent'>747</td>
                    </tr>
                    </tr>
                    <tr class='space'></tr>
                    <tr>
                    <td style='border: hidden;background-color: transparent'></td>
                    <td style='border: hidden;background-color: transparent'></td>
                    <td style='border: hidden;background-color: red'>To Go</td>
                    <td style='border: hidden;background-color: red'>7899</td>
                    </tr>
    </tbody>\";";


            } else {
                $rows = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_attendace_v WHERE id='$id' ");

                $date = $rows[0]['training_date'];
                $district = capitalizeText($rows[0]['training_district']);
                $attendance = capitalizeText($rows[0]['attendence']);
                $target = $row['training_target'];
                $male = $json_obj->get_count("evoucher_attendace_sheet_v", " id='$id' AND gender ='male' ");
                $orders = $json_obj->get_count("evoucher_attendace_sheet_v", " id='$id' ");
                $female = $attendance - $male;
                $rate = $orders / $attendance;
                $target = $target == "" ? "N/A" : $target;
                $rate = $rate == "" ? 0 : $rate;
                $count++;
                echo "
      <tr onclick=\"ViewDetails($id);\">
	    <td>$count</td>
        <td>$date</td>
        
        <td>$district</td>
        <td>$target</td>
        <td>$attendance</td>
        <td>$male</td>
        <td>$female</td>";

                foreach ($equipments as $equipment) {
                    $equipment_id = $equipment['id'];
                    $total_equipments = $json_obj->get_count("evoucher_attendace_sheet_v", " id='$id' AND equipment_id ='$equipment_id' ");

                    echo "<td>$total_equipments</td>";
                }

                echo "
        <td>$orders</td>
        <td>$rate</td>
    </tr>";
            }


            break;

        case 'get_equipment_report':

            $id = $_POST['id'];

            $equipments = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_equipment_tb WHERE 1");
            echo "<colgroup>
        <col class=\"gender\">
        <col span=\"2\" class=\"green\">
        <col class=\"blue\">
        <col class=\"gender\">
    </colgroup>
    <thead>
    <tr>
        <th>PARTNER</th>
        ";
            foreach ($equipments as $equipment) {
                $inital = $equipment['equipment_header'];
                echo "<th>$inital</th>";
            }
            echo "</tr>
</thead>
    <tbody>";

            if ($id == "all") {

                $rows = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_attendace_v WHERE 1");
                $tid = "";
                $count = 0;

                $ttl = 0;
                $training = array();
                foreach ($rows as $row) {

                    $tid = $row['id'];

                    $orders = $json_obj->get_count("evoucher_attendace_sheet_v", " id='$tid' ");
                    $ttl = $ttl + $orders;

                    foreach ($equipments as $equipment) {

                        $equipment_id = $equipment['id'];
                        $total_equipments = $json_obj->get_count("evoucher_attendace_sheet_v", " id='$tid' AND equipment_id ='$equipment_id' ");

                        $training[$count][$equipment_id] = $total_equipments;

                    }


                    $count = $count + 1;
                }
                echo "<tr>
<td>AKORION COMPANY LIMITED</td>";
                foreach ($equipments as $equipment) {

                    $equipment_id = $equipment['id'];
                    if ($equipment_id == 1) {
                        echo "<td colspan=\"2\">";
                        $e = 0;
                        foreach ($training as $train) {
                            $e = $e + $train[$equipment_id];
                        }
                        echo round(($e / $ttl) * 100, 2) . "%";
                        echo "</td>";
                    } else {
                        echo "<td>";
                        $e = 0;
                        foreach ($training as $train) {
                            $e = $e + $train[$equipment_id];
                        }
                        echo round(($e / $ttl) * 100, 2) . "%";
                        echo "</td>";
                    }


                }
                echo "</tr>
</tbody>";


            } else {

                $rows = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_attendace_v WHERE id='$id'");
                $tid = "";
                $count = 0;

                $ttl = 0;
                $training = array();
                foreach ($rows as $row) {

                    $tid = $row['id'];

                    $orders = $json_obj->get_count("evoucher_attendace_sheet_v", " id='$tid' ");
                    $ttl = $ttl + $orders;

                    foreach ($equipments as $equipment) {

                        $equipment_id = $equipment['id'];
                        $total_equipments = $json_obj->get_count("evoucher_attendace_sheet_v", " id='$tid' AND equipment_id ='$equipment_id' ");

                        $training[$count][$equipment_id] = $total_equipments;

                    }


                    $count = $count + 1;
                }
                echo "<tr>";
                foreach ($equipments as $equipment) {

                    $equipment_id = $equipment['id'];
                    echo "<td>";
                    $e = 0;
                    foreach ($training as $train) {
                        $e = $e + $train[$equipment_id];
                    }
                    echo round(($e / $ttl) * 100, 2) . "%";
                    echo "</td>";


                }
                echo "</tr>";

            }

            /* echo"
          <tr><td>46.7%</td><td>4%</td><td>46.7%</td><td>4%</td></tr>";*/


            break;

        case 'get_trainings_for_attendance':

            $rows = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_trainings_tb WHERE 1 ORDER BY training_date DESC");

            echo "<select id=\"training_id\" onchange=\"selectTraining();\" class=\"form-control\">";
            foreach ($rows as $row) {
                $id = $row['id'];
                $training = $row['training_date'];
                $venue = $row['training_venue'];
                echo "<option value=\"$id\">$training($venue)</option>";
            }
            echo "</select>";

            break;

        case 'get_attendance_report_details':

            $id = $_POST['id'];

            $rows = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_attendace_v WHERE id='$id'");

            $district = capitalizeText($rows[0]['training_district']);
            $training_date = capitalizeText($rows[0]['training_date']);
            $parish = capitalizeText($rows[0]['training_parish']);

            echo "<caption id=\"partner\" class=\"text-center hide-before-print\">Private Sector Partner: <b>AKORION</b> | Training Venue: <b>$parish</b> |District: <b>$district</b> </br> Date: <b>$training_date</b> | WFP SPA in attendance? (circle one): <span><b>YES</b></span> &nbsp; | <span><b>NO</b></span></caption>";


            break;


        case 'get_attendance_report':

            $id = $_POST['id'];

            $rows = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_attendace_sheet_v WHERE id='$id'");

            $count = 0;

            foreach ($rows as $row) {
                $count = $count + 1;
                $name = capitalizeText($row['name']);
                $dob = $row['birth_date'];
                $phone = $row['phone'];
                $order_id = $row['order_id'];;

                if ($order_id < 10) {

                    $voucher = "WFP000" . $order_id;
                } else if ($order_id > 10 && $order_id < 100) {
                    $voucher = "WFP00" . $order_id;

                } else if ($order_id > 100 && $order_id < 1000) {
                    $voucher = "WFP0" . $order_id;

                } else {

                    $voucher = "WFP" . $order_id;

                }

                $initial = capitalizeText($row['equipment']);

                $selling_price = $json_obj->fetch_rows("evoucher_orders_tb", "selling_price", " id='$order_id' LIMIT 1")[0]['selling_price'];


                $deposit = $json_obj->fetch_rows("evoucher_installments_tb", "depost", " order_id='$order_id' LIMIT 1")[0]['depost'];

                $ttl_pay = $json_obj->get_sum("evoucher_installments_tb", "depost", " order_id='$order_id'");
                $balance = $selling_price - $ttl_pay;

                $extra = $deposit - 20000;
                if ($extra < 1) {
                    $extra = "N/A";
                }
                if ($ttl_pay == "") {
                    $ttl_pay = 0;
                }

                if ($ttl_pay == "") {
                    $ttl_pay = 0;
                }

                if ($deposit == "") {
                    $deposit = 0;
                }
                $gender = $row['gender'];

                if ($gender == "male") {
                    $gender = "M";
                } else {
                    $gender = "F";
                }

                $subcounty = $row['subcounty'];
                $parish = capitalizeText($row['parish']);
                $va = $row['va_name'];
                $va_phone = $row['va_phone'];

                echo "

              <tr>
              <td>$count</td>
              <td>$name</td>
              <td>$gender</td>
              <td>$parish</td>
              <td>$phone</td>
              <td>$initial</td>
              <td>$deposit</td>
              <td>$extra</td>
              <td>$ttl_pay</td>
              <td>$balance</td>
              <td>$voucher</td>
            </tr>
              ";
            }
            break;


        case 'get_top_stats_refresh' :

            /*$orders=$json_obj->get_count("evoucher_orders_tb",1);
            $equipments_delivered=$json_obj->get_count("evoucher_deliveries_tb",1);
            $pending_deliveries=$json_obj->get_count("evoucher_orders_tb"," deliver_status='Pending Delivery'");

            $ttl_fully_paid_equipments=$equipments_delivered+$pending_deliveries;

            $male=$json_obj->get_count("evoucher_attendace_sheet_v"," gender='male' ");

            $female=$json_obj->get_count("evoucher_attendace_sheet_v"," gender='female' ");

            $trainings=$json_obj->get_count("evoucher_attendace_v"," attendence>0 ");
            $trained_VAs=$json_obj->get_sum("evoucher_attendace_v","attendence",1);;
            $total_cash=$json_obj->get_sum("evoucher_order_v","deposit",1);

            $trained=$male+$female;
            */
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
            if ($date1 != "" && $date2 != "") {

                $orders = $json_obj->get_count("evoucher_orders_tb", "DATE(time_stamp) >= DATE '$date1' AND DATE(time_stamp) <= DATE '$date2'");
                $equipments_delivered = $json_obj->get_count("evoucher_deliveries_tb", "DATE(time_stamp) >= DATE '$date1' AND DATE(time_stamp) <= DATE '$date2'");
                $pending_deliveries = $json_obj->get_count("evoucher_orders_tb", " deliver_status='Pending Delivery' AND DATE(time_stamp) >= DATE '$date1' AND DATE(time_stamp) <= DATE '$date2'");

                $ttl_fully_paid_equipments = $equipments_delivered + $pending_deliveries;

                $trainings = $json_obj->get_count("evoucher_attendace_v", " attendence>0 AND DATE(training_date) >= DATE '$date1' AND DATE(training_date) <= DATE '$date2'");

                $male = $json_obj->get_count("evoucher_attendace_sheet_v", " gender='male' AND DATE(training_date) >= DATE '$date1' AND DATE(training_date) <= DATE '$date2'");

                $female = $json_obj->get_count("evoucher_attendace_sheet_v", " gender='female' AND DATE(training_date) >= DATE '$date1' AND DATE(training_date) <= DATE '$date2' ");

                $trained_VAs = $json_obj->get_sum("evoucher_attendace_v", "attendence", "DATE(training_date) >= DATE '$date1' AND DATE(training_date) <= DATE '$date2'");;
                $total_cash = $json_obj->get_sum("evoucher_order_v", "deposit", "DATE(time_stamp) >= DATE '$date1' AND DATE(time_stamp) <= DATE '$date2'");

                $total_cash = $total_cash == "" ? 0 : $total_cash;
                $expected_cash = $json_obj->get_sum("evoucher_order_v", "selling_price", "DATE(time_stamp) >= DATE '$date1' AND DATE(time_stamp) <= DATE '$date2'");
                $trained = $male + $female;


                $paid = $json_obj->get_sum("evoucher_order_v", "deposit", 1);
                $unpaid = $expected_cash - $paid_cash;

                $complete = $json_obj->get_count("evoucher_order_v", " deposit=selling_price ");
                $incomplete = $orders - $complete;


            } else {
                $orders = $json_obj->get_count("evoucher_orders_tb", 1);
                $equipments_delivered = $json_obj->get_count("evoucher_deliveries_tb", 1);
                $pending_deliveries = $json_obj->get_count("evoucher_orders_tb", " deliver_status='Pending Delivery'");

                $ttl_fully_paid_equipments = $equipments_delivered + $pending_deliveries;

                $trainings = $json_obj->get_count("evoucher_attendace_v", " attendence>0 ");

                $male = $json_obj->get_count("evoucher_attendace_sheet_v", " gender='male' ");

                $female = $json_obj->get_count("evoucher_attendace_sheet_v", " gender='female' ");

                $trained_VAs = $json_obj->get_sum("evoucher_attendace_v", "attendence", 1);;
                $total_cash = $json_obj->get_sum("evoucher_order_v", "deposit", 1);

                $total_cash = $total_cash == "" ? 0 : $total_cash;
                $expected_cash = $json_obj->get_sum("evoucher_order_v", "selling_price", 1);
                $trained = $male + $female;


                $paid = $json_obj->get_sum("evoucher_order_v", "deposit", 1);
                $unpaid = $expected_cash - $paid_cash;

                $complete = $json_obj->get_count("evoucher_order_v", " deposit=selling_price ");
                $incomplete = $orders - $complete;

            }

            if ($total_cash > 1000000) {

                $total_cash_ = ($total_cash / 1000000);

                $total_cash = $total_cash_ . "M";
            }

//echo"  <div class=\" col-md-2 col-sm-4 col-xs-4 tile_stats_count\">
//            <div class=\"left\"></div>
//            <div class=\"right\">
//              <span class=\"count_top\"><i class=\"fa fa-user\"></i> Total Trainings</span>
//              <div class=\"count green\">$trainings</div>
//              <span class=\"count_bottom\"><a href=\"training.php\" class=\"blue fa fa-sort-asc\"> view more</a></span>
//            </div>
//          </div>
//          <div class=\" col-md-2 col-sm-4 col-xs-4 tile_stats_count\">
//            <div class=\"left\"></div>
//            <div class=\"right\">
//              <span class=\"count_top\"><i class=\"fa fa-user\"></i> Farmers Trained</span>
//
//
//              <div class=\"container\">
//              <div class=\"count blue col-md-2\">
//               $trained_VAs
//              </div>
//              <ul class=\"navbar-right gender\">
//              <label>M : $male</label><br/>
//              <label>F : $female</label>
//              </ul>
//              </div>
//
//
//			  <input id=\"trained\" type=\"hidden\" value=\"$trained_VAs\"/>
//             <span class=\"count_bottom\"><a href=\"metrics.php\" class=\"blue fa fa-sort-asc\"> view more</a></span>
//            </div>
//          </div>
//          <div class=\" col-md-2 col-sm-4 col-xs-4 tile_stats_count\">
//            <div class=\"left\"></div>
//            <div class=\"right\">
//              <span class=\"count_top\"><i class=\"fa fa-user\"></i> Total Orders</span>
//              <div class=\"count blue\">$orders</div>
//             <span class=\"count_bottom\"><a href=\"orders.php\" class=\"blue fa fa-sort-asc\"> view more</a></span>
//            </div>
//          </div>
//
//          <div class=\" col-md-2 col-sm-4 col-xs-4 tile_stats_count\">
//            <div class=\"left\"></div>
//            <div class=\"right\">
//              <span class=\"count_top\"><i class=\"fa fa-user\"></i> Total Cash</span>
//              <div class=\"count green\">$total_cash</div>
//              <!--<span class=\"count_bottom\"><i class=\"green\"><i class=\"fa fa-sort-asc\"></i>34% </i> From Yesterday</span>-->
//            </div>
//          </div>
//		  <div class=\" col-md-2 col-sm-4 col-xs-4 tile_stats_count\">
//            <div class=\"left\"></div>
//            <div class=\"right\">
//              <span class=\"count_top\"><i class=\"fa fa-user\"></i> Equipments Delivered</span>
//              <div class=\"count\">$equipments_delivered</div>
//              <span class=\"count_bottom\"><a href=\"delivery.php\" class=\"blue fa fa-sort-asc\"> view more</a></span>
//            </div>
//          </div>
//          <div class=\" col-md-2 col-sm-4 col-xs-4 tile_stats_count\">
//            <div class=\"left\"></div>
//            <div class=\"right\">
//              <span class=\"count_top\"><i class=\"fa fa-user\"></i> Pending Deliveries</span>
//              <div class=\"count red\">$pending_deliveries</div>
//              <span class=\"count_bottom\"><a href=\"pending.php\" class=\"blue fa fa-sort-asc\"> view more</a></span>
//            </div>
//          </div>
//
//";

            echo '

        <div class="col-md-3 col-sm-6 col-xs-6 stat ">
		<a href="metrics.php">
                  <div class="stat-item panel tile">
                    <div class="stats row">
                      <div class="col-md-4 i">
                          <i class="fa fa-language"></i>
                        </div>
                        <div class="col-md-8" style="padding:10px;">
                          <p class="tiny">TRAININGS</p>
                          <p class="value">' . $trainings . '</p>
                          <table>
                          <tr>

                           <td>Male ' . $male . '</td>
                           <td>Female ' . $female . '</td>
                          </tr>
                          </table>
                        </div>
                    </div>
                  </div>
				  </a>
              </div>


             <div class="col-md-3 col-sm-6 col-xs-6 stat">
			 <a href="orders.php">
                  <div class="stat-item panel tile">
                    <div class="stats row">
                      <div class="col-md-4 i">
                          <i class="fa fa-edit"></i>
                        </div>
                        <div class="col-md-8" style="padding:10px;">
                          <p class="tiny">TOTAL ORDERS</p>
                          <p class="value">' . $orders . '</p>
						  <input id="trained" type="hidden" value="' . $trained_VAs . '"/>
                          <input id="complete" type="hidden" value="' . $complete . '"/>
			             <input id="incomplete" type="hidden" value="' . $incomplete . '"/>
                        </div>
                    </div>
                  </div>
				  </a>
              </div>


			  <div class="col-md-3 col-sm-6 col-xs-6 stat">
			  <a href="payments.php">
                  <div class="stat-item panel tile">
                    <div class="stats row">
                      <div class="col-md-4 i">
                          <i class="fa fa-money"></i>
                        </div>
                        <div class="col-md-8" style="padding:10px;">
                          <p class="tiny">TOTAL PAYMENTS</p>
                          <p class="value">' . $total_cash . '</p>
                           <input id="paid" type="hidden" value="' . $paid . '"/>
                           <input id="unpaid" type="hidden" value="' . $unpaid . '"/>
                        </div>
                    </div>
                  </div>
				   </a>
              </div>


			  <div class="col-md-3 col-sm-6 col-xs-6 stat">
			   <a href="delivery.php">
                  <div class="stat-item panel tile">
                    <div class="stats row">
                      <div class="col-md-4 i">
                          <i class="fa fa-truck"></i>
                        </div>
                        <div class="col-md-8" style="padding:10px;">
                            <p class="tiny"><b>EQUIPMENTS DELIVERED</b></p>
                          <p class="value">' . $equipments_delivered . ' of ' . $ttl_fully_paid_equipments . '</p>
                        </div>
                    </div>
                  </div>
				  </a>
              </div>

';


            break;
        case 'get_orders' :

            $rows = $json_obj->fetch_rows_byQuery("SELECT *,DATE_FORMAT(time_stamp,'%d %b %y') as date1 FROM evoucher_order_v WHERE 1 ORDER BY date1 DESC");


            echo "<thead>
                      <tr>
					  <th>No.</th>
					   <th>Voucher Code</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Equipment Type</th>
                        <th>Cost(UGX)</th>
                        <th>Amount Paid (UGX)</th>
						<th>Extra Payments (UGX)</th>
                        <th>Balance (UGX)</th>
                        

                      </tr>
                    </thead>
				 ";
            // }
            // <th>Options</th>
            $i = 0;

            foreach ($rows as $row) {
                //`id`, `equipment_id`, `farmer_id`, `quantity`, `selling_price`, `deposit`, `reg_date`, `deliver_status`
                $id = $row['id'];
                $equipment_id = $row['equipment_id'];
                $farmer_id = $row['farmer_id'];
                $quantity = $row['quantity'];
                $selling_price = $row['selling_price'];
                $reg_date = $row['date1'];
                $code = "000";
                if ($i < 10) {
                    $code = "00" . $id;
                } else if ($i < 100) {
                    $code = "0" . $id;
                } else {
                    $code = "" . $id;
                }


                $name = capitalizeText($row['farmer_name']);
                $phone = $row['farmer_phone'];
                $equipment = capitalizeText($row['equipment_name']);
                $deposited = $row['deposit'];

                $extra = $deposited - 20000;

                if ($deposited == null) {
                    $deposited = 0;
                }

                $left_amount = $selling_price - $deposited;
                if ($name != "" && $deposited != $selling_price) {

                    $extra_ = $extra < 1 ? "N/A" : number_format($extra);
                    $i++;
                    echo "<tr>
				        <td>$i</td>
				        <td>WFP$code</td>
                        <td> $name</td>
                        <td>$phone</td>                        
                        <td>$equipment</td>
                        <td>" . number_format($selling_price) . "</td>
                        <td>" . number_format($deposited) . "</td>
						<td>" . $extra_ . "</td>
                        <td>" . number_format($left_amount) . "</td>
                       


                      </tr>";

                }
            }

            break;

        case 'import_csv':

//echo $size;
            if ($_FILES["csv"]["size"] > 0) {


                $fileinfo = pathinfo($_FILES["csv"]["name"]);
                $filetype = $_FILES["csv"]["type"];

                //Validate File Type
                if (strtolower(trim($fileinfo["extension"])) != "csv") {
                    $util_obj->redirect_to("../orders.php?token=failed&flag=-1");
                } else {

                    $file_path = $_FILES["csv"]["tmp_name"];
                    $handle = fopen($file_path, "r");
                    $table = "evoucher_installments_tb";
                    $exclude_columns = array('time_stamp');
                    $string = $json_obj->insert_csv($table, $json_obj, $handle, $exclude_columns);

                    //echo"".$string;
                    $util_obj->redirect_to("../orders.php?token=success&uninserted=$string");

                }
            } else {
                $size = $_FILES["csv"]["size"];
                //print_r($_FILES);
                $util_obj->redirect_to("../orders.php?token=failed&&size=$size");

            }


            break;


        case 'import_orders_csv':

//echo $size;
            if ($_FILES["csv"]["size"] > 0) {


                $fileinfo = pathinfo($_FILES["csv"]["name"]);
                $filetype = $_FILES["csv"]["type"];

                //Validate File Type
                if (strtolower(trim($fileinfo["extension"])) != "csv") {
                    $util_obj->redirect_to("../orders.php?token=failed&flag=-1");
                } else {

                    $file_path = $_FILES["csv"]["tmp_name"];
                    $handle = fopen($file_path, "r");
                    $table = "evoucher_orders_tb";
                    $exclude_columns = array('reg_date', 'deliver_status', 'time_stamp');
                    $string = $json_obj->insert_csv2($table, $json_obj, $handle, $exclude_columns);

                    echo "" . $string;
                    $util_obj->redirect_to("../orders.php?token=success&uninserted=$string");

                }
            } else {
                $size = $_FILES["csv"]["size"];
                //print_r($_FILES);
                $util_obj->redirect_to("../orders.php?token=failed&&size=$size");

            }


            break;

        case 'get_schedule':
            $rows = $json_obj->fetch_rows_byQuery("SELECT  * ,DATE_FORMAT(training_date,'%d %b %y') as f_date FROM  evoucher_trainings_tb ORDER BY training_date");

            echo "<thead>
                      <tr>
					  <th>Day</th>
					   <th>District</th>
                        <th>Training Venues</th>
                        <th>Activity</th>
                      </tr>
                    </thead>
                    <tbody>
				 ";
            // }
            // <th>Options</th>


            foreach ($rows as $row) {
                //`id`, `equipment_id`, `farmer_id`, `quantity`, `selling_price`, `deposit`, `reg_date`, `deliver_status`
                $id = $row['id'];
                $training_date = $row['f_date'];
                $training_district = $row['training_district'];
                $training_venue = $row['training_venue'];
                $training_topic = $row['training_topic'];


                    echo "<tr>
				            <td>$training_date</td>
				            <td>$training_district</td>
				            <td>$training_venue</td>
				            <td>$training_topic</td>
                      </tr>";

                }
                echo '</tbody>';

            break;


        case 'get_graph'://bar chart
            header('Content-type: application/json');
            if (isset($_POST['date1']) && $_POST['date1'] != "" && isset($_POST['date2']) && $_POST['date2'] != "") {
                $date1 = $_POST['date1'];
                $date2 = $_POST['date2'];

                $rows = $json_obj->fetch_rows_byQuery("SELECT  *
FROM  equipment_graph_data_v WHERE DATE(real_date) >= DATE '$date1' AND DATE(real_date) <= DATE '$date2'  ORDER BY DATE(real_date) ASC");
                $data = $json_obj->get_equipment_graph_json($rows, $json_obj);
//print_r($data);
                $util_obj->deliver_response(200, 1, $data);
            } else {
                $rows = $json_obj->fetch_rows_byQuery("SELECT  *
FROM  equipment_graph_data_v  ORDER BY DATE(real_date) ASC ");
                $data = $json_obj->get_equipment_graph_json($rows, $json_obj);
//print_r($data);
                $util_obj->deliver_response(200, 1, $data);

            }
            break;

        case 'get_graph2':
            header('Content-type: application/json');
            if (isset($_POST['date1']) && $_POST['date1'] != "" && isset($_POST['date2']) && $_POST['date2'] != "") {
                $date1 = $_POST['date1'];
                $date2 = $_POST['date2'];
                $rows = $json_obj->fetch_rows_byQuery("SELECT  *
FROM  equipment_graph_data_v WHERE DATE(real_date) >= DATE '$date1' AND DATE(real_date) <= DATE '$date2'  ORDER BY DATE(real_date) ASC");
                $data = $json_obj->get_equipment_payment_graph_json($rows, $json_obj, $date1, $date2);
//print_r($data);
                $util_obj->deliver_response(200, 1, $data);
            } else {

                $rows = $json_obj->fetch_rows_byQuery("SELECT  *
FROM  equipment_graph_data_v ORDER BY DATE(real_date) ASC");
                $data = $json_obj->get_equipment_payment_graph_json($rows, $json_obj, $date1, $date2);
//print_r($data);
                $util_obj->deliver_response(200, 1, $data);

            }
            break;
        case 'get_graph3'://farmers trained gender
            header('Content-type: application/json');

            $titleArray = array();
            $titleArray = array('text' => 'Farmers Trained');

            if (isset($_POST['date1']) && $_POST['date1'] != "" && isset($_POST['date2']) && $_POST['date2'] != "") {
                $date1 = $_POST['date1'];
                $date2 = $_POST['date2'];

                $male = (double)$json_obj->get_count("evoucher_attendace_sheet_v", " gender='male' AND DATE(time_stamp) >= DATE '$date1' AND DATE(time_stamp) <= DATE '$date2' ");
                $female = (double)$json_obj->get_count("evoucher_attendace_sheet_v", " gender='female' AND DATE(time_stamp) >= DATE '$date1' AND DATE(time_stamp) <= DATE '$date2'");

            } else {
                $male = (double)$json_obj->get_count("evoucher_attendace_sheet_v", " gender='male' ");
                $female = (double)$json_obj->get_count("evoucher_attendace_sheet_v", " gender='female'");
            }


            $total = $male + $female;

            $per_male = ($male / $total) * 100;

            $per_female = ($female / $total) * 100;;

            $datax = array();

            $temp = array('Male', $per_male);
            array_push($datax, $temp);

            array_push($datax, array('name' => 'Female', 'y' => $per_female, 'sliced' => true, 'selected' => true));
            $dataArray = array('type' => 'pie', 'name' => 'Gender', 'data' => $datax);

            $data = $json_obj->get_piechart_graph_json($titleArray, $dataArray);//
//print_r($data);
            $util_obj->deliver_response(200, 1, $data);

            break;
        case 'get_graph4'://payements complete incomplete
            header('Content-type: application/json');
            $titleArray = array();
            $titleArray = array('text' => 'Payments');


            if (isset($_POST['date1']) && $_POST['date1'] != "" && isset($_POST['date2']) && $_POST['date2'] != "") {
                $date1 = $_POST['date1'];
                $date2 = $_POST['date2'];
                $complete = (double)$json_obj->get_sum("equipment_graph_data_v", "complete_ttl", " DATE(real_date) >= DATE '$date1' AND DATE(real_date) <= DATE '$date2'");//get_count("evoucher_attendace_sheet_v"," gender='male'");
                $incomplete = (double)$json_obj->get_sum("equipment_graph_data_v", "incomplete_ttl", " DATE(real_date) >= DATE '$date1' AND DATE(real_date) <= DATE '$date2'");

            } else {

                $complete = (double)$json_obj->get_sum("equipment_graph_data_v", "complete_ttl", 1);//get_count("evoucher_attendace_sheet_v"," gender='male'");
                $incomplete = (double)$json_obj->get_sum("equipment_graph_data_v", "incomplete_ttl", 1);

            }

            $total = $complete + $incomplete;

            $per_complete = ($complete / $total) * 100;

            $per_incomplete = ($incomplete / $total) * 100;;

            $datax = array();

            $temp = array('Complete', $per_complete);
            array_push($datax, $temp);

            array_push($datax, array('name' => 'Incomplete', 'y' => $per_incomplete, 'sliced' => true, 'selected' => true));
            $dataArray = array('type' => 'pie', 'name' => 'Payments', 'data' => $datax);

            $data = $json_obj->get_piechart_graph_json($titleArray, $dataArray);//
//print_r($data);
            $util_obj->deliver_response(200, 1, $data);

            break;

        case 'get_graph5'://bar chart
            header('Content-type: application/json');

            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];

            $data = $json_obj->get_progress_json($date1, $date2);
//print_r($data);
            $util_obj->deliver_response(200, 1, $data);

            break;


        case 'get_pending' :
            $rows = $json_obj->fetch_rows_byQuery("SELECT *,DATE_FORMAT(time_stamp,'%d %b %y') as date1 FROM evoucher_order_v WHERE (selling_price=deposit) AND deliver_status='Pending Delivery'  ORDER BY date1 DESC ");
            $count = 0;

            echo "<thead>
                      <tr>
					    <th>No.</th>
						<th>Voucher Code</th>
                        <th>Name</th>
                        <th>Contact</th>
                        
                        <th>Equipment Type</th>
                        <th>Cost (UGX)</th>
                        <th>Amount Paid (UGX)</th>
                       
                        <th>Options</th>
                      </tr>
                    </thead>

				 ";
            // }


            foreach ($rows as $row) {
                //`id`, `equipment_id`, `farmer_id`, `quantity`, `selling_price`, `deposit`, `reg_date`, `deliver_status`
                $id = $row['id'];
                $equipment_id = $row['equipment_id'];
                $farmer_id = $row['farmer_id'];
                $quantity = $row['quantity'];
                $selling_price = $row['selling_price'];
                $reg_date = $row['date1'];
                $code = "000";
                if ($i < 10) {
                    $code = "00" . $id;
                } else if ($i < 100) {
                    $code = "0" . $id;
                } else {
                    $code = "" . $id;
                }

                $name = $row['farmer_name'];
                $phone = $row['farmer_phone'];
                $equipment = $row['equipment_name'];
                $deposited = $row['deposit'];
                if ($deposited == null) {
                    $deposited = 0;
                }

                $left_amount = $selling_price - $deposited;
                if ($name != "" && $deposited == $selling_price) {
                    $count++;
                    echo "<tr>
				        <td>$count</td>
				        <td>WFP$code</td>
                        <td>" . capitalizeText($name) . "</td>
                        <td>$phone</td>
                       
                        <td>" . capitalizeText($equipment) . "</td>
                        <td>" . number_format($selling_price) . "</td>
                        <td>" . number_format($deposited) . "</td>

                       ";// <td>$reg_date</td>

                    if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Client") {

                        echo "<td> <a href='details.php?id=$id' class='btn btn-default btn-xs'>View Details</a> </td> ";
                    } else {

                        echo "<td> <a href='details.php?id=$id' class='btn btn-default btn-xs'>View Details</a>  | &nbsp;<button class='btn btn-primary btn-xs' data-toggle='modal' data-target='.bs-example-modal-lg' onclick='getID($id);' >Deliver Now</button> </td>";
                    }


                    echo "</tr>";

                }
            }

            break;
        case 'get_payments' :

            $count = 0;
            $rows = $json_obj->fetch_rows_byQuery("SELECT * ,DATE_FORMAT(time_stamp,'%d %b %y') as date1 FROM evoucher_order_v WHERE (selling_price=deposit) AND deliver_status='' ORDER BY date1 DESC  ");
            //if(sizeof($rows)>0){
            echo "<thead>
                      <tr>
					    <th>No.</th>
						<th>Voucher Code</th>
                        <th>Name</th>
                        <th>Contact</th>                      
                        <th>Equipment Type</th>
                        <th>Cost (UGX)</th>
                        <th>Amount Paid (UGX)</th>
                        <th>Balance (UGX)</th>
                        
                        <th colspan='2'>Options</th>
                      </tr>
                    </thead>
				 ";
            // }<th>Start Date</th>


            foreach ($rows as $row) {
                //`id`, `equipment_id`, `farmer_id`, `quantity`, `selling_price`, `deposit`, `reg_date`, `deliver_status`
                $count++;
                $id = $row['id'];
                $equipment_id = $row['equipment_id'];
                $farmer_id = $row['farmer_id'];
                $quantity = $row['quantity'];
                $selling_price = $row['selling_price'];
                $reg_date = $row['date1'];
                $code = "000";
                if ($i < 10) {
                    $code = "00" . $id;
                } else if ($i < 100) {
                    $code = "0" . $id;
                } else {
                    $code = "" . $id;
                }

                $name = capitalizeText($row['farmer_name']);
                $phone = $row['farmer_phone'];
                $equipment = capitalizeText($row['equipment_name']);
                $deposited = $row['deposit'];
                if ($deposited == null) {
                    $deposited = 0;
                }

                $left_amount = $selling_price - $deposited;
                if ($name != "" && $deposited == $selling_price) {


                    $selling_price = number_format($selling_price);
                    $deposited = number_format($deposited);
                    $left_amount = number_format($left_amount);

                    echo "<tr>
				        <td>$count</td>
						<td>WFP$code</td>
                        <td> $name</td>
                        <td>$phone</td>
                        <td>$equipment</td>
                        <td>$selling_price</td>
                        <td>$deposited</td>
                        <td>$left_amount</td>
                        ";

                    if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Client") {

                        echo "<td> <a href='details.php?id=$id' class='btn btn-default btn-xs'>View Details</a></td> ";
                    } else {

                        echo "<td> <a href='details.php?id=$id' class='btn btn-default btn-xs'>View Details</a></td><td> <a class='btn btn-primary btn-xs'  onclick='setId($id);'>Order Delivery</a> </td>";
                    }


                    echo " </tr>";

                }
            }
            //<td>$reg_date</td>
            break;
        case 'get_order_delivery':
            if (isset($_POST['id']) && $_POST['id'] != "") {

                $id = $_POST['id'];
                $rows = $json_obj->update("evoucher_orders_tb", "deliver_status='Pending Delivery'", "id='$id'");


            }
            break;
        case 'register_delivery':
            if (isset($_POST['id']) && $_POST['id'] != "" &&
                isset($_POST['name']) && $_POST['name'] != "" &&
                isset($_POST['phone']) && $_POST['phone'] != ""
            ) {

                $id = $_POST['id'];
                $rows = $json_obj->update("evoucher_orders_tb", "deliver_status='Delivered'", "id='$id'");
                $phone = $_POST['phone'];
                $name = $_POST['name'];
                $json_obj->insert_into_evoucher_deliveries_tb($id, $name, $phone);

            }

            break;
        case 'get_installments' :
            if (isset($_POST['id']) && $_POST['id'] != "") {
                $id = $_POST['id'];
                $rows = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_installments_tb WHERE order_id='$id'");
                $rows_details = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_order_v WHERE id='$id'");
                $selling_price = $rows_details[0]['selling_price'];
                $count = 0;
                if (sizeof($rows) > 0) {
                    echo "<caption>Installment Details</caption><tr class=\"headings\">

                        <td>No.</td>
                        <td>Date</td>
                        <td>Amount Paid (UGX)</td>
                        <td>Balance (UGX)</td>
                        <td>Cumulative Payment(UGX)</td>
                        <td>Total Payment(%)</td>
                        <td>Received By</td>

                      </tr>";
                }

                $total_sub = 0;
                foreach ($rows as $row) {
                    //`id`, `equipment_id`, `farmer_id`, `quantity`, `selling_price`, `deposit`, `reg_date`, `deliver_status`
                    $count++;
                    $id = $row['id'];
                    $time_stamp = $row['time_stamp'];
                    $time_stamp = date_create($time_stamp);
                    $time_stamp = date_format($time_stamp, "d M Y ");

                    $deposit = $row['depost'];
                    $balance = $selling_price - $deposit;
                    $agent = capitalizeText($row['agent']);
                    $totalpaid = $selling_price - $balance;

                    $percentage = round(($totalpaid / $selling_price) * 100, 1);

                    $total_sub = $total_sub + $deposit;

                    $deposit_ = number_format($deposit);
                    $balance_ = number_format($balance);
                    $total_sub_ = number_format($total_sub);

                    echo "<tr>
				        <td class=\" \">$count</td>
                        <td class=\" \">$time_stamp</td>
                        <td class=\" \">$deposit_</td>
                        <td class=\" \">$balance_</td>
                        <td class=\" \">$total_sub_</td>
                        <td class=\" \">$percentage</td>
                        <td class=\" \">$agent</td>


                      </tr>";


                }

            }
            break;
        case 'get_deliveries' :

            //$id=$_POST['id'];
            $rows = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_deliveries_tb WHERE 1");
            $count = 0;
            // if(sizeof($rows)>0){
            echo " <thead>
                      <tr>
					    <th>No.</th>
					    <th>Voucher Code</th>
                        <th>Received BY</th>
                        <th>Contact</th>                        
                        <th>Equipment Type</th>
                        <th>Delivered BY</th>
                        <th>Delivery Date</th>

                      </tr>
                    </thead>



				 ";
            // }


            foreach ($rows as $row) {
                $id = $row["order_id"];
                $rows_details = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_order_v WHERE id='$id'");
                $name = $rows_details[0]['farmer_name'];
                $phone = $rows_details[0]['farmer_phone'];
                $equipment = $rows_details[0]['equipment_name'];

                $time_stamp = $row['time_stamp'];
                $deliverer = $row['deliverer'];

                $code = "000";
                if ($i < 10) {
                    $code = "00" . $id;
                } else if ($i < 100) {
                    $code = "0" . $id;
                } else {
                    $code = "" . $id;
                }

                if ($name != "") {
                    $count++;
                    echo "<tr>
				        <td>$count</td>
						<td>WFP$code</td>
                        <td>" . capitalizeText($name) . "</td>
                        <td> $phone</td>
                        <td>" . capitalizeText($equipment) . "</td>
                        <td>" . capitalizeText($deliverer) . "</td>
                        <td>$time_stamp</td>

                      </tr>";
                }

            }


            break;

        case'add_constants':
            if ($_POST['farmer'] != "" && isset($_POST['farmer'])
                && $_POST['order'] != "" && isset($_POST['order'])
                && $_POST['distribution'] != "" && isset($_POST['distribution'])
            ) {
                $rows = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_targets_tb WHERE 1 LIMIT 1");
                $Trained = $_POST['farmer'];
                $Ordered = $_POST['order'];
                $Distributed = $_POST['distribution'];
                if (sizeof($rows) > 0) {

                    $id = $rows[0]['id'];
                    $json_obj->update("evoucher_targets_tb", "farmer_Trained_target='$Trained', equipment_ordered_target='$Ordered', equipment_distributed_target='$Distributed'", "id='$id'");
                } else {
                    $json_obj->insert_into_evoucher_targets_tb($Trained, $Ordered, $Distributed);
                }

            }


            break;
        case'get_constants':
            header('Content-type: application/json');

            $rows = $json_obj->fetch_rows_byQuery("SELECT  *
FROM  evoucher_targets_tb WHERE 1 LIMIT 1");
            $data = $json_obj->get_constants_json($rows);
//print_r($data);
            $util_obj->deliver_response(200, 1, $data);

            break;

        case 'get_trainings' :

            $rows = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_attendace_v WHERE 1");

            $count = 0;
            echo "<thead>
                      <tr>
					    <th>No.</th>
                        <th>Training Date</th>
                        <th>Place of Training</th>
                        <th>No. of Attendees</th>
                        <th>Start Time</th>
                        <th>Status</th>
                        <th>Options</th>
                        <!--						<th>DATE OF TRAINING</th>
						<th>PARTNER</th>
						<th>DISTRICT</th>
						<th>TARGET</th>
						<th>TRAINED Male</th>
						<th>TRAINED Female</th>
						<th>Total Trained</th>
						<th>ATTENDANCE %</th>
						<th>% FEMALE</th>
						<th>PLACES TRAINED</th>
						<th> </th>
						<th>M.M SILO</th>
						<th>L.M.SILO</th>
						<th>P.SILO</th>
						<th>SGBS</th>
						<th>TARPS</th>
						<th># ORDERS</th>
						<th>ORDER RATE</th>-->
                      </tr>
                    </thead>
				 ";

            foreach ($rows as $row) {
                $id = $row['id'];
                $training_date = $row['training_date'];
                $training_place = capitalizeText($row['training_venue']);
                $training_attendence = $row['attendence'];
                $training_starttime = $row['training_start_time'];
                $training_endtime = $row['training_end_time'];
                $training_topic = $row['training_topic'];

                $count++;
                $current_date = Date('Y-m-d');

                $date = date_create($training_date);
                $date = date_format($date, "Y/m/d ");
                $date = $util_obj->ChangeTimeZone($date, "Africa/Nairobi");
                $date = date_create($date);
                $date = date_format($date, "Y/m/d ");


                $days = $util_obj->daysBetween($current_date, $date);


                if ($training_attendence < 1) {
                    $training_attendence = "N/A";
                }

                if ($days == 0) {

                    $Status = " " . "Today";


                } else if ($days < 0) {

                    $Status = "" . "Occurred";

                } else if ($days > 0) {

                    $Status = "" . "Upcoming";

                }


                echo "<tr>
				       <td>$count</td>
                        <td>$training_date</td>
                        <td>$training_place</td>
                        <td>$training_attendence</td>
                        <td>$training_starttime </td>


                        <td>$Status</td>

                        <td> <a href='metrics.php?id=$id' class='btn btn-default btn-xs' >View Training Details </a> </td>
                      </tr>";//Training


            }

            break;

        case 'get_trainings_side' :

            $rows = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_attendace_v WHERE 1 ORDER BY training_date DESC");

            echo "<h4>Trainings</h4>";

            foreach ($rows as $row) {
                $id = $row['id'];
                $training_date = $row['training_date'];
                $training_venue = $row['training_venue'];
                $training_attendence = $row['attendence'];
                $training_starttime = $row['training_start_time'];

                $training_endtime = $row['training_end_time'];
                $training_topic = $row['training_topic'];
                echo "<div class=\"mail_list\">
                        <div class=\"left\">
                          <i class=\"fa fa-circle\"></i>
                        </div>
                        <div class=\"right\">
                          <a href='metrics.php?id=$id'><h3>$training_date</h3> <h3>$training_venue <small> ~ $training_attendence</small></h3> </a>

                        </div>
                      </div>
                      ";


            }

            break;
        case 'register_training' :
            if (isset($_POST['training_date']) && $_POST['training_date'] != "" &&
                isset($_POST['training_district']) && $_POST['training_district'] != "" &&
                isset($_POST['training_venue']) && $_POST['training_venue'] != "" &&
                isset($_POST['training_village']) && $_POST['training_village'] != "" &&
                isset($_POST['training_subcounty']) && $_POST['training_subcounty'] != "" &&
                isset($_POST['training_parish']) && $_POST['training_parish'] != "" &&
                isset($_POST['training_starttime']) && $_POST['training_starttime'] != "" &&
                isset($_POST['training_topic']) && $_POST['training_topic'] != ""
            ) {

                $training_target = $_POST['training_target'];

                $training_date = $_POST['training_date'];
                $training_district = $_POST['training_district'];
                $training_subcounty = $_POST['training_subcounty'];
                $training_parish = $_POST['training_parish'];
                $training_village = $_POST['training_village'];
                $training_venue = $_POST['training_venue'];

                $training_date = date_create($training_date);
                $training_date = date_format($training_date, "Y-m-d ");
                //$date=$util_obj->ChangeTimeZone(  $date,"Africa/Nairobi");
                //$date=date_create($date );
                //$date=date_format($date,"Y/m/d ");

                $training_start_time = date('h:i A', strtotime($_POST['training_starttime']));


                $training_topic = $_POST['training_topic'];
                $json_obj->insert_into_evoucher_trainings_tb($training_district, $training_subcounty, $training_parish, $training_village, $training_venue, $training_date, $training_start_time, $training_topic, $training_target);


            }


            break;
        case 'get_profile':
            if (isset($_POST['id']) && $_POST['id'] != "") {
                $id = $_POST['id'];
                $rows = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_order_v WHERE id='$id'");
                if (sizeof($rows) > 0) {
                    $id = $row['id'];
                    $equipment_id = $rows[0]['equipment_id'];
                    $farmer_id = $rows[0]['farmer_id'];

                    $farmer_data = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_farmer_reg_tb WHERE id='$farmer_id'");

                    $quantity = $rows[0]['quantity'];
                    $selling_price = $rows[0]['selling_price'];
                    $reg_date = $rows[0]['reg_date'];

                    $name = capitalizeText($rows[0]['farmer_name']);
                    $phone = $rows[0]['farmer_phone'];
                    $equipment = capitalizeText($rows[0]['equipment_name']);
                    $deposited = $rows[0]['deposit'];

                    $voucher = "";
                    $v_id = $rows[0]['id'];
                    for ($i = strlen($v_id); $i < 4; $i++) {//generating voucher id
                        $voucher .= "0";
                    }
                    $voucher .= $v_id;
                    $voucher = "WFP" . $voucher;

                    ///$status=$rows[0]['deliver_status'];
                    if ($deposited == null) {
                        $deposited = 0;
                    }

                    $f_district = $farmer_data[0]['district'];
                    $image_url = $farmer_data[0]['photo_url'];


                    $left_amount = $selling_price - $deposited;


                    $status = ($deposited / $selling_price) * 100;


                    $image_url != "no photo" ? "images/user.png" : $mage_url;

                    $left_amount = number_format($left_amount);
                    $selling_price = number_format($selling_price);
                    $deposited = number_format($deposited);
                    echo "


               <div class='col-md-4 col-xs-12 user-info' style='padding-left:0px'>
              <table class='table-rounded' style='background: #f8f8f8; padding:5px; border: solid 1px #f0f0f0 !important; width:100%'>
                  <caption class='center'><b>Beneficiary</b></caption>
                  <tr>

                      <td>
                        <img class='img-circle' src='images/user.png' width ='89'/>
                       </td>
                      <td>
                       <p id='name'>" . $name . "</p>

                       <p id='phone'>" . $phone . "</p>
                        <p id='phone'>" . $f_district . "</p>

                     </td>
                  </tr>
                </table>

            </div>
            <div class='col-md-4 col-xs-12'>
               <table class='table-rounded table-summary ' style='background: #f9f9f9; padding:5px; border: solid 0px #ccc!important;  width:100%'>
                    <caption><b>Order Details</b></caption>
                    <tr><td style='border-top:none'>Equipment Type </td><td style='border-top:none'><p>" . $equipment . "</p></td></tr>
                    <tr><td>Voucher Code</td><td><p>$voucher</p></td></tr>
                    <tr><td>Price</td><td><p>" . $selling_price . "</p></td></tr>
                </table>

              </div>
            <div class='col-md-4'>

              <table>
                 <caption><b>Payment Status</b></caption>
              <tr>
               <td>
                <span class='chart' id='chart_learning' data-percent='" . $status . "'>
                      <span class='percent' ></span>
                    </span>
             </td>
                  <td>
                    <p class='text-left' style='padding:0px;'>Paid : <span class='blue' style='font-size:1.3em'>UGX $deposited</span></p>
                      <p class='text-left' style='padding:0px;'>Balance: <span class='red'  style='font-size:1.3em'>UGX $left_amount</span></p>
                  </td>
                  </tr>
            </table>
            </div>";


                }

            }

            break;
        case 'get_top_details':

            if (isset($_POST['id']) && $_POST['id'] != "") {

                $id = $_POST['id'];
                $rows = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_attendace_v WHERE id='$id'");
                $topic = $rows[0]["training_topic"];
                $date = $rows[0]["training_date"];
                $district = $rows[0]["training_district"];

                $subcounty = $rows[0]["training_sub_county"];
                $parish = $rows[0]["training_parish"];
                $village = $rows[0]["training_village"];
                $venue = $rows[0]["training_venue"];
                $starttime = $rows[0]["training_start_time"];
                $endtime = $rows[0]["training_end_time"];
                $attendances = $rows[0]["attendence"];

                $attendance_details_male = $json_obj->get_count("evoucher_attendace_sheet_v", "id='$id' AND gender LIKE 'male'");

                $females = $attendances - $attendance_details_male;
                //<h4> Topic: $topic</h4>
                /*echo"
                  <div class=\"col-md-12 header-details\">
                                           <div class=\"row\">

                                            <div class=\"col-md-6 sender-info\">
                                            <div class=\"row\">
                                              <div class=\"col-md-12\">

                                                <h4>Date: $date Venue: $venue</h4>
                                                <h5> District: $district</h5>
                                                <p>Subcounty: $subcounty </p>
                                                <p>Parish: $parish, Village: $village</p>
                                                <p>Start Time: $starttime </p>

                                              </div>
                                             </div>
                                            </div>



                                              <div class=\"col-md-6 sender-info\">
                                            <div class=\"row\">
                                              <div class=\"col-md-12\">
                                                <h4>Attendance</h4>
                                                <h5>Total : $attendances</h5>
                                                <h5>Male : $attendance_details_male</h5>
                                                <h5>Female : $females</h5>


                                              </div>
                                             </div>
                                            </div>



                                           </div>
                                          </div>

                  ";*/

            }


            echo "
<div class=\"col-md-12 header-details\">
<div class=\"row\">

<!-- code start -->


<a class=\"twPc-bg twPc-block\"></a>

<div>
    <a  class=\"twPc-avatarLink\">
			<img alt=\"Mert Salih Kaplan\" src=\"images/maps-icon.png\" class=\"twPc-avatarImg\">
		</a>

    <div class=\"twPc-divUser\">
			<div class=\"twPc-divName\">
				<a>$venue</a>
			</div>
			<span>
				<a>On <span>$date</span></a>
			</span>
		</div>
    <br>


    <div class=\"twPc-divStats\">
			<ul class=\"twPc-Arrange\">


      <li class=\"twPc-ArrangeSizeFit\">
        <a>
          <span class=\"twPc-StatLabel twPc-block\">District</span>
          <span class=\"twPc-StatValue\">" . capitalizeText($district) . "</span>
        </a>
      </li>

      <li class=\"twPc-ArrangeSizeFit\">
        <a>
          <span class=\"twPc-StatLabel twPc-block\">Subcounty</span>
          <span class=\"twPc-StatValue\">" . capitalizeText($subcounty) . "</span>
        </a>
      </li>

      <li class=\"twPc-ArrangeSizeFit\">
        <a>
          <span class=\"twPc-StatLabel twPc-block\">Parish</span>
          <span class=\"twPc-StatValue\">" . capitalizeText($parish) . "</span>
        </a>
      </li>

      <li class=\"twPc-ArrangeSizeFit\">
        <a>
          <span class=\"twPc-StatLabel twPc-block\">Village</span>
          <span class=\"twPc-StatValue\">" . capitalizeText($village) . "</span>
        </a>
      </li>


      <li class=\"twPc-ArrangeSizeFit\">
        <a>
          <span class=\"twPc-StatLabel twPc-block\">Time</span>
          <span class=\"twPc-StatValue\">$starttime</span>
        </a>
      </li>
				<li class=\"twPc-ArrangeSizeFit\">
					<a>
						<span class=\"twPc-StatLabel twPc-block\">Attendance Total</span>
						<span class=\"twPc-StatValue\">$attendances</span>
					</a>
				</li>
				<li class=\"twPc-ArrangeSizeFit\">
					<a >
						<span class=\"twPc-StatLabel twPc-block\">Male</span>
						<span class=\"twPc-StatValue\">$attendance_details_male</span>
					</a>
				</li>
				<li class=\"twPc-ArrangeSizeFit\">
					<a >
						<span class=\"twPc-StatLabel twPc-block\">Female</span>
						<span class=\"twPc-StatValue\">$females</span>
					</a>
				</li>
			</ul>
		</div>

</div>
</div>


";


            break;

        case  'get_attendance':
            if (isset($_POST['id']) && $_POST['id'] != "") {

                $id = $_POST['id'];
                if ($id == "all" || $id == "") {
                    $rows = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_attendace_sheet_v WHERE 1");
                } else {
                    $rows = $json_obj->fetch_rows_byQuery("SELECT * FROM evoucher_attendace_sheet_v WHERE id='$id'");
                }

                echo " <thead>
                      <tr>
					     <th>No.</th>
						 <th>Voucher Number</th>
                         <th>Name</th>
						 <th>Sex(M/F)</th>						
						 <th>Mobile Number</th>
						  <th>Village</th>
						 <th>Equipment Ordered</th>
						 <th>Deposit Paid(UGX)</th>
						  <th>Extra Payments(UGX)</th>
						 <th>Total Payment Received(UGX)</th>
						 <th>Remaining Balance(UGX)</th>
						 
                      </tr>
                    </thead>";

                /*<th>D.O.B</th>


                    <th>VA name</th>
                    <th>VA contact</th>*/
                $count = 0;

                foreach ($rows as $row) {
                    $count = $count + 1;
                    $name = capitalizeText($row['name']);
                    $dob = $row['birth_date'];
                    $phone = $row['phone'];
                    $order_id = $row['order_id'];;

                    if ($order_id < 10) {

                        $voucher = "WFP000" . $order_id;
                    } else if ($order_id > 10 && $order_id < 100) {
                        $voucher = "WFP00" . $order_id;

                    } else if ($order_id > 100 && $order_id < 1000) {
                        $voucher = "WFP0" . $order_id;

                    } else {

                        $voucher = "WFP" . $order_id;

                    }

                    $initial = capitalizeText($row['equipment']);

                    $selling_price = $json_obj->fetch_rows("evoucher_orders_tb", "selling_price", " id='$order_id' LIMIT 1")[0]['selling_price'];


                    $deposit = $json_obj->fetch_rows("evoucher_installments_tb", "depost", " order_id='$order_id' LIMIT 1")[0]['depost'];

                    $ttl_pay = $json_obj->get_sum("evoucher_installments_tb", "depost", " order_id='$order_id'");
                    $balance = $selling_price - $ttl_pay;
                    $extra = $deposit - 20000;


                    if ($ttl_pay == "") {
                        $ttl_pay = 0;
                    }

                    if ($ttl_pay == "") {
                        $ttl_pay = 0;
                    }

                    if ($deposit == "") {
                        $deposit = 0;
                    }
                    $gender = $row['gender'];

                    if ($gender == "male") {
                        $gender = "M";
                    } else {
                        $gender = "F";
                    }

                    $extra = $extra < 1 ? "N/A" : number_format($extra);
                    $subcounty = $row['subcounty'];
                    $village = capitalizeText($row['village']);
                    $va = $row['va_name'];
                    $va_phone = $row['va_phone'];
                    echo "<tr>
                        <td>$count</td>
						 <td>$voucher</td>
                        <td>$name</td>
						<td>$gender</td>
						
						<td>$phone</td>
						<td>$village</td>
						<td>" . $initial . "</td>
						<td>" . number_format($deposit) . "</td>
						<td>" . $extra . "</td>
						<td>" . number_format($ttl_pay) . "</td>					
						<td>" . number_format($balance) . "</td>                       
                      </tr>";

                    /*
                     <td>$dob</td>
                     <td>$va</td>
                     <td>$va_phone</td>
                    */
                }


            }
            break;
    }

}


function escapeJavaScriptText($string)
{
    return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string)$string), "\0..\37'\\")));
}

function capitalizeText($string)
{
    return strtoupper($string);
}


?>
