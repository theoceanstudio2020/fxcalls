<?php
class DataBaseWork {
	
	public $dbHost					= "fx-keeper.c9qufpaswclk.us-east-1.rds.amazonaws.com"; //fx-keeper.c9qufpaswclk.us-east-1.rds.amazonaws.com
	public $dbUsername				= "admin"; //admin
    public $dbPassword				= "prod$fxKeep1305"; //prod$fxKeep1305
    public $dbName					= "fxcall";
	
	function openConnection(){
	/*$whitelist = array('localhost');
	if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {	
		$this->dbHost			= "fx-keeper.c9qufpaswclk.us-east-1.rds.amazonaws.com";
		$this->dbUsername		= "admin";
		$this->dbPassword		= "prod$fxKeep1305";
		$this->dbName		= "fxcall";
	}*/
	$this->mysqli = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);		
	}

	function closeConnection(){
		$this->mysqli->close();
	}

// RUNNING ASSETS
	function RunningList(){
		$this->openConnection();
		$res = $this->mysqli->query("call SP_runningCalls('Running')");
		$this->closeConnection();
		return $res;
	}
}

$DataBaseWork = new DataBaseWork();
$arr = array();		
$status = 0;		
$message = "Please send proper parameter";
$runningData = $DataBaseWork->RunningList();

if($runningData->num_rows > 0){
	while($row = $runningData->fetch_assoc()) {
		array_push($arr,$row);
	}
	$status = 1;
	$message = $runningData->num_rows." running calls selected.";
}
else{
	$message = "No Record Found.";
}

echo '{"status":' . $status . ',"message": "' . $message . '"' . ',"data":' . json_encode($arr) . '}';
?>