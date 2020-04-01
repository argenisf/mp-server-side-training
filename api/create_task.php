<?php
header('Content-Type: application/json');
$data   = array("status"=>false, "error"=>"");

// ----- check for required parameters -----

if(!(isset($_REQUEST['user_id']) && is_numeric($_REQUEST['user_id']))){
	$data["error"] = "Invalid user_id parameter";
	echo json_encode($data);
	die();
}

if(!(isset($_REQUEST['text']) && $_REQUEST['text'] != "")){
	$data["error"] = "Invalid text parameter";
	echo json_encode($data);
	die();
}

include('../server-config/config.php');
if(!isConfigValid()){
	$data["error"] = "Invalid configuration";
	echo json_encode($data);
	die();
}
// ----- check for required parameters -----

if(!(isset($_REQUEST['mp_distinct_id']))){
	$data["error"] = "Invalid mp_distinct_id parameter";
	echo json_encode($data);
	die();
}
$mp_distinct_id =  mysqli_real_escape_string($mysqli,$_REQUEST['mp_distinct_id']);
$mp->identify($mp_distinct_id);

$user_id =  mysqli_real_escape_string($mysqli,$_REQUEST['user_id']);
$text =  mysqli_real_escape_string($mysqli,$_REQUEST['text']);
$completed = 0;

//check if it's a valid user and if it is the demo
$query = "SELECT * FROM users WHERE id = $user_id LIMIT 1";
$result = $mysqli->query($query);
if(!$result || $result-> num_rows == 0){
	//invalid user
	$data["error"] = "Invalid user provided";
	echo json_encode($data);
	die();
}

//check if it is demo user
$user = $result->fetch_object();
if($user->email == "demo@mixpanel.com"){
	//demo user, let's fake creating a task
	$date = new DateTime();
	$task_id = $date->getTimestamp();

	$data['status'] = true;
	$data['message'] = 'Task Creared. Not permanent for demo account';
	$data['task'] = array(
		'id' => $task_id,
		'text' => $text,
		'completed'=> false
	);

	
	$mp->track("Task Created",array("demo"=>true));

	echo json_encode($data);
	die();
}

$query = "INSERT INTO tasks (id_user,text,completed) VALUES ($user_id,\"$text\",0);";
if($mysqli->query($query)){
	//insert_id
	$task_id = $mysqli->insert_id;
	$data['status'] = true;
	$data['task'] = array(
		'id' => $task_id,
		'text' => $text,
		'completed'=> false
	);

	$mp->track("Task Created",array("demo"=>false));

	echo json_encode($data);
	die();
}else{
	$data["error"] = "Unable to create task";
	echo json_encode($data);
	die();
}
