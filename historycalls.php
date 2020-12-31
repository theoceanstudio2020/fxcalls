<?php
class DataBaseWork {
	
	public $dbHost					= "fx-keeper.c9qufpaswclk.us-east-1.rds.amazonaws.com"; //fx-keeper.c9qufpaswclk.us-east-1.rds.amazonaws.com
	public $dbUsername				= "admin"; //admin
    public $dbPassword				= "prod$fxKeep1305"; //prod$fxKeep1305
    public $dbName					= "fxcall";
	
	function openConnection(){
		$this->mysqli = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);		
	}

	function closeConnection(){
		$this->mysqli->close();
	}

// HISTORY ASSETS
	function HistoryList(){
		$this->openConnection();
		$res = $this->mysqli->query("call SP_runningCalls('HISTORY')");
		$this->closeConnection();
		return $res;
	}
}
$DataBaseWork = new DataBaseWork();

$arr = array();	
$arr = array();		
$status = 0;		
$message = "Please send proper parameter";			
$historyData = $DataBaseWork->HistoryList();

if($historyData->num_rows > 0){
	while($row = $historyData->fetch_assoc()) {
		array_push($arr,$row);
	}
	$status = 1;
	$message = $historyData->num_rows." closed calls selected.";
}
else{
	$message = "No Record Found.";
}

echo '{"status":' . $status . ',"message": "' . $message . '"' . ',"data":' . json_encode($arr) . '}';
?>