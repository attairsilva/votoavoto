<?php  
include("../config.ini.php");
session_start(); 
if($_SESSION['login']==NULL){
		header("location:error.php?status=Você não está logado!");	
}else{
	 
	$adm_usuario=$_SESSION['login'];
	$idu=$_SESSION['idu'];
	$nivel=$_SESSION['nv'];
	$tp=$_SESSION['tp'];
	//echo "Logado como: ".$adm_usuario;
	error_reporting(E_ERROR  | E_PARSE);
}
?>