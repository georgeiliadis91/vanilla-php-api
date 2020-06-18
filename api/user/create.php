<?php
	 // Headers
	 header('Access-Control-Allow-Origin: *');
	 header('Content-Type: application/json');
	 header('Access-Control-Allow-Methods: *');
	 header('Access-Control-Allow-Headers: *');
	 header("HTTP/1.1 200 OK");

	include_once '../../config/Database.php';
	include_once '../../model/User.php';

	$database = new Database();
	$db=$database->connect();

	$user = new User($db);



	// Get raw posted data
	$data = json_decode(file_get_contents("php://input"));


	 $user->first_name=$data->first_name;
	 $user->last_name=$data->last_name;
	 $user->email=$data->email;
	 $user->password=$data->password;
	 $user->user_type=$data->user_type;


	 if($user->create()) {
    echo json_encode(
      array('message' => 'User Created')
    );
  } else {
    echo json_encode(
      array('message' => 'User Not Created')
    );
  }

?>