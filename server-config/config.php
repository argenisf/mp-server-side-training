<?php
//Configuration variables
$mpToken = "sample-token";
$rootURL = "http://localhost:8888/mp-server-side-training/";

$user = 'root';
$password = 'root';
$db = 'MPTasks';
$host = 'localhost';
$port = 8889;

session_start();
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