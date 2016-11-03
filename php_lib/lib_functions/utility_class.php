<?php

Class Utilties{

public function __construct(){
	
}

public function getJsonArrayFromUrl($url,$format){
    
	$out=array();
	$content = $this->get_url_content(str_replace('{format}',$format,$url)); 
	$out= null;
	if($content) {
	
		if($format == "json") {
			$json = json_decode($content,true);
			$out=$json['data'];
		}
	}
	return $out;
}

 public function deliver_response($status,$status_message,$data ){

    header("HTTP/1.1 $status $status_message");
    
   
	if($data!=null){
	 $response=$data;
	}else{
	$response['status']=$status;
    $response['status_message']=$status_message;
	}

    $json_response=json_encode($response);
	
    echo $json_response;
	
    }

public function get_url_content($url) {
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,1);
	$content = curl_exec($ch);
	curl_close($ch);
	return $content;
}

public function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
}

public function getHostIp() {
	return $_SERVER['SERVER_ADDR'];//getenv("SERVER_ADDR");
}

public function getClientIp() {
   return $_SERVER['REMOTE_ADDR'];//getenv("REMOTE_ADDR");
}

public function ChangeTimeZone( $current_date,$to_time_zone ) {
$default_time_zone= date_default_timezone_get();
$date= new DateTime($current_date, new DateTimeZone($default_time_zone));
$date->setTimeZone( new DateTimeZone($to_time_zone));
return $date->format('Y-m-d H:i:s');
}

/*
* @param $value
 * @return mixed
 */
public function escapeJsonString($value) { # list from www.json.org: (\b backspace, \f formfeed)
    $escapers = array("\\", "/", "\"", "\n", "\r", "\t", "\x08", "\x0c");
    $replacements = array("\\\\", "\\/", "\\\"", "\\n", "\\r", "\\t", "\\f", "\\b");
    $result = str_replace($escapers, $replacements, $value);
    return $result;
}

public function mysql_prep( $value ) {
		return addslashes($value);
}
public function escape_csv_value($value){
    $value=str_replace('"','""',$value);// escape all " and make them ""
     if(preg_match('/,/',$value) or preg_match("/\n/",$value) or preg_match('/"/',$value)){// check if any commas or new lines
        return '"'.$value.'"';// if new line or commas escape them
     }else{
        return $value;
     }

}

// Generates a strong password of N length containing at least one lower case letter,
// one uppercase letter, one digit, and one special character. The remaining characters
// in the password are chosen at random from those four sets.
//
// The available characters in each set are user friendly - there are no ambiguous
// characters such as i, l, 1, o, 0, etc. This, coupled with the $add_dashes option,
// makes it much easier for users to manually type or speak their passwords.
//
// Note: the $add_dashes option will increase the length of the password by
// floor(sqrt(N)) characters.
 
public function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
{
	$sets = array();
	if(strpos($available_sets, 'l') !== false)
		$sets[] = 'abcdefghjkmnpqrstuvwxyz';
	if(strpos($available_sets, 'u') !== false)
		$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
	if(strpos($available_sets, 'd') !== false)
		$sets[] = '23456789';
	//if(strpos($available_sets, 's') !== false)
		//$sets[] = '!@#$%&*?';
 
	$all = '';
	$password = '';
	foreach($sets as $set)
	{
		$password .= $set[array_rand(str_split($set))];
		$all .= $set;
	}
 
	$all = str_split($all);
	for($i = 0; $i < $length - count($sets); $i++)
		$password .= $all[array_rand($all)];
 
	$password = str_shuffle($password);
 
	if(!$add_dashes)
		return $password;
 
	$dash_len = floor(sqrt($length));
	$dash_str = '';
	while(strlen($password) > $dash_len)
	{
		$dash_str .= substr($password, 0, $dash_len) . '-';
		$password = substr($password, $dash_len);
	}
	$dash_str .= $password;
	return $dash_str;
}

public function dateBefore($date){
    $one_day= strtotime(date("Y-m-d"))-strtotime("-1 days");
    $day_before=strtotime($date)-$one_day;
	return getdate($day_before);
}

public function dateAfter($date){
    $one_day= strtotime(date("Y-m-d"))-strtotime("-2 days");
    $day_after=strtotime($date)+$one_day;
	return getdate($day_after);
}


