<?php
#includes
require_once "../user_functions/crud_functions_class.php";

$crud_obj = new CrudFunctions ();

if(isset($_GET['token'])){
switch($_GET['token']){

case 'delete' :
$id=$_GET['id'];
$flag=$crud_obj->delete("evoucher_orders_tb","id='$id'");
if($flag){
$crud_obj->delete("evoucher_installments_tb","order_id='$id'");
echo"Action  Done";
}else{
echo"Action Not Done";

}

break;
case 'delete_all' :
$flag=$crud_obj->delete("evoucher_orders_tb",1);
if($flag){
$crud_obj->delete("evoucher_installments_tb",1);
echo"Action  Done";

}else{
echo"Action Not Done";

}

break;

}
}

?>