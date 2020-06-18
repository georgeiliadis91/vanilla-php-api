<?php
	//Headers

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	
	include_once '../../config/Database.php';
	include_once '../../model/User.php';

	$database = new Database();
	$db=$database->connect();

	$user = new User($db);

	// Query 
	$result=$user->read();

	//Get Rows
	$num=$result->rowCount();



	//Check if Users
	if($num > 0) {
	
		$user_array = array();
		$user_array['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			$user_item = array(
				'id' => $id,
				'first_name'=>$first_name,
				'last_name'=>$last_name,
				'email'=>$email,
				'user_type'=>$user_type,
			);

			// Push to "data"
			array_push($user_array['data'], $user_item);
		}

		// Turn to JSON & output
		echo json_encode($user_array);
	
	}else{
		echo json_encode(array('message'=>'no users found'));
	}








?>