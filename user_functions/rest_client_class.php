<?php
require_once $_SERVER['DOCUMENT_ROOT']."/FollowMe/php_lib/lib_functions/utility_class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/FollowMe/php_lib/lib_functions/database_query_processor_class.php";

class RestClient {

    public function __call($name, $arguments) {
 
		switch($name)
        {
        case 'getDailyDevotions';
	      return $this->getDailyDevotions($arguments);
          break;
		 case 'getMyDevotions';
	      return $this->getMyDevotions($arguments);
          break;
		  
		 case 'getPastors';
	      return $this->getPastors($arguments);
          break;
		
		 case 'getMyFollowers';
	      return $this->getMyFollowers($arguments);
          break;
		  
		 case 'getMyPastors';
	      return $this->getMyPastors($arguments);
          break;
		  
		  case 'getLifePoints';
	      return $this->getLifePoints($arguments);
          break;
		  
		 case 'getMyLifePoints';
	      return $this->getMyLifePoints($arguments);
          break;
		  
		  
        default:
		   echo "Called method $name not available"."<br>";
        }
		
    }
 
  /////////////////////////////////////////////////////////////////////////////////////////////////////
  /*****                                                                                          ****/
  /////////////////////////////////////////////////////////////////////////////////////////////////////
  
   private function getDailyDevotions($arguments) {
    
		$count = count($arguments);
        switch($count)
        {
		
		case 1: 
	      return $this->fetch_daily_devotionals($arguments[0]);
          break;
		  
        default:
		   return null;
         
        }
   }
   
   private function getMyFollowers($arguments) {
    
		$count = count($arguments);
        switch($count)
        {
		
		case 1: 
	      return $this->fetch_myfollowers($arguments[0]);
          break;
		  
        default:
		   return null;
         
        }
   }
   
   private function getMyDevotions($arguments) {
    
		$count = count($arguments);
        switch($count)
        {
		
		case 1: 
	      return $this->fetch_my_devotionals($arguments[0]);
          break;
		  
        default:
		   return null;
         
        }
   }
  
  private function getPastors($arguments) {
    
		$count = count($arguments);
        switch($count)
        {
		
		case 1: 
	      return $this->fetch_pastors($arguments[0]);
          break;
		  
        default:
		   return null;
         
        }
   }
   
   private function getMyPastors($arguments) {
    
		$count = count($arguments);
        switch($count)
        {
		
		case 1: 
	      return $this->fetch_mypastors($arguments[0]);
          break;
		  
        default:
		   return null;
         
        }
   }
   
   private function getLifePoints($arguments) {
    
		$count = count($arguments);
        switch($count)
        {
		
		case 1: 
	      return $this->fetch_lifepoints($arguments[0]);
          break;
		  
        default:
		   return null;
         
        }
   }
   
   private function getMyLifePoints($arguments) {
    
		$count = count($arguments);
        switch($count)
        {
		
		case 1: 
	      return $this->fetch_mylifepoints($arguments[0]);
          break;
		  
        default:
		   return null;
         
        }
   }
  
   private function get_pastors_json($pastors){
    $response["pastors"] = array();
	
	foreach($pastors as $pastor) {

	        $data = array();
        	$data["id"] = $pastor["id"];
			$data["username"] = $pastor["username"];
			$data["useremail"] = $pastor["useremail"];
			$data["userimageurl"] = $pastor["userimageurl"];
			$data["description"] = $pastor["description"];
			$data["time"] = $pastor["time"];
			$data["followers"] = $pastor["followers"];
			$data["devotions"] = $pastor["devotions"]; 
            array_push($response["pastors"], $data);
    }
	return $response;
   }
   
   private function get_followers_json($followers){
    $response["followers"] = array();
	foreach($followers as $follower) {

	        $data = array();
        	$data["sheep_id"] = $follower["sheep_id"];
			$data["username"] = $follower["username"];
			$data["useremail"] = $follower["useremail"];
			$data["userimageurl"] = $follower["userimageurl"];
			$data["description"] = $follower["description"];
			$data["time"] = $follower["time"];
			$data["followers"] = $follower["followers"];
			$data["devotions"] = $follower["devotions"]; 
            array_push($response["followers"], $data);
    }
	return $response;
   }
  
  private function get_mypastors_json($pastors){
    $response["mypastors"] = array();
	foreach($pastors as $pastor) {

	        $data = array();
        	$data["pastor_id"] = $pastor["pastor_id"];
			$data["username"] = $pastor["username"];
			$data["useremail"] = $pastor["useremail"];
			$data["userimageurl"] = $pastor["userimageurl"];
			$data["description"] = $pastor["description"];
			$data["time"] = $pastor["time"];
			$data["followers"] = $pastor["followers"];
			$data["devotions"] = $pastor["devotions"]; 
            array_push($response["mypastors"], $data);
    }
	return $response;
   }
  
  
  private function get_lifepoints_json($lifepoints){
    $response["lifepoints"] = array();
	foreach($lifepoints as $lifepoint) {

	        $data = array();
        	$data["id"] = $lifepoint["id"];
			$data["author_id"] = $lifepoint["author_id"];
			$data["name"] = $lifepoint["name"];
			$data["userimageurl"] = $lifepoint["userimageurl"];
			$data["lifepoint"] = $lifepoint["lifepoint"];
			$data["time"] = $lifepoint["time"]; 
            array_push($response["lifepoints"], $data);
    }
	return $response;
   }
   
