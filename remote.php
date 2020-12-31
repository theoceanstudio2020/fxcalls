<?php
//Connect To Database
$hostname='fx-keeper.c9qufpaswclk.us-east-1.rds.amazonaws.com';
$dbport = 3306;
$username='admin';
$password='prod$fxKeep1305';
$dbname='fxcall';
$charset = 'utf8' ;

$conn = new mysqli($hostname, $username, $password, $dbname, $dbport);

if ($conn->connect_error) {
    die('Connect failed: '. $conn->connect_error);
}

?>