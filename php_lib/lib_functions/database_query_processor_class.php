<?php 
#includes
require_once('database_connection_class.php');

/*
This class methods for performing queries to the database
*/
Class DatabaseQueryProcessor extends DatabaseConnection{

protected $_result;
protected $_connection_object;


public function __construct(){
	ini_set('memory_limit', '256M');
}

public function setResultForQuery($query){
	$this->_connection_object= new DatabaseConnection();;
	
        $this->_result= mysql_query($query) ;//or mysql_error() or  die();
	
	$this->terminateConnection($this->_connection_object->getDatabaseConnection());
	
	return $this->_result;
}

public function getFullResultArray(){
    while(($resultArray[]= mysql_fetch_assoc($this->_result))|| array_pop($resultArray));
    return $resultArray;
}
public function getSingleRowArray($index){
    while(($resultArray[]= mysql_fetch_assoc($this->_result))|| array_pop($resultArray));
    return $resultArray[$index];
}

public function getFullResultArrayOfObjects(){
    while(($resultObjectArray[]= mysql_fetch_object($this->_result))|| array_pop($resultObjectArray));
    return $resultObjectArray;
}

public function getSingleRowObject($index){
    while(($resultObjectArray[]= mysql_fetch_object($this->_result))|| array_pop($resultObjectArray));
    return $resultObjectArray[$index];
}
public function getResult(){
    return $this->_result;
}

public function getNoOfFieldsInResult(){
    return mysql_num_fields($this->_result);
}

public function getFieldNameInResult($index){
     $meta = mysql_fetch_field($this->_result, $index);
	 return  $meta->name ;
}

public function getNoOfRowsInResult(){
    return mysql_num_rows($this->_result);
}

public function getResultArray(){
    return mysql_fetch_array($this->_result);
}

public function terminateConnection($connection){
	mysql_close( $connection);
	unset($this->_connection_object);
}

public function getResultXML(){
    header('Content-Type: text/xml');
    print '<?xml version="1.0"?>' . "\n";
    print "<table>\n";

    $rows =$this->getFullResultArray(); 
    foreach ($rows as $row) {
    print " <row>\n";
         foreach($row as $tag => $data) {
         print " <$tag>" . htmlspecialchars($data) . "</$tag>\n";
         }
    print " </row>\n";
    }
    print "</table>\n";
      
}



}





?>