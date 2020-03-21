<?php
include('server-config/config.php');
//check configuration
if(!isConfigValid()){
	header("Location: invalid-configuration.php");
	die();
}

if(isset($_REQUEST['logout']) && $_REQUEST['logout'] == "true"){
	session_destroy();
	session_start();
}

if(isset($_SESSION['user_id'])){
	//redirect if a session is active
	header("Location: index.php");
	die();
}

// no section active, let's ask the user to authenticate
$templatefile = 'html-templates/auth.html';
$page = file_get_contents($templatefile);
echo $page;