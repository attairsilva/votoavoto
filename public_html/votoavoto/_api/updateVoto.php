<?php
include("config.php");

$input = file_get_contents('php://input');
$datab = json_decode($input,true);
$nomeusr = $datab['nomeusr'];
$idvotante = $datab['idvotante'];
$message = array();

$sqv = mysqli_fetch_array(mysqli_query($con, "SELECT id_inscricao, votou, crefito FROM `profissionais` 
WHERE  crefito='{$idvotante}' LIMIT 1"));

if($sqv['id_inscricao']!=NULL) {

	$sq = mysqli_fetch_array(mysqli_query($con, "SELECT id_inscricao, votou, crefito FROM `profissionais` 
	WHERE votou='sim' AND crefito='{$idvotante}' LIMIT 1"));
	if($sq['id_inscricao']!=NULL) {
		$cod=422;
		$msg="Este voto ja foi computado anteriormente";
		$cor="danger";
	}else{

		$usq = mysqli_fetch_array(mysqli_query($con, "SELECT id,usuario FROM `admin` WHERE usuario='$nomeusr' LIMIT 1"));
		$idUser=$usq['id'];
		$hdtw=date('Y-m-d H:i:s');
		if($idUser>0 && $idvotante>0){
			$q = mysqli_query($con, "UPDATE `profissionais` SET votou='sim', id_usuario='$idUser', forma='correspondencia', data_horario='$hdtw' 
			WHERE crefito='$idvotante' LIMIT 1");
			if($q) {
				$cod=201;
				$msg= "Voto computado";
				$cor="light";
			}else{
				$cod=422;
				$msg="Erro ao contar o votante.";
				$cor="danger";
			}
		}else{
				$cod=422;
				$msg="Erro ao registrar a operacao.";
				$cor="danger";
		}

	}
}else{
	$cod=422;
	$msg="Registro não foi encontrado";
	$cor="danger";
}

$data['msg'] = $msg;
//http_response_code($cod);
echo json_encode($data);
echo mysqli_error($con);

