<?php 
include("config.ini.php");
include("sec.php");
?>
<!DOCTYPE html>
<html>
<head>
	 
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Votações  -  V.01.beta</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="W3pro.css">    
<script>
function limpa() {
if(document.getElementById('busca').value!="") {
document.getElementById('busca').value="";
document.getElementById('busca').focus();
}
}
</script>
</head>
<body>
<!-- Container -->
<div class="w3-container">
  
	<div class="W3-card">
		<p><H2>RELATÓRIO COMPARATIVO</H2><p>
				
	</div>
	
	<? 
	$asql= "SELECT * FROM profissionais, profissionais_enderecos 
	WHERE profissionais.crefito=profissionais_enderecos.crefito ORDER BY profissionais_enderecos.estado";
	$qpr=mysqli_query($conexao,$asql);
	$cntufs=0;	
	while($dadosp=mysqli_fetch_array($qpr)){
		echo "-".$dadosp[estado];
			if($ufd!=$dadosp[estado]) {
				$cntufs=$cntufs+1;				
				$ufd=$dadosp[estado];
				$est[$cntufs]=$ufd;
			}
			$sme[$cntufs]=$sme[$cntufs]+1;
			
	}
	
	echo "Total de Estados: ".$cntufs."<br>";
	for($i=0; $i<$cntufs; $i++){
		echo $est[$i]." = ".$sme[$i]."<br>";
	}
?>
</div>
                  


	
</body>
</html>
