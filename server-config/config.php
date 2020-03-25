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