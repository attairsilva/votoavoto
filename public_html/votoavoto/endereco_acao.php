<?php 
include("config.ini.php");
include("sec.php");
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>VOTO A VOTO - CREFITO</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="W3.css">  
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
<?php 
$busca=$_POST["busca"];
$ftipo=$_POST["ftipo"];
if($busca==NULL) { 
	$busca=$_GET["busca"];
}
?>
<div class="w3-teal">
 &nbsp; 
</div>
 <div class="w3-green">
<div class="w3-bar w3-border w3-light-grey">
  <?php include("barramenu2b.php");?>
</div>
</div> 
<div class="w3-container">
  <p>Sessão destinada a verificação de endereço: <br>
</p>
  <div>
<?php 
		////
		//// se busca diferente de vazio
		//// entra na busa
if($busca!=NULL) {

				if($ftipo=="crefito") {
					$condicional = " (profissionais.crefito = '$busca') ";
				}
				elseif($ftipo=="nome") {
					$condicional = " (profissionais.nome like '%$busca%') ";
				}elseif($ftipo=="endereco") {
					$condicional = " 
					(profissionais_enderecos.logradouro like '%$busca%' OR 
					profissionais_enderecos.bairro like '%$busca%' or
					profissionais_enderecos.municipio like '%$busca%' or 
					profissionais_enderecos.estado like '%$busca%' or
					profissionais_enderecos.CEP like '%$busca%') ";
				}elseif($ftipo=="todos") {
					$condicional = "(profissionais.nome like '%$busca%' or
					profissionais.crefito = '$busca' or
					profissionais_enderecos.logradouro like '%$busca%' OR 
					profissionais_enderecos.bairro like '%$busca%' or
					profissionais_enderecos.municipio like '%$busca%' or profissionais_enderecos.estado like '%$busca%' 
					or profissionais_enderecos.CEP like '%$busca%')";
				}

				/// se ainda não confirmou busca, procura
				$txtsql="SELECT  *
				FROM  profissionais, profissionais_enderecos WHERE 
				(profissionais.crefito=profissionais_enderecos.crefito) AND 
				$condicional";
				//echo $txtsql;
				$sqlqq=mysqli_query($conexao,$txtsql);
				if(!$sqlqq) { echo "Error: <br>".mysqli_error(); } 
										
				$total=0;
					
				while($sqldver=mysqli_fetch_array($sqlqq)){
						$total=$total+1;
						$creff=$sqldver['crefito'];
						$encid=$sqldver['id_inscricao'];
						$idusrmsa = $sqldver["id_usuario"];
						$cgnme=$cgnme."<b>Nome:</b>".$sqldver['nome']."-".$sqldver['crefito']."<br>
						<b>Logradouro:</b>".$sqldver['logradouro'].", ".$sqldver['numero']." 
						(".$sqldver['complemento'].")<br><b>Bairro:</b> 
						".$sqldver['bairro']."<br><b>Município/UF:</b> 
						".$sqldver['municipio']."/".$sqldver['estado']."
						<br><b>CEP:</b> ".$sqldver['CEP']."<br><br>--------------------<br><br>";
						
				}
			
				echo "<div class=\"msg-ok>\">
          						<p>".$cgnme."</p>
         					 </div>";
				if ($total<=0) {
							//// se total for 0, nao foi encontrado
							$sqldup=mysqli_fetch_array(mysqli_query($conexao,"SELECT id, usuario 
							FROM  admin WHERE id='$idusrmsa'"));
							$nmsusr=$sqldup['usuario'];
							$bgc="msg-error";
							$msg="<b>Nenhum profissional encontrado no banco 
							a partir das informações enviadas!</b>";
							// inicio log
							$msglog="Usuario  [".$adm_usuario."] durante a verificação de endereço
							 não localizou o no 
							campo [".$ftipo."] o dado lido [".utf8_encode($busca)."] no banco.<br>";
							$datalog=date('Y-m-d H:i:s');
							$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
							VALUES('$idu','$msglog','$datalog')");
							// fim log
			 	}else{
							// se o total é igual 1 é porque foi encontrado o registro
							// entao verifica se esta setado como nao votou
						    // inicio log
									$msglog="Usuario [".$adm_usuario."] consultou o endereço 
									para o profissional [".$mcreff." - ".$creff."]";
									$datalog=date('Y-m-d H:i:s');
									$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, 
									acao, data) 
									VALUES('$idu','$msglog','$datalog')");
				  			 // fim log
				  }
	
 
} ?>       
</div>
</div>

</body>
</html>
