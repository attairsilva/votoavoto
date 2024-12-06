<?php 
include("sec.php");

$cod=$_GET['id'];

$querys = mysqli_query($conexao,"SELECT id, arquivo_sql FROM backups WHERE id='$cod'");
if (!$querys) { echo "<br>Arquivo não deleteda da pasta!<br><br>"; }
$dados = mysqli_fetch_array($querys); 
$cambck="db_bkp/".$dados['arquivo_sql'];

$op = fopen($cambck, "r");
while(!feof($op)) {
	
	$conteudo = fgets($op, 1024);
	if(preg_replace( "/\r|\n/", "", $conteudo)!=NULL) { ;
		$n=$n+1;
		$search = ';';
		if(preg_match("/{$search}/i",$conteudo)) {
			
			$search2 = 'DROP TABLE IF EXISTS';
			if(preg_match("/{$search2}/i",$conteudo)) {
				$sqlc = $sqlc.$conteudo;
				echo "Nessa linha [$n] já tem [$search2] então executa a Query acumulada [$n] e limpa: " . $sqlc."<br>";
				$result = mysqli_query($conexao,$sqlc);
				$sqlc="";
			}else{
				$cnt=$cnt+1;
				$sqlc=$sqlc.$conteudo; 
				echo "Acumula Linha [".$n."]: ".$sqlc."<br><br>";
				$cnt=$cnt+1;
				if($cnt<=100){
					echo "Acumulou 5 sem DROPA, executa a Query [$n] e limpa: " . $sqlc."<br>";
					$result = mysqli_query($conexao,$sqlc);
					if(!$result) { 
						print("Erro executando a Query [$n]  ---> ".mysqli_error($conexao)."<br><br>"); 
						die;
					}else{
						echo "Query [$n1] Executada com sucesso.<br><br>";
						$sqlc="";
						//sleep(1);
					}
					$cnt=0;
				}
			}			
		}
		else
		{
			$sqlc=$sqlc." ".$conteudo." ";
			echo "Linha ".$n.": ".$sqlc."<br>";
		}
	}
		
}
 

fclose ($op);

?>
