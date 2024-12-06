<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: token, Content-Type');
header('Access-Control-Max-Age: 1728000');
header('Content-Length: 0');
header('Content-Type: text/plain');
date_default_timezone_set('America/Sao_Paulo');
$nome_host='localhost';
$usuario='user_votosite';
$senha='Cff%2003';
$base_dados='votoavoto';
$con=mysqli_connect($nome_host,$usuario,$senha,$base_dados) or die('Não foi possível conectar ao banco');
error_reporting(E_ERROR | E_WARNING | E_PARSE); 


