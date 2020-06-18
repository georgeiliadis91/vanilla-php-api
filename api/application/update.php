<?php
	 // Headers
	 header('Access-Control-Allow-Origin: *');
	 header('Content-Type: application/json');
	 header('Access-Control-Allow-Methods: *');
	 header('Access-Control-Allow-Headers: *');
	 header("HTTP/1.1 200 OK");
 

	include_once '../../config/Database.php';
	include_once '../../model/Application.php';

	$database = new Database();
	$db=$database->connect();

	$application = new Application($db);

	// Get raw posted data
	$data = json_decode(file_get_contents("php://input"));


	$application->id=$data->id;
	$application->date_start=$data->date_start;
	$application->date_end=$data->date_end;
	$application->reason=$data->reason;
	$application->status=$data->status;
	$application->user_id=$data->user_id;


	if($application->update()) {
		echo json_encode(
			array('message' => 'Application Updated')
		);
  } else {
    echo json_encode(
      array('message' => 'Application Not Updated')
    );
  }

?>