<?php
require_once 'DatabaseWork.php';
$DataBaseWork = new DataBaseWork();

$regid = array();				
$Data = $DataBaseWork->DeviceTokenList();

if($Data->num_rows > 0){
	while($row = $Data->fetch_assoc()) {
		array_push($regid,$row["devicetoken"]);
	}
}
/*
 $regid = Array("cBzlbUIRn54:APA91bFCJYBYj1R-P_-2ifWcigxyWMTueM8bIGoLh-U4UtOUwT-mvlqNGhkw41EcXmqMxFkyvSSBoYCGtE7wdavG0B3XE-9mm6b5VFPsajC7XZRiz-ia1kSTgsgkSOnaPCZiZubTJBRD",
 "fTNm33OGukc:APA91bHTSuNP2op3SNc6lAVtx6tfC2SEVe67fJkcDcwtqcSPpIi3gE0REvsiZKfdwgxoZCoGX79VMI_kWYy_r8t6ieWYUU5NhKgkDekxbJowBQ_4cxXcrbWFp0Sc3npjOjVOaNmkIP17",
 "e10WTH1jDmM:APA91bFrqQrYEPhJyA_FvWtYGZaUC8t7lMIR4xP-H8Ld3xGFK0kwCEGscYAi6PRWkAf96-sD1YxNKM7UOVQ-c3Kd1-xOYQVMOrXCG-5X_GOMEBRGMk9FgytTNs4jBOYDH6rWEzGo8y7Q");*/

include_once 'fcm.php';    

$notification = array();
$arrnotification= array();			
$arrdata = array();											
$arrnotification["body"] =$_GET["body"];
$arrnotification["title"] = $_GET["title"];
$arrnotification["sound"] = "default";
$arrnotification["type"] = 1;

$resData = $DataBaseWork->UpdateCurrency($_GET["CurrParamID"]);

$fcm = new fcm();
foreach ($regid as $val){ 
		$result = $fcm->send_notification($val, $arrnotification,"Android");
}


?>