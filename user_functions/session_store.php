<?php
session_start();
require_once "./php_lib/lib_functions/utility_class.php";


$util_obj= new Utilties();

if( isset($_SESSION["login_id"]) && $_SESSION["login_id"]!=""){
//$util_obj->redirect_to( "dashboard.php" );

}else{
$util_obj->redirect_to("index.php");
}
?>