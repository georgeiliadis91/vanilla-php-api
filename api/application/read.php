<?php
	//Headers

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	
	include_once '../../config/Database.php';
	include_once '../../model/Application.php';

	$database = new Database();
	$db=$database->connect();

	$application = new Application($db);

	// Query 
	$result=$application->read();

	//Get Rows
	$num=$result->rowCount();



	//Check if Applications
	if($num > 0) {
		// Cat array
		$application_array = array();
		$application_array['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			$application_item = array(
				'id' => $id,
				'submit_date'=>$submit_date,
				'date_start'=>$date_start,
				'date_end'=>$date_end,
				'reason'=>$reason,
				'status'=>$status,
				'user_id'=>$user_id,
			);

			// Push to "data"
			array_push($application_array['data'], $application_item);
		}

		// Turn to JSON & output
		echo json_encode($application_array);
	
	}else{
		echo json_encode(array('message'=>'no applications found'));
	}








?>