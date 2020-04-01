<?php
//Configuration variables
$rootURL = "http://localhost:8888/mp-server-side-training/";

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

$mp_lib = 'lib/Mixpanel.php';
if(strpos($_SERVER["REQUEST_URI"], "api/")!== false){
	$mp_lib = '../' . $mp_lib;
}
require $mp_lib;
$mp_token = "f8bd7cddaf94642530004c3d0509691f";
$mp = Mixpanel::getInstance($mp_token);