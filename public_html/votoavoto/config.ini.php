<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
$nomehost = 'db'; // Alterado para o nome do serviço do MySQL no docker-compose.yml
$usuario = 'umeuvoto';
$senha = 'cref2003';
$basedados = 'meuvoto';

$conexao = mysqli_connect($nomehost, $usuario, $senha, $basedados);

if ($conexao) { 
    mysqli_set_charset($conexao, 'utf8'); // Configurando o charset
    date_default_timezone_set('America/Sao_Paulo');
    //echo "Conexão bem-sucedida!"; // Para teste
} else {
    #echo "<br>Erro, contate o desenvolvedor!" . mysqli_connect_error(); // Mostra o erro de conexão
	echo "<br>Erro, contate o desenvolvedor!";
}
?>
