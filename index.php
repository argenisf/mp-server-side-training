<?php
include('server-config/config.php');
//check configuration
if(!isConfigValid()){
	header("Location: invalid-configuration.php");
	die();
}
//check for session
if(!isset($_SESSION['user_id'])){
	header("Location: authenticate.php");
	die();
}

$templatefile = 'html-templates/index.html';
$page = file_get_contents($templatefile);
$page = str_replace("{{user_obj}}",$_SESSION['user_obj'],$page);
$page = str_replace("{{mp_token}}",$mp_token,$page);
echo $page;