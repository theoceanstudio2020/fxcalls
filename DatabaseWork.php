<?php
date_default_timezone_set("Asia/Kolkata"); 

class DataBaseWork {
	
	public $dbHost					= "fx-keeper.c9qufpaswclk.us-east-1.rds.amazonaws.com"; //fx-keeper.c9qufpaswclk.us-east-1.rds.amazonaws.com
	public $dbUsername				= "admin"; //admin
    public $dbPassword				= "prod$fxKeep1305"; //prod$fxKeep1305
    public $dbName					= "fxcall";
	
	public $tbl_currency			= "currency";
	public $tbl_currencyparams		= "currencyparams";
		
	public $currency_currencyID 	= "CurrencyID";
	public $currency_CurrencyName  	= "CurrencyName";
	
	public $currencyparams_currencyparamsID = "CurrencyParamsID";
	public $currencyparams_CurrencyID		= "CurrencyID";
	public $currencyparams_CurrencyName 	= "CurrencyName";
	public $currencyparams_EntryPrice 		= "EntryPrice";
	public $currencyparams_TargetPrice 		= "TargetPrice";
	public $currencyparams_Type 			= "Type";
	public $currencyparams_StopLoss 		= "StopLoss";
	public $currencyparams_Status 			= "Status";
	public $currencyparams_Profit 			= "Profit";
	public $currencyparams_CreatedDate 		= "CreatedDate";
	public $currencyparams_ModifiedDate 	= "ModifiedDate";
	
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

// CLOSED ASSETS
	function ClosedList(){
		$this->openConnection();
		$res = $this->mysqli->query("call SP_runningCalls('CLOSED')");
		$this->closeConnection();
		return $res;
	}

// HISTORY ASSETS
	function HistoryList(){
		$this->openConnection();
		$res = $this->mysqli->query("call SP_runningCalls('HISTORY')");
		$this->closeConnection();
		return $res;
	}

// GET DEVICE TOKEN
	function InsertDeviceToken($deviceID){
		$this->openConnection();
		$res = $this->mysqli->query("call SP_devicetoken('".$deviceID."','INSERT')");
		$this->closeConnection();
		return $res;
	}
	
// INSERT DEVICE TOKEN
	function DeviceTokenList(){
		$this->openConnection();
		$res = $this->mysqli->query("call SP_devicetoken('','SELECT')");
		$this->closeConnection();
		return $res;
	}
	
// UPDATE CURRENCY 
	function UpdateCurrency($currencyID){
		$this->openConnection();
		$res = $this->mysqli->query("call SP_CurrencyParams('".$currencyID."')");
		$this->closeConnection();
		return $res;
	}
}
?>