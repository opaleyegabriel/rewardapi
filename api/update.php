<?php
	//Headers
    header('Access-Control-Allow-Origin:*' );
    header('Content-Type:application/json');
    header('Access-Control-Allow-Methods:PUT' );
    header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With' );



	include_once '../config/database.php';
	include_once '../model/reward.php';

	//Instantiate DB & Connect
	$database = new Database();
	$db= $database->connect();

	//instantiate post
    $post= new Reward($db);
    //get raw posted data
    $data =json_decode(file_get_contents("php://input"));
    $post->id= $data->id;
    

    // create post
    if($post->update()){
        echo json_encode(
            array('message' => 'Post Updated')
        );
    }else{
        echo json_encode(
            array('message' => 'Post not Updated')
        );
    }
