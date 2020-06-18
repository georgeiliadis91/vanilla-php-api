<?php
	 // Headers
	 header('Access-Control-Allow-Origin: *');
	 header('Content-Type: application/json');
	 header('Access-Control-Allow-Methods: DELETE');
	 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
 

	include_once '../../config/Database.php';
	include_once '../../model/Application.php';

	$database = new Database();
	$db=$database->connect();

	$application = new Application($db);

	// Get raw posted data
	$data = json_decode(file_get_contents("php://input"));


	$application->id=$data->id;



	if($application->delete()) {
		echo json_encode(
			array('message' => 'Application Deleted')
		);
  } else {
    echo json_encode(
      array('message' => 'Application Not Deleted')
    );
  }

?>