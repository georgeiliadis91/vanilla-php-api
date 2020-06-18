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

	$user_array = array();
	$user_array['data'] = array();

	$user->email=$data->email;
	$user->password=$data->password;

		// Query 
		$result=$user->login();

		//Get Rows
		$num=$result->rowCount();
		//Check if user exists

		// If result -> mail & password comination exists. 
		//Return user Object so we can see if admin or not.
		if($num > 0) {
			$user_array = array();
			$user_array['data'] = array();

			$row = $result->fetch(PDO::FETCH_ASSOC);
			extract($row);

			$user_item = array(
				'id' => $id,
				'first_name'=>$first_name,
				'last_name'=>$last_name,
				'email'=>$email,
				'user_type'=>$user_type,
			);

			array_push($user_array['data'], $user_item);
			echo json_encode($user_array);
			// echo json_encode(array('Result'=>'Success'));
		}else{
			echo json_encode(array('Result'=>'Failure'));
		}

?>