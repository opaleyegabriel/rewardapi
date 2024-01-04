<?php
header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

	include_once '../config/database.php';
	include_once '../model/reward.php';

	//Instantiate DB & Connect
	$database = new Database();
	$db= $database->connect();

	//instantiate Cooperative list object
	$post= new Reward($db);

	//get Raw Posted Data
	$data=json_decode(file_get_contents("php://input"));

	$post->mobile= $data->mobile;
	$post->client_mobile= $data->client_mobile;
	$post->client_paid= $data->client_paid;
	$post->r7pcent= $data->r7pcent;
	$post->cashout= $data->cashout;

	//Create the record
	if($post->create()){
		echo json_encode(
			array('message' => 'Record Saved Succesfully','savestatus'=>'YES')

			);
	}else{
		echo json_encode(
			array('message' => 'Record Not Created')

			);
	}
