<?php
//Configuration variables
$rootURL = "http://localhost:8888/mp-server-side-training/";

$mp_token = "5796d9a5a728ba2493188cef50389c61";
$mp_lib = 'lib/Mixpanel.php';
if(strpos($_SERVER["REQUEST_URI"], "api/")!== false){
	$mp_lib = '../' . $mp_lib;
}
require $mp_lib;
$mp = Mixpanel::getInstance($mp_token);

$user = 'root';
$password = 'root';
$db = 'MPTasks';
$host = 'localhost';
$port = 8889;

session_start();
$mysqli = new mysqli($host, $user, $password, $db);

function isConfigValid(){
	global $rootURL,$mysqli;
	
	if($rootURL == ""){
		return false;
	}
	if($mysqli->connect_errno){
		return false;	
	}
	
	return true;
}