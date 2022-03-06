<?php 
error_reporting(E_ALL);
//setting timezone
ini_set("data.timezone","asia/jakarta");
date_default_timezone_set("asia/jakarta");

$title = "Pemilu FMS 2022";

$host = "localhost";
$user = "root";
$pass = "";
$db   = "pemilihan_fms_db";

try{
	$konek = new mysqli($host,$user,$pass,$db);
}catch(Exception $e){
	die($e->getMessage());
}

?>