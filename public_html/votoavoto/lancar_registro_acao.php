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
$fnome=$_POST["fnome"];
$finscricao=$_POST["finscricao"];
?>
<div class="w3-teal">
 &nbsp; 
</div>
 <div class="w3-green">
<div class="w3-bar w3-border w3-light-grey">
  <?php include("barramenu2.php");?>
</div>
</div> 
<div class="w3-container">
    <div class="w3-panel w3-leftbar w3-light-grey">
  <p class="w3-xlarge w3-serif">Sessão destinada a lançamento de um registro no banco</p></div>
  <div>
<?php 
		////
		//// se busca diferente de vazio
		//// entra na busa
if($fnome!=NULL  && $finscricao!=NULL  ) {

				/// se ainda não confirmou busca, procura
				$txtsql="SELECT  *
				FROM  profissionais WHERE 
				crefito='$finscricao' AND 
				nome='$fnome'";
				//echo $txtsql;
				$sqlqq=mysqli_query($conexao,$txtsql);
				if(!$sqlqq) { echo "Error: <br>".mysqli_error(); } 
				$sqldver=mysqli_fetch_array($sqlqq);
				if($sqldver['crefito']!=NULL) {
			
								// se foi encontrado um registro	
							
								 $cks="red";
								 $msg="<div class=\"w3-panel w3-red\">
										<p><h3>ATENÇÃO!</h3>
									Não podemos lançar os valores informados pois já existe um profissional com estes parâmetros.
									</p></div>";
				}else{
								// valor lancado	
							
								$danv=date('Y-m-d H:i:s');
								$regnv= mysqli_query($conexao,"INSERT INTO profissionais (crefito, nome, votou, data_horario) 
								VALUES('$finscricao','$fnome','nao','$danv')"); 
								if($regnv) { 
									$cks="yellow";
									$msg="<div class=\"w3-panel w3-blue\">
											<p><h3>LANÇADO COM SUCESSO</h3>
										<b>".$fnome.". - ".$finscricao."</b> foi inserido no banco.
										</p></div>";

												//iniciolog
											$datalog=date('Y-m-d H:i:s');
											$mgslan=$finscricao.' - '.$fnome;
											$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
											VALUES('$idu','Lançou no banco novo registro: $mgslan','$datalog')");
											//fimlog

								}else{
									$cks="red";
									$msg="<div class=\"w3-panel w3-blue\">
										<p><h3>ATENÇÃO</h3>
									<b>Erro ao tentar incluir <b>".$fnome.". - ".$finscricao."</b> no banco.
									</p></div>";
									
								}
					
				}
	
 
} ?>  

				<div  class="w3-panel w3-pale-<?=$cks?> w3-border w3-border-<?=$cks?>">
				
				
          <p><?=$msg?></p> </div>  



  <form  name="form1" id="form1" method="post"  action="lancar_registro_acao.php"  autocomplete="off">

<div class="w3-panel w3-withe w3-card-4">
  <p>
    <header class="w3-container w3-teal">
     <h1>NOVO REGISTRO</h1>
     </header></p>
	 <p>


 <p>
<label class="w3-text-teal">Nome</label>
<input   type="text" name="fnome" autofocus autocomplete="off" tabindex=2 id="fnome" style="width:100%">
 </p>
  <p>
<label class="w3-text-teal">Cód. Barras ou Inscrição </label> 
<input  style="width:auto" type="text" name="finscricao" tabindex=2 autocomplete="off" id="finscricao">
 </p>
<input type="submit" name="button2" id="button2" value="Gravar"  class="w3-btn w3-teal w3-round-xxlarge" tabindex=2 />
 <input type="button" value="Limpa" class="w3-btn w3-teal w3-round-xxlarge" onClick="limpa()" >
 
 
<div class="w3-panel w3-leftbar w3-light-grey">
  <p class="w3-xlarge w3-serif">
   <i>Utilize em caso de registro não encontrado, desde que tenha certeza que o dado está consistente.</font></i>
   </div>
  </div>

 
</form>		  
</div>
</div>

</body>
</html>
