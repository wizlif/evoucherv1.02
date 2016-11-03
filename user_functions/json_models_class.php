<?php
#includes
require_once('crud_functions_class.php');

class JSONModel extends CrudFunctions{


public function get_constants_json($rows){

 $response = array();
 
    $response['farmers']=$rows[0]['farmer_Trained_target'];
    $response['orders']=$rows[0]['equipment_ordered_target'];
	$response['distribution']=$rows[0]['equipment_distributed_target'];
	
return $response ;
}


public function get_progress_json($date1,$date2){

$defaults=$this->fetch_rows_byQuery("SELECT  *
FROM  evoucher_targets_tb WHERE 1 LIMIT 1");

if($date1!=""&&$date2!=""){
$farmers=$this->get_sum("evoucher_attendace_v","attendence","DATE(training_date) <= DATE '$date2'");
$orders=$this->get_sum("equipment_graph_data_v","ttl","DATE(real_date) <= DATE '$date2'");
$distributed=$this->get_sum("equipment_graph_data_v","complete_ttl"," DATE(real_date) <= DATE '$date2'");

}else{
$farmers=$this->get_sum("evoucher_attendace_v","attendence",1);
$orders=$this->get_sum("equipment_graph_data_v","ttl",1);
$distributed=$this->get_sum("equipment_graph_data_v","complete_ttl",1);

}

$tfarmers=$defaults[0]['farmer_Trained_target'];
$torders=$defaults[0]['equipment_ordered_target'];
$tdistribution=$defaults[0]['equipment_distributed_target'];

$perc_farmer=($farmers/$tfarmers)*100;

$perc_order=($orders/$torders)*100;
$perc_distributed=($distributed/$tdistribution)*100;

 $response = array();
 $response['credits']=array('enabled'=>0);
 $response['exporting']=array('enabled'=>false);
 $response['chart']=array('type'=>'bar');
 $response['title']=array('text'=>'Project Performance');
  
 $response['xAxis']= array('categories'=>array('Farmers Trained', 'Equipment Ordered', 'Equipment Distributed'));
 
 $response['yAxis']= array('min'=>0,'max'=>100,'title'=>array('text'=>'<b>Percentage Progress</b>'));
 $response['legend']=array('reversed'=>true,'enabled'=>true,'floating'=>true,'verticalAlign'=>'top','align'=>'right','y'=>10);
 
 $response['plotOptions']=array('series'=>array('stacking'=>'normal'));
 
 $response['series']=array();
 
 for($i=0;$i<2;$i++){
 $data=array();
 
 
 $perc_farmer_=floor(100-$perc_farmer);
 $perc_order_=floor(100-$perc_order);
 $perc_distributed_=floor(100-$perc_distributed);
 
 if($i==0){
 
 
  $data_=array();
  $data_[0]=$perc_farmer_;
  $data_[1]=$perc_order_;
  $data_[2]=$perc_distributed_;
  $data['name']='Incomplete';
  $data['data']=$data_;
  
 }else{
 
  $data_=array();
  $data_[0]=100-$perc_farmer_;
  $data_[1]=100-$perc_order_;
  $data_[2]=100-$perc_distributed_;
  $data['color']='#1ABB9C';
  $data['name']='Complete';
  $data['data']=$data_;
 
 }
 array_push($response['series'],$data);
 }
 
  
        
 return $response;
}



 public function get_equipment_payment_graph_json($rows,$json_obj,$date1,$date2){
   
    $response = array();
	
	
    $response['credits']=array('enabled'=>0);
    $response['legend']=array('shadow'=>false);
	$response['tooltip']=array('shared'=>true);
	$response['exporting']=array('enabled'=>false);
	
	
	$response['chart']=array('type'=>'column');
	$response['title']=array('text'=>'Payment Completion Per Equipment Type');
	$response['plotOptions']=array("column"=>array('grouping'=>false,'shadow'=>false,'borderWidth'=>0));
	
	
	$response['yAxis']=array();
	array_push($response['yAxis'],array('min'=>0,'title'=>array("text"=>'Quantity')));
	
	$data9=array();
	
	$equipments_=array();
	$response['series']=array();
	$values=array();
	foreach($rows as $row) {


                $equipment=$row["equipment_intials"];
	            $equipment_initals=$row["equipment_intials"];
                if( in_array( $equipment_initals ,$data9 )  ){}else{array_push($data9, $equipment_initals);}
                array_push($equipments_, $equipment);
 
			
			
    }



     $response['xAxis']= array('categories'=>$data9);
	
	//$equipments_=array_unique($equipments_, SORT_REGULAR);
      $serialized = array_map('serialize', $equipments_);
      $unique = array_unique($serialized);
      $equipments_ =array_intersect_key($equipments_, $unique);
	
    
	for($k=0;$k<2;$k++){
	
	if($k==0){
	$data_x=array();
	$data_x['name']="Complete Payment";
	$data_x['color']="rgba(165,170,217,1)";
	$data_x['pointPadding']=0.3;
	$data_x['pointPlacement']=-0.2;
	$data=array();
	$m=0;
	foreach($equipments_ as $equipmen ){

	if($date1!=""&&$date2!=""){
	$data[$m]=(int)$json_obj->get_sum("equipment_graph_data_v","complete_ttl"," equipment_intials='$equipmen' AND DATE(real_date) >= DATE '$date1' AND DATE(real_date) <= DATE '$date2' ");
	$m++;
	}else{
	$data[$m]=(int)$json_obj->get_sum("equipment_graph_data_v","complete_ttl"," equipment_intials='$equipmen' ");
	$m++;
	}
	
	}
	
	$data_x['data']=$data;
	array_push($response['series'],$data_x);
	}else{
	
	$data_y=array();
	$data_y['name']="InComplete Payment";
	$data_y['color']="rgba(126,86,134,.9)";
	$data_y['pointPadding']=0.4;
	$data_y['pointPlacement']=-0.2;
	$data=array();
	$m=0;
	foreach($equipments_ as $equipmen ){
	if($date1!=""&&$date2!=""){
	$data[$m]=(int)$json_obj->get_sum("equipment_graph_data_v","incomplete_ttl"," equipment_intials='$equipmen' AND DATE(real_date) >= DATE '$date1' AND DATE(real_date) <= DATE '$date2' ");
	$m++;
	}else{
	$data[$m]=(int)$json_obj->get_sum("equipment_graph_data_v","incomplete_ttl"," equipment_intials='$equipmen' ");
	$m++;
	}
	
	
	
	}
	
	$data_y['data']=$data;
	
	array_push($response['series'],$data_y);
	}
	
	
	}

	return $response;

	}

   public function get_equipment_graph_json($rows,$json_obj){
   
    $response = array();
	
	
    $response['credits']=array('enabled'=>0);

	$response['exporting']=array('enabled'=>false);
	
	
	$response['chart']=array('type'=>'line');

	$response['title']=array("text"=>'Ordered Equipment');
	
	$response['yAxis']=array();
	 array_push($response['yAxis'],array('min'=>0,'title'=>array("text"=>'Quantity')));
	
	 $label['items']=array();
	 array_push($label['items'],array(' html'=>'','style'=>array("left"=>'50px',"top"=> '18px',
                    "color"=> '(Highcharts.theme && Highcharts.theme.textColor) || #fff ' )));
	
	$value__= $label['items'];
	
	$response['labels']=array('items'=>$value__);
	
	$data9=array();
	
	$equipments_=array();
	$response['series']=array();
	$values=array();
	foreach($rows as $row) {


                $equipment=$row["equipment_name"];
	        $date=$row["date_x"];
                if( in_array( $date ,$data9 )  ){}else{array_push($data9, $date);}
                array_push($equipments_, $equipment);
 
			
			
    }



     $response['xAxis']= array('categories'=>$data9);
	
	//$equipments_=array_unique($equipments_, SORT_REGULAR);
      $serialized = array_map('serialize', $equipments_);
      $unique = array_unique($serialized);
      $equipments_ =array_intersect_key($equipments_, $unique);
	

 
	
	foreach( $equipments_ as $equipment){
	$data=array();
	

	$data['type']='column';
	$data['name']=$equipment;
	 $data10 = array();
	foreach( $data9 as $date_x){
	
	
	$result=$json_obj->fetch_rows_byQuery("SELECT *
    FROM  equipment_graph_data_v 
    WHERE date_x='$date_x' AND equipment_name='$equipment'
    ");
	$value=0;
	if(sizeof($result)>0){
	$value=(int)$result[0]['ttl'];
	}
	
    array_push($data10, $value);
			
				
   // echo $equipment ."-".$date_x .$value."<br/>";												   
	}
	
	$data['data']=$data10;
	array_push($response['series'],$data);
	}
	
	
	
	return $response;
   }
   
   
   public function get_piechart_graph_json($titleArray,$dataArray){
   
    $response = array();
		
    $response['credits']=array('enabled'=>0);

	$response['exporting']=array('enabled'=>false);
	
	$response['chart']=array('type'=>'pie','option3d'=>array('enabled'=>true,'alpha'=>45,'beta'=>0));

	$response['title']=$titleArray;
	
	$response['tooltip']=array("pointFormat"=>'{series.name}: <b>{point.percentage:.1f}%</b>');
	
	$response['plotOptions']=array(
	"pie"=>array(
	"allowPointSelect"=>true,
	'cursor'=>'pointer',
	'depth'=>30,
	'dataLabels'=>array(
	'enabled'=>true,
	'format'=>'{point.name}'
	)));
	
	$response['series']=array();
	 array_push($response['series'],$dataArray);
	

	return $response;
   }
   
   
   
  
    public function get_events_json($rows){
  
    $response = array();
	
	$response['header']=array('left'=>'prev,next today','center'=>'title','right'=>'month,agendaWeek,agendaDay');
    $response['selectable']=true;
	$response['selectHelper']=true;
	$response['editable']=false;
	$response['timeFormat']='h: mm T';
	
	 $response['buttonText']=array("today"=>"TODAY",'month'=>"MONTH",'week'=>"WEEK",'day'=>'DAY');
	 $response['select']=null;
	 

	
	$item['events'] = array();
	foreach($rows as $row) {
       
			$data = array();
			$id=$row["id"];
        	$data["title"] = ucwords($row["training_venue"]);
			$start = $row["training_start_time"];
			$end=$row["training_end_time"];
			$data["start"] =$row["training_date"]." ".date("H:i ", strtotime($start));
			$data["end"] =$row["training_date"]." ".date("H:i ", strtotime($end));
			//$data['allDay'] =true;
			
			$data["url"] ="metrics.php?id=".$id;
			
            array_push( $item['events'], $data);
    }
	$response['events']=$item['events'];
	return $response;
   }
   
}

?>