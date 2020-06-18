<?php
	//Headers

	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
	header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
	header('Content-Type: application/json');
	$method = $_SERVER['REQUEST_METHOD'];
	if ($method == "OPTIONS") {
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
	header("HTTP/1.1 200 OK");
	include_once '../../config/Database.php';
	include_once '../../model/Application.php';

	$database = new Database();
	$db=$database->connect();

	$application = new Application($db);

	$application->id=isset($_GET['id']) ? $_GET['id'] : die();


	// Query 
	$application->read_single();

	$application_array =array(
		'id' => $application->id,
		'submit_date'=>$application->submit_date,
		'date_start'=>$application->date_start,
		'date_end'=>$application->date_end,
		'reason'=>$application->reason,
		'status'=>$application->status,
		'user_id'=>$application->user_id,
	);

	//Make array

	print_r(json_encode($application_array));


?>