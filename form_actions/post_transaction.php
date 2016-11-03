<?php
#includes
require_once "../user_functions/crud_functions_class.php";

$crud_obj = new CrudFunctions ();

if(isset($_POST['token'])){

switch($_POST['token']){

case 'deposit' :

if(isset($_POST['order_id'])&&
isset($_POST['deposit'])&&
isset($_POST['agent'])&&
isset($_POST['trans_id'])
){

$order_id=$_POST['order_id'];
$depost=$_POST['deposit'];
$agent=$_POST['agent'];
$trans_id=$_POST['trans_id'];

$rows=$crud_obj->fetch_rows("installments_tb","*"," order_id='$order_id'");
if(sizeof($rows)==0){
$crud_obj->insert_into_evoucher_installments_tb1($order_id, $depost,$agent,$trans_id );
}

}
break;


}
}

?>