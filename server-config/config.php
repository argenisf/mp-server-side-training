<?php
//Configuration variables
$mpToken = "";
$rootURL = "http://localhost:8888/mp-server-side-training/";

$user = 'root';
$password = 'root';
$db = 'MPTasks';
$host = 'localhost';
$port = 8889;

session_start();
$_SESSION['user_id'] = 1;
$_SESSION['user_obj'] = json_encode(["id"=> 1, "email"=>"demo@mixpanel.com"]);
$mysqli = new mysqli($host, $user, $password, $db);

function isConfigValid(){
	global $mpToken,$rootURL,$mysqli;
	if($mpToken == "" || $mpToken == "token"){
		return false;
	}
	if($rootURL == ""){
		return false;
	}
	if($mysqli->connect_errno){
		return false;	
	}
	
	return true;
}