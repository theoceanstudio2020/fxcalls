<?php
//require_once 'https://productionfxkeeper.s3.amazonaws.com/production_api/DatabaseWork.php';
require_once 'DatabaseWork.php';
$DataBaseWork = new DataBaseWork();

$Data = array();
$resData = $DataBaseWork->InsertDeviceToken($_GET["deviceID"]);

if($resData)  
{
	echo json_encode($resData);
}
else{
	echo '{"Comments":'.json_encode($arr).',"Error":'.json_encode($msg_arr).'}';
}

?>