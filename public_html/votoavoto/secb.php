<?PHP 
echo "Antes: ".$_SESSION['login'];
session_start();
if($_SESSION['login']==NULL){
		//header("location:error.php?status=Voc� n�o est� logado!");
		 $URL_ATUAL= "http://$_SERVER[HTTP_HOST]";
		//print('<meta http-equiv="refresh" content="0;url='.$URL_ATUAL.'/error.php?status=Voc� n�o est� logad">');
			echo " ==> depois: ".$_SESSION['login'];
}else{
	$adm_usuario=$_SESSION['idu'];
	$nivel=$_SESSION['nv'];
	$tp=$_SESSION['tp'];
}
?>