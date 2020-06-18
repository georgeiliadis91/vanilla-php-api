<?php
	//Headers

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	
	include_once '../../config/Database.php';
	include_once '../../model/User.php';

	$database = new Database();
	$db=$database->connect();

	$user = new User($db);

	$user->id=isset($_GET['id']) ? $_GET['id'] : die();


	// Query 
	$user->read_single();

	$user_array =array(
		'id' => $user->id,
		'first_name'=>$user->first_name,
		'last_name'=>$user->last_name,
		'email'=>$user->email,
		'user_type'=>$user->user_type,
	);

	//Make array

	print_r(json_encode($user_array));






?>