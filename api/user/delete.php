<?php
	 // Headers
	 header('Access-Control-Allow-Origin: *');
	 header('Content-Type: application/json');
	 header('Access-Control-Allow-Methods: *');
	 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
 

	include_once '../../config/Database.php';
	include_once '../../model/User.php';

	$database = new Database();
	$db=$database->connect();

	$user = new User($db);

	// Get raw posted data
	$data = json_decode(file_get_contents("php://input"));


	$user->id=$data->id;



	if($user->delete()) {
		echo json_encode(
			array('message' => 'User Deleted')
		);
  } else {
    echo json_encode(
      array('message' => 'User Not Deleted')
    );
  }

?>