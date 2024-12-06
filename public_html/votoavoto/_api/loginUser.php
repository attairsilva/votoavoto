<?php
include("config.php");

$input = file_get_contents('php://input');
$data = json_decode($input,true);
$nomeusr = $data['nomeusr'];
//$nomeusr='mesa';
//$senhausr='mesa';
$senhausr = $data['senhausr'];
$message = array();

$result = mysqli_query($con, "SELECT id, usuario, chave FROM `admin` WHERE usuario='$nomeusr' AND chave='$senhausr' LIMIT 1");
$row = mysqli_fetch_row($result);
if($row[0]>0){ 
        http_response_code(201);
    	$message['status'] = "Success ".$nomeusr;
}else{
    	http_response_code(422);
        $message['status'] = "Error ".$nomeusr;
}


echo json_encode($message);
echo mysqli_error($con);

