<?php  
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();  
include("../config.ini.php");

if($_SESSION['login']==NULL){	 
		echo "<script>document.location='../error.php?status=Ambiente restrito!'</script>";
}else{
	 
	$adm_usuario=$_SESSION['login'];
	$idu=$_SESSION['idu'];
	$nivel=$_SESSION['nv'];
	$tp=$_SESSION['tp'];
	//echo "Logado como: ".$adm_usuario;
}
?>