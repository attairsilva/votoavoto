<?php
include("config.php");

$input = file_get_contents('php://input');
$datab = json_decode($input,true);
$id = $datab['idvotante'];


$rq = mysqli_fetch_row(mysqli_query($con,"SELECT id_inscricao,crefito FROM  `profissionais` WHERE crefito='$id' LIMIT 1"));
if($rq[0]>0){ 
    $q=mysqli_query($con,"SELECT id_inscricao,nome,crefito FROM  `profissionais` WHERE crefito='$id' LIMIT 1");
    while($row = mysqli_fetch_object($q)){
         $data[]=$row; 
    }
	$cod=201;
}else{
    $cod=422;
}
http_response_code($cod);
echo json_encode($data);
echo mysqli_error($con);

?>

