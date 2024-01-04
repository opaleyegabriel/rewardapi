<?php
	//Headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../config/database.php';
	include_once '../model/reward.php';

	//Instantiate DB & Connect
	$database = new Database();
	$db= $database->connect();

	//instantiate Cooperative list object
    $reward= new Reward($db);

    //Cooperative list query
    $result=$reward->read();

    //Get Row Count
    $num = $result->rowCount();

    //Check if there any cooperatives
    if($num > 0){
        //record array
        $reward_arr=array();
        while($row=$result->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $reward_item=array(
                'id'=>$id,
                'mobile' =>$mobile,
                'client_mobile' =>$client_mobile,
                'client_paid' =>$client_paid,
                'r7pcent' =>$r7pcent,
                'cashout' =>$cashout          
                );
            //push to the array
        array_push($reward_arr, $reward_item);
        }
        //Turn it to JSON and OUTPUT
        echo json_encode($reward_arr);

    }else{
        // No Cooperatives
        echo json_encode(
            array('message' =>'No reward Record found')
            );
    }
