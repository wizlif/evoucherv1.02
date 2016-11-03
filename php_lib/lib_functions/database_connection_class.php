<?php
#includes
require_once "../php_lib/config/database_config.php";
require_once('server_connection_class.php');

Class DatabaseConnection {

protected $_database_name;
protected $_connection_object;

public function __construct(){  
   $this->intializeDatabaseConnection();
}

public function setDatabaseName($database_name){
    $this->_database_name=$database_name;
}

public function getDatabaseName(){
    return $this->_database_name;
}

public function setDatabaseConnection($database,$connection){
   mysql_select_db( $database,$connection) or
   die('Could not connect to the database: '.$this->getDatabaseName().' error: '. mysql_error());

}

public function intializeDatabaseConnection(){
 
   $db_config= new database_config(); 
   $this->setDatabaseName($db_config->_database_name);
   $this->_connection_object= new ServerConnection();
   $this->setDatabaseConnection($this->getDatabaseName(),$this->_connection_object->getServerConnection());
}

public function getDatabaseConnection(){
  return $this->_connection_object->getServerConnection();
}

}
?>