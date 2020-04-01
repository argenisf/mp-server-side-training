<?php
header('Content-Type: application/json');
$data   = array("status"=>false, "error"=>"");

// ----- check for required parameters -----

if(!(isset($_REQUEST['email']))){
	$data["error"] = "Parameter 'email' required";
	echo json_encode($data);
	die();
}

include('../server-config/config.php');
$email =  mysqli_real_escape_string($mysqli,$_REQUEST['email']);

if(strpos($email,"@mixpanel.com") === false){
	$data["error"] = "Auth requires a mixpanel.com address";
	echo json_encode($data);
	die();
}

if(!isConfigValid()){
	$data["error"] = "Invalid configuration";
	echo json_encode($data);
	die();
}

if(!(isset($_REQUEST['mp_distinct_id']))){
	$data["error"] = "Parameter 'mp_distinct_id' required";
	echo json_encode($data);
	die();
}
$mp_distinct_id = mysqli_real_escape_string($mysqli,$_REQUEST['mp_distinct_id']);

if($email == "demo@mixpanel.com"){
	$_SESSION['user_id'] = 1;
	$_SESSION['email'] = "demo@mixpanel.com";
	$_SESSION['user_obj'] = json_encode(["id"=> 1, "email"=>"demo@mixpanel.com"]);
	
	$data['status'] = true;
	$data['message'] = 'Authenticated with demo account';

	$user = array(
		"id" => 1,
		"email" => "demo@mixpanel.com"
	);
	$data["user"] = $user;

	echo json_encode($data);
	die();
}

//check if the user already exists
$query = "SELECT * FROM users WHERE email = \"$email\" LIMIT 1";
$result = $mysqli->query($query);
if($result && $result-> num_rows == 1){
	//user exists, let's log the user in
	$user = $result->fetch_object();
	
	$_SESSION['user_id'] = $user->id;
	$_SESSION['email'] = $user->email;
	$_SESSION['user_obj'] = json_encode(["id"=> $user->id, "email"=>$user->email]);

	//update last login
	$datetime = new DateTime();
	$date_str = substr(date("c"),0,19);
	$user_id = $user->id;
	$update_query =  "UPDATE users SET tasks.completed_date = \"$date_str\" WHERE users.id  = $user_id";
	$mysqli->query($update_query);
	
	$data['status'] = true;
	$data['message'] = 'Authenticated as existing  account';

	$user = array(
		"id" => $user->id,
		"email" => $user->email,
		"mp_distinct_id" => $user->email
	);
	$data["user"] = $user;


	echo json_encode($data);
	die();
}else{
	$query = "INSERT INTO users (email) VALUES (\"$email\");";
	if($mysqli->query($query)){
		//insert_id
		$user_id = $mysqli->insert_id;
		$data['status'] = true;
		$_SESSION['user_id'] = $user_id;
		$_SESSION['email'] = $email;
		$_SESSION['user_obj'] = json_encode(["id"=> $user_id, "email"=>$email]);
		$data['message'] = 'New account created';

		$user = array(
			"id"=> $user_id, 
			"email"=>$email,
			"mp_distinct_id"=>$mp_distinct_id
		);
		$data["user"] = $user;

		$mp->identify($mp_distinct_id); // this only sets ID
		$mp->track("Signup");
		$mp->createAlias($mp_distinct_id, $email);
		$mp->flush();

		echo json_encode($data);
		die();
	}else{
		$data["error"] = "Unable to create user, try again";
		echo json_encode($data);
		die();
	}
}