<?php
include('server-config/config.php');
//check configuration
if(!isConfigValid()){
	header("Location: invalid-configuration.php");
	die();
}

$was_demo = "false";
if(isset($_SESSION['email']) && $_SESSION['email'] == "demo@mixpanel.com"){
	$was_demo = "true";
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
$page = str_replace("{{mp_token}}",$mp_token,$page);
$page = str_replace("{{was_demo}}",$was_demo,$page);
echo $page;