public function minutesBetween($time1,$time2){
    $diff_minutes = floor((strtotime($time2)-strtotime($time1))/86400);//;round((strtotime($time2) - strtotime($time1)) / 60,2);
	return $diff_minutes;
}
public function daysBetween($date1,$date2){
  
    $diff_days = floor((strtotime($date2)-strtotime($date1))/86400);
	return $diff_days;//
}

public function insert_into($db,$table,$columns,$values)
{
    $insert_query="INSERT INTO ".$table."(".$columns.") VALUES(".$values.")"; 
	#do the insertion
    return $db->setResultForQuery($insert_query);
}



public function update_table($db,$table,$columns_value,$where)
{
    $insert_query="UPDATE ".$table."  SET ".$columns_value." WHERE ".$where." "; 
	#do the insertion
    return $db->setResultForQuery($insert_query);
}


public function get_result_array($db,$table,$columns,$where)
{
   $query="SELECT ".$columns." FROM ".$table." WHERE ".$where ; 
   $db->setResultForQuery($query);
   return $db->getFullResultArray();;
}

public function get_result_array_fromQuery($db,$query)
{
   $db->setResultForQuery($query);
   return $db->getFullResultArray();;
}

public function getColumnsString($db,$table,$where){

    $query="SELECT * FROM ".$table." WHERE ".$where ; 
    $flag=$db->setResultForQuery($query);
    $fields=$db->getNoOfFieldsInResult();
	$index = 0;
	$column_string="";
	
	
	
	while ($index < $fields)
	{
		if($index==($fields-1)){
		$column_string.= $db->getFieldNameInResult($index)." ";
		}else{
		if($index==0){}else{$column_string.= $db->getFieldNameInResult($index)." ,";}
		}
		$index++;
	}
	
    return $column_string;
}

public function insertCSVintoTable($db,$json_obj,$table,$column_string,$handle){
   $counter=1;
   $uninserted_rows=" ";
   while($data = fgetcsv($handle,0,",","'")){
         
		 if($counter>1){
		 $real_data="";
		 $j=0;
		 
		
		 $value1=(int) str_replace('WFP','',str_replace('"',"",$data[5]));
		 $value2=str_replace('"',"",$data[10]);
		 $value3=str_replace('"',"",$data[9]);
		 $value4=str_replace('"',"",$data[2]);
		 
		
		  $real_data=" '$value1' ,'$value2','$value3','$value4'";
		
		 $query= " INSERT INTO ".$table." (". $column_string.") VALUES ( " .$real_data.") " ;
		 
	     try{
		 $existance=$json_obj->get_count($table,"trans_id='$value4'");
		 if($existance==0){
		 $flagx=$db->setResultForQuery($query);
		 }
		 if(!$flagx){
		   throw new Exception($counter+1);
		 }
		 }catch(Exception $e){
		 echo $e->getMessage();
		 $uninserted_rows= $uninserted_rows.",".$e->getMessage();
		 }
		 }
		 $counter++;
	}
    return $uninserted_rows;
}

public function insertCSVintoTable2($db,$json_obj,$table,$column_string,$handle){
   $counter=1;
   $uninserted_rows=" ";
   while($data = fgetcsv($handle,0,",","'")){
         
		 if($counter>1){
		 $real_data="";
		 $j=0;
		
		 $id=(int) str_replace('WFP','',str_replace('"',"",$data[0]));//id
		 
		 try{
		 $existance=$json_obj->get_count($table,"id='$id'");
		 if($existance==0){
		 
		 $equipment_id=str_replace('"',"",$data[1]);//equipment
		 
		 $farmer_name=str_replace('"',"",$data[4]);
		 $gender=str_replace('"',"",$data[5]);
		 if($gender=="M"){
		 $gender='male';
		 }else{
		  $gender='female';
		 }
		 $farmer_phone=str_replace('"',"",$data[7]);
		 
		 $json_obj->insert_into_evoucher_farmer_reg_tb($farmer_name,$farmer_phone,$gender );
		 
		 $farmer_id=(int)$json_obj->fetch_rows("evoucher_farmer_reg_tb","*","phone='$farmer_phone' LIMIT 1")[0]['id'];
		 
		 $event_id=str_replace('"',"",$data[2]);//event
		 
		 $va_phone=str_replace('"',"",$data[3]);//va-phone
		 
		 
		 
		 $value6=1;//
		
		 $value8=(int)str_replace('"',"",$data[8]);
		 $value9=(int)str_replace('"',"",$data[9]);
		  $value7=$value8+$value9;
		  
		  $json_obj->insert_into_evoucher_installments_tb($id, $value8 );
		  
		 //`id`, `equipment_id`, `farmer_id`, `event_id`, `va_id`, `quantity`, `selling_price`
		  $real_data=" '$id' ,'$equipment_id','$farmer_id','$event_id','$va_phone','$value6','$value7'";
		
		 $query= " INSERT INTO ".$table." ("."id,".$column_string.") VALUES ( " .$real_data.") " ;
		 
		 
		 $flagx=$db->setResultForQuery($query);
		 }
		 if(!$flagx){
		   throw new Exception($counter+1);
		 }
		 
		 
	     
		 }catch(Exception $e){
		// echo $e->getMessage();
		 $uninserted_rows= $uninserted_rows.",".$e->getMessage();
		 }
		 }
		 $counter++;
	}
    return   $uninserted_rows;
}

