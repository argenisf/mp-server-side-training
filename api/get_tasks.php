<?php
header('Content-Type: application/json');
$data   = array("status"=>false, "tasks"=>[], "error"=>"");

// ----- check for required parameters -----

if(!(isset($_REQUEST['user_id']) && is_numeric($_REQUEST['user_id']))){
	$data["error"] = "Invalid user_id parameter";
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

//SELECT * FROM tasks WHERE tasks.completed = 0 OR tasks.completed_date > DATE_SUB(NOW(), INTERVAL 1 day)
$query = "SELECT * FROM tasks WHERE id_user = '$user_id' and (tasks.completed = 0 OR tasks.completed_date IS NULL OR tasks.completed_date > DATE_SUB(NOW(), INTERVAL 1 day)) ORDER BY created_date ASC";
$result = $mysqli->query($query);

$rows = array();
if($result){
	$data['status'] = true;
	while($obj = $result->fetch_object()){
        $rows[] = array(
			"id"  => $obj->id,
			"text"  => $obj->text,
			"completed"  => (($obj->completed)?true:false),
        );
    }
    $data['tasks'] = $rows;
    echo json_encode($data);
}else{
	$data["error"] = "Unknown error";
	echo json_encode($data);
	die();
}