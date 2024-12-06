<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
$_SESSION=array();
unset($_SESSION);
session_destroy();

$URL_ATUAL= "http://".$_SERVER['HTTP_HOST']."/votoavoto/error.php";
print('<div class="w3-container"> <p>Encerrando a sessão...</p></div>
<meta http-equiv="refresh" content="2;url='.$URL_ATUAL.'">');
?>