public function get_acerage_from_geo($latitudes,$longitudes){
 
 if(sizeof($latitudes)>0 && sizeof($longitudes)){
 $first_lat=$latitudes[0];
 $first_long=$longitudes[0];
 
 array_push($latitudes, $first_lat);
  array_push($longitudes, $first_long);
 
 $acerage_constant=  0.00024711 ;
 $e_circum=  40091147 ;
 if(sizeof($latitudes)==sizeof($longitudes)&&$latitudes[0]==$latitudes[sizeof($latitudes)-1]&&$longitudes[0]==$longitudes[sizeof($longitudes)-1]){
 $y= array();
for($i=0;$i<sizeof($latitudes)-2 ; $i++){
$y_value=(($latitudes[$i+1]-$latitudes[0])/360)*$e_circum;
array_push($y, $y_value);
}
$x= array();
for($i=0;$i<sizeof($longitudes)-2 ; $i++){
$x_cosine=cos(($latitudes[$i+1]/180)*(22/7));
$x_value=(($longitudes[$i+1]-$longitudes[0])/360)*$e_circum*$x_cosine;
array_push($x, $x_value);
}
$area= array();
for($i=0;$i<sizeof($x)-1 ; $i++){
$area_value=(($y[$i]*$x[$i+1])-($x[$i]*$y[$i+1]))/2;
array_push($area, $area_value);
}

$total_squared=pow(array_sum($area), 2);
$final= sqrt($total_squared)*$acerage_constant;

return round($final,3);

}else{

return "InputError";

}
}else{

return 0;
}
}


/**
 * Ensures an ip address is both a valid IP and does not fall within
 * a private network range.
 */
public function validate_ip($ip)
{
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
        return false;
    }
    return true;
}


function getClientIpV4() {
		//Just get the headers if we can or else use the SERVER global
		if ( function_exists( 'apache_request_headers' ) ) {
			$headers = apache_request_headers();
		} else {
			$headers = $_SERVER;
		}
		//Get the forwarded IP if it exists
		if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
			$the_ip = $headers['X-Forwarded-For'];
		} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
		) {
			$the_ip = $headers['HTTP_X_FORWARDED_FOR'];
		} else {
			
			$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
		}
	return $the_ip;
}	
	
public function remove_apostrophes($string)
{
    return str_replace('"'," ",$string);
}

public function get_date_string($date_time)
{
    return date('j / m/  Y', strtotime($date_time));
}

public function get_time_string($date_time)
{
    return date('g:i a', strtotime($date_time));
}

public function captalizeEachWord($string){
$string= strtolower($string) ;
$string=str_replace(".","",$string);
$string=str_replace("_"," ",$string);
$string=str_replace('"'," ",$string);
return ucwords($string);
}


public function encrypt_decrypt($action, $string){ 
    $output = false; 

    $encrypt_method = "AES-256-CBC"; 
    $secret_key = '230591'; 
    $secret_iv = '233593'; 

    // hash 
    $key = hash('sha256', $secret_key); 
     
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning 
    $iv = substr(hash('sha256', $secret_iv), 0, 16); 

    if( $action == 'encrypt' ) { 
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv); 
        $output = base64_encode($output); 
    } 
    else if( $action == 'decrypt' ){ 
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv); 
    } 

    return $output; 
}  



}
?>