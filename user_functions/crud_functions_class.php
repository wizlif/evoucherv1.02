<?php
require_once "../php_lib/lib_functions/utility_class.php";
require_once "../php_lib/lib_functions/database_query_processor_class.php";
require_once "../php_lib/lib_functions/pagination_class.php";
class CrudFunctions {
public function __construct(){  

}

public function update($table,$columns_value,$where){
    $util_obj= new Utilties();
	$mDatabaseQueryProcessor =new DatabaseQueryProcessor();		
    return $util_obj->update_table($mDatabaseQueryProcessor,$table,$columns_value,$where);
}
public function insert_csv2($table,$json_obj,$handle,$exclude_columns){
    $util_obj= new Utilties();
	$mDatabaseQueryProcessor =new DatabaseQueryProcessor();	
    $column_string= $util_obj->getColumnsString($mDatabaseQueryProcessor,$table,1);
    foreach($exclude_columns as $row){
	$column_string=str_replace(",".$row," ",$column_string);
	}
	
	return $util_obj->insertCSVintoTable2($mDatabaseQueryProcessor,$json_obj,$table,$column_string,$handle);
}


public function insert_csv($table,$json_obj,$handle,$exclude_columns){
    $util_obj= new Utilties();
	$mDatabaseQueryProcessor =new DatabaseQueryProcessor();	
    $column_string= $util_obj->getColumnsString($mDatabaseQueryProcessor,$table,1);
    foreach($exclude_columns as $row){
	$column_string=str_replace(",".$row," ",$column_string);
	}
	
	return $util_obj->insertCSVintoTable($mDatabaseQueryProcessor,$json_obj,$table,$column_string,$handle);
}

public function insert_into_evoucher_installments_tb1($order_id, $depost,$agent,$trans_id ){
    $util_obj= new Utilties();
	$mDatabaseQueryProcessor =new DatabaseQueryProcessor();
	$table="evoucher_installments_tb";		 
	$columns=" order_id, depost,agent, trans_id";					
	$values="'$order_id', '$depost','$agent', '$trans_id'";		
    return $util_obj->insert_into($mDatabaseQueryProcessor,$table,$columns, $values);
}

public function insert_into_evoucher_installments_tb($order_id, $depost ){
    $util_obj= new Utilties();
	$mDatabaseQueryProcessor =new DatabaseQueryProcessor();
	$table="evoucher_installments_tb";		 
	$columns=" order_id, depost";					
	$values="'$order_id', '$depost'";		
    return $util_obj->insert_into($mDatabaseQueryProcessor,$table,$columns, $values);
}

public function insert_into_evoucher_orders_tb($equipment_id, $farmer_id, $quantity, $reg_date ){
    $util_obj= new Utilties();
	$mDatabaseQueryProcessor =new DatabaseQueryProcessor();
	$table="evoucher_orders_tb";		 
	$columns="equipment_id, farmer_id, quantity, reg_date";					
	$values="'$equipment_id', '$farmer_id', '$quantity',  '$reg_date'";		
    return $util_obj->insert_into($mDatabaseQueryProcessor,$table,$columns, $values);
}

public function insert_into_evoucher_targets_tb($Trained, $Ordered, $Distributed ){
    $util_obj= new Utilties();
	$mDatabaseQueryProcessor =new DatabaseQueryProcessor();
	$table="evoucher_targets_tb";		 
	$columns="farmer_Trained_target, equipment_ordered_target, equipment_distributed_target";					
	$values="'$Trained', '$Ordered', '$Distributed'";		
    return $util_obj->insert_into($mDatabaseQueryProcessor,$table,$columns, $values);
}

//evoucher_targets_tb
public function insert_into_evoucher_farmer_reg_tb($name, $phone,$gender ){
    $util_obj= new Utilties();
	
	
	$mDatabaseQueryProcessor =new DatabaseQueryProcessor();
	$table="evoucher_farmer_reg_tb";		 
	$columns="name,phone,gender";					
	$values="'$name', '$phone','$gender'";		
    return $util_obj->insert_into($mDatabaseQueryProcessor,$table,$columns, $values);
}



public function insert_into_evoucher_equipment_tb($equipment_name, $cost ){
    $util_obj= new Utilties();
	$mDatabaseQueryProcessor =new DatabaseQueryProcessor();
	$table="evoucher_equipment_tb";		 
	$columns=" equipment_name, cost";					
	$values="'$equipment_name', '$cost'";		
    return $util_obj->insert_into($mDatabaseQueryProcessor,$table,$columns, $values);
}
//

public function insert_into_evoucher_trainings_tb($training_district,$training_subcounty,$training_parish,$training_village,$training_venue, $training_date ,$training_start_time, $training_topic,$training_target ){
    $util_obj= new Utilties();
	$mDatabaseQueryProcessor =new DatabaseQueryProcessor();
	$table="evoucher_trainings_tb";		 
	$columns=" training_date,training_district,  training_sub_county, training_parish,training_village,training_venue , training_start_time,training_end_time, training_topic, training_target";					
	$values="'$training_date', '$training_district', '$training_subcounty','$training_parish','$training_village' ,'$training_venue', '$training_start_time','6:00 PM', '$training_topic','$training_target'";		
    return $util_obj->insert_into($mDatabaseQueryProcessor,$table,$columns, $values);
}


public function insert_into_evoucher_deliveries_tb($order_id, $deliverer, $phone ){
    $util_obj= new Utilties();
	$mDatabaseQueryProcessor =new DatabaseQueryProcessor();
	$table="evoucher_deliveries_tb";		 
	$columns=" order_id, deliverer, phone";					
	$values="'$order_id', '$deliverer' , '$phone'";		
    return $util_obj->insert_into($mDatabaseQueryProcessor,$table,$columns, $values);
}


//CREATE VIEW evoucher_order_v as SELECT *,(select `f`.`name` from `evoucher_farmer_reg_tb` `f` where (`f`.`id` = `a`.`farmer_id`)) AS `farmer_name`,(select `f`.`phone` from `evoucher_farmer_reg_tb` `f` where (`f`.`id` = `a`.`farmer_id`)) AS `farmer_phone`,(select `k`.`equipment_name` from `evoucher_equipment_tb` `k` where (`k`.`id` = `a`.`equipment_id`)) AS `equipment_name`, (select SUM(`b`.`depost`) from `evoucher_installments_tb` `b` where (`b`.`order_id` = `a`.`id`)) AS `deposit` FROM evoucher_orders_tb a

public function get_count($table,$where)
{   $mDatabaseQueryProcessor =new DatabaseQueryProcessor();
    $query="SELECT COUNT(*) FROM ".$table." WHERE ".$where; 
	#do the query
	$mDatabaseQueryProcessor ->setResultForQuery($query);
	$row=$mDatabaseQueryProcessor->getResultArray();
    return array_shift($row);
}

public function get_sum($table,$column,$where)
{   $mDatabaseQueryProcessor =new DatabaseQueryProcessor();
    $query="SELECT SUM($column) AS SUM FROM ".$table." WHERE ".$where; 
	#do the query
	$mDatabaseQueryProcessor ->setResultForQuery($query);
	$row=$mDatabaseQueryProcessor->getResultArray();
    return array_shift($row);
}

public function check_table_exists($table){
    $mDatabaseQueryProcessor =new DatabaseQueryProcessor();
	$db=$mDatabaseQueryProcessor->getDB();
    $query="SELECT count(*) FROM information_schema.TABLES
             WHERE (TABLE_SCHEMA = '$db') AND (TABLE_NAME = '$table')"; 
	#do the query
	$mDatabaseQueryProcessor ->setResultForQuery($query);
	$row=$mDatabaseQueryProcessor->getResultArray();
    return array_shift($row);
}


public function delete($table,$where){
    $query= "DELETE FROM ".$table." WHERE ".$where;
	$mDatabaseQueryProcessor =new DatabaseQueryProcessor();	
    return $mDatabaseQueryProcessor->setResultForQuery($query);
}

public function fetch_rows($table,$columns,$where){
    $util_obj= new Utilties();
	$mDatabaseQueryProcessor = new DatabaseQueryProcessor();
	return $util_obj->get_result_array($mDatabaseQueryProcessor,$table,$columns,$where);
}

public function fetch_rows_byQuery($query){
    $util_obj= new Utilties();
	$mDatabaseQueryProcessor = new DatabaseQueryProcessor();
	return $util_obj->get_result_array_fromQuery($mDatabaseQueryProcessor,$query);
}


public function file_url_base(){
// getting server ip address
    $server_ip = gethostbyname(gethostname());
 
    // final file url that is being uploaded
    $file_url = 'http://' . $server_ip . '/' . 'ezyagrice/ezyagric_mobile' ;
	return $file_url ;
}

public function getTimeAgo($timestamp){
$time_mss=strtotime($timestamp);
$now_mss=strtotime("now") ;

$diff_mss=($now_mss-$time_mss)*-1*1000;



$seconds = floor($diff_mss / 1000);



$minutes = floor($seconds / 60);

$hours = floor($minutes / 60);

$days = round($hours / 24);

return $seconds;
}


}

?>