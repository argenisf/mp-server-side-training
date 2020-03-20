<?php
header('Content-Type: application/json');
$data   = array("status"=>false, "error"=>"");

// ----- check for required parameters -----

if(!(isset($_REQUEST['user_id']) && is_numeric($_REQUEST['user_id']))){
	$data["error"] = "Invalid user_id parameter";
	echo json_encode($data);
	die();
}

if(!(isset($_REQUEST['task_id']) && is_numeric($_REQUEST['task_id']))){
	$data["error"] = "Invalid task_id parameter";
	echo json_encode($data);
	die();
}

if(!(isset($_REQUEST['completed']) && ($_REQUEST['completed'] == "true" || $_REQUEST['completed'] == "false"))){
	$data["error"] = "Invalid completed parameter";
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

$user_id =  mysqli_real_escape_string($mysqli,$_REQUEST['user_id']);
$task_id =  mysqli_real_escape_string($mysqli,$_REQUEST['task_id']);
$text =  mysqli_real_escape_string($mysqli,$_REQUEST['text']) || "";
$completed = ($_REQUEST['completed'] == "true")?1:0;


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
	//demo user, let's fake updating the db

	$data['message'] = 'Update successful. Not permanent  for demo';
	$data['status'] = true;
	$data['task'] =  array(
		'id' => intval($task_id),
		'text' => $text,
		'completed' => (($completed ==  1)?true:false),
	);
	echo json_encode($data);
	die();
}



$query = "SELECT tasks.*, users.email FROM tasks INNER JOIN users ON users.id = tasks.id_user WHERE tasks.id = $task_id AND tasks.id_user = $user_id LIMIT 1";
$result = $mysqli->query($query);

if($result && $result-> num_rows == 1){
	$row = $result->fetch_object();
	
	if($row->completed == $completed){
		//no need to do an update
		$data["error"] = "Invalid task update";
		echo json_encode($data);
		die();
	}

	if($completed == true){
		$datetime = new DateTime();
		$date_str = substr(date("c"),0,19);
		$update_query =  "UPDATE tasks SET tasks.completed = 1, tasks.completed_date = \"$date_str\" WHERE tasks.id  = $task_id";
	}else{
		$update_query =  "UPDATE tasks SET tasks.completed = 0, tasks.completed_date = NULL WHERE tasks.id  = $task_id";
	}

	$mysqli->query($update_query);
	if($mysqli->affected_rows ==  0){
		$data["error"] = "Unable to update the task. Please try again";
		echo json_encode($data);
		die();
	}

	$data['status'] = true;
	$data['task'] =  array(
		'id' => intval($task_id),
		'text' => $row->text,
		'completed' => (($completed ==  1)?true:false),
	);

    echo json_encode($data);
}else{
	$data["error"] = "Invalid task update";
	echo json_encode($data);
	die();
}