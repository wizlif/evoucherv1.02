<?php
#includes
require_once "../php_lib/config/database_config.php";

Class ServerConnection{

protected $_server_name;
protected $_user_name;
protected $_password;
protected $_connection;

public function __construct(){
	$this->initializeServerConnection(); 
}

public function setServerName($server_name){
    $this->_server_name=$server_name;
}

public function getServerName(){
    return $this->_server_name;
}

public function setUserName($user_name){
    $this->_user_name=$user_name;
}

public function getUserName(){
    return $this->_user_name;
}

public function setPassword($password){
    $this->_password=$password;
}

public function getPassword(){
    return $this->_password;
}
public function setServerConnection(){
      $this->_connection=mysql_connect($this->getServerName(), 
						             $this->getUserName() , 
						             $this->getPassword()
						             ) 
						or 
						die('Could not connect to Host: '.$this->getServerName().' error: '. mysql_error());																
}

public function getServerConnection(){
    return $this->_connection;
}
public function initializeServerConnection(){
   $db_config= new database_config();  
   $this->setServerName($db_config->_server_name);
   $this->setUserName($db_config->_user_name);
   $this->setPassword($db_config->_password); 
   $this->setServerConnection();
}


}
?>