   private function get_mylifepoints_json($lifepoints){
    $response["mylifepoints"] = array();
	foreach($lifepoints as $lifepoint) {

	        $data = array();
        	$data["id"] = $lifepoint["id"];
			//$data["author_id"] = $lifepoint["author_id"];
			$data["lifepoint"] = $lifepoint["lifepoint"];
			$data["time"] = $lifepoint["time"]; 
            array_push($response["mylifepoints"], $data);
    }
	return $response;
   }
  
  
  
  private function get_devotionals_json($devotions){
    $response["daily_devotions"] = array();
	
	foreach($devotions as $devotion) {

	        $data = array();
        	$data["id"] = $devotion["id"];
			$data["author_id"] =$devotion["author_id"];
			$data["name"] =$devotion["name"];
			$data["imgurl"] =$devotion["imgurl"];
			$data["title"] = $devotion["title"];
			$data["scripture"] = $devotion["scripture"];
			$data["message"] = $devotion["message"];
			$data["time"] = $devotion["time"];
            
            array_push($response["daily_devotions"], $data);
    }
	return $response;
   }
  
  private function get_mydevotionals_json($devotions){
    $response["my_devotions"] = array();
	
	foreach($devotions as $devotion) {

	        $data = array();
        	$data["id"] = $devotion["id"];
			$data["author_id"] =$devotion["author_id"];
			$data["title"] = $devotion["title"];
			$data["scripture"] = $devotion["scripture"];
			$data["message"] = $devotion["message"];
			$data["time"] = $devotion["time"];
            
            array_push($response["my_devotions"], $data);
    }
	return $response;
   }
  
   private function fetch_my_devotionals($author_id){
    $query="SELECT *FROM devotions where author_id='$author_id'  ";	
    return $this->get_mydevotionals_array($query);
   }
   
   private function fetch_mylifepoints($author_id){
    $query="SELECT *FROM lifepoints where author_id='$author_id'  ";	
    return $this->get_mylifepoints_array($query);
   }
   
   private function fetch_lifepoints($my_id){
    $query="SELECT *FROM lifepoints_v where sheep_id='$my_id'  ";	
    return $this->get_lifepoints_array($query);
   }
   
   private function fetch_pastors($my_id){
    $query="SELECT *FROM users_v where id !='$my_id'  ";	
    return $this->get_pastors_array($query);
   }
   
   private function fetch_mypastors($my_id){
    $query="SELECT *FROM mypastors_v where sheep_id ='$my_id'  ";	
    return $this->get_mypastors_array($query);
   }
  
   private function fetch_daily_devotionals($sheep_id){
    $query="SELECT *FROM devotions_v where sheep_id='$sheep_id'  ";	
    return $this->get_devotionals_array($query);
   }
   
   private function fetch_myfollowers($my_id){
    $query="SELECT *FROM followers_v where pastor_id='$my_id'  ";	
    return $this->get_myfollowers_array($query);
   }
   
   private function get_mydevotionals_array($query){
    $devotionals=$this->get_result($query);
    return $this->get_mydevotionals_json($devotionals);
  }	
  
  private function get_lifepoints_array($query){
    $lifepoints=$this->get_result($query);
    return $this->get_lifepoints_json($lifepoints);
  }	
  private function get_mylifepoints_array($query){
    $lifepoints=$this->get_result($query);
    return $this->get_mylifepoints_json($lifepoints);
  }	
  
  private function get_myfollowers_array($query){
    $followers=$this->get_result($query);
    return $this->get_followers_json($followers);
  }	
   private function get_mypastors_array($query){
    $mypastors=$this->get_result($query);
    return $this->get_mypastors_json($mypastors);
  }	
   
  private function get_devotionals_array($query){
    $devotionals=$this->get_result($query);
    return $this->get_devotionals_json($devotionals);
  }	
  private function get_pastors_array($query){
    $pastors=$this->get_result($query);
    return $this->get_pastors_json($pastors);
  }	
 
  /////////////////////////////////////////////////////////////////////////////////////////////////////
  /*****                                                                                          ****/
  //////////////////////////////////////////////////////////////////////////////////////////////////////
  private function get_result($query){
   $mDatabaseQueryProcessor =new DatabaseQueryProcessor();
   $mDatabaseQueryProcessor->setResultForQuery($query);
   return $mDatabaseQueryProcessor->getFullResultArray();;
  }	
  public function deliver_response($status,$status_message,$data ){

    header("HTTP/1.1 $status $status_message");
    $response['status']=$status;
    $response['status_message']=$status_message;
    $response['data']=$data;

    $json_response=json_encode($response);

    echo $json_response;
	
    }
}

?>