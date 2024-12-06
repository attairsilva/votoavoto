<?php
include("config.ini.php");
include("sec.php");
if($ftipo==NULL) {
	$ftipo="crefito";
}
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>VOTO A VOTO</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="W3.css">
 <script type="text/javascript" src="ajax.js"></script>
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
if($busca==NULL) { 
	$busca=$_GET["busca"];
}

$regaut=$_POST["regaut"];
if($regaut==NULL) { 
	$regaut=$_GET["regaut"];
}
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
  <p class="w3-xlarge w3-serif">Sessão destinada a leitura de etiquetas.</p></div>
  <div>
        <?php
		
				if($_GET["confirma"]!=NULL) {
					
					$tipo="correspondencia";
					// hora do servidor
					$datahora=date('Y-m-d H:i:s');
					// altera  alvo da busca para sim
					$sqlaq="
					UPDATE 
					 profissionais 
					SET 
					 votou='sim', 
					 forma='$tipo', 
					 id_usuario='$idu', 
					 data_horario='$datahora' 
					WHERE 
					 id_inscricao='".$_GET["confirma"]."'";
					$sqla=mysqli_query($conexao,$sqlaq);
					
					if($sqla) {	
						$msg="<div class=\"w3-panel w3-blue w3-card-4\"><p><h2>Voto recebido com sucesso!</h2></p></div>"; 
						$cks="green";					
						if($_GET['cod']!=NULL){
							if($_GET['regaut']=='sim') { 
								$msglog="Usuario [".$adm_usuario."] - Confirmação do registro ocorreu de forma automatica [".$_GET['cod']."]";
							}else{
								$msglog="Usuario [".$adm_usuario."] - Confirmou o registro do voto [".$_GET['cod']."]";
							}
							$datalog=date('Y-m-d H:i:s');
							$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
							VALUES('$idu','$msglog','$datalog')");
						}
						
						$sql_m=mysqli_query($conexao,"SELECT id_inscricao, nome, crefito, votou FROM  profissionais WHERE id_inscricao='".$_GET["confirma"]."'");
						$dsql_m=mysqli_fetch_array($sql_m);
						$msg=$msg."<font  size=7><b>".$dsql_m['nome']."<br> ".$dsql_m['crefito']."</b></font>
						
						<div class=\"w3-panel w3-leftbar w3-sand w3-xxlarge w3-serif\">
						<p>Não é este REGISTRO?
						[<a href=\"http://".$_SERVER['HTTP_HOST']."/votoavoto/votacao_acao_confirma.php?desfazer=".$_GET["confirma"]."&cod=".$_GET['cod']."&regaut=sim\" onClick=\"return confirm('Deseja realmente DESFAZER?')\">
						CLIQUE AQUI PARA DESFAZER</a>]</p></div>";
	
						
					}else { 
						$bgc="msg-error"; 
						$cks="red";
						$msg="<font size=5 color=\"red\"><b>O voto não foi  computado, erro ao
						 confirmar!</b><br><br></font>"; 
						if($_GET[cod]!=NULL){
							$msglog="Usuario [".$adm_usuario."] - Ocorreu um erro ao tentar registrar o recebimento do voto [".$_GET['cod']."] no banco de dados";
							$datalog=date('Y-m-d H:i:s');
							$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
							VALUES('$idu','$msglog','$datalog')");
						}
						
					} 
				
				}elseif($_GET["desfazer"]!=NULL){
					
					
					// hora do servidor
					$datahora=date('Y-m-d H:i:s');
					// altera  alvo da busca para sim
					$sqlaqd="
					UPDATE 
					 profissionais 
					SET 
					 votou='nao', 
					 forma='', 
					 id_usuario='0', 
					 data_horario='$datahora' 
					WHERE 
					 id_inscricao='".$_GET["desfazer"]."'";
					$sqlad=mysqli_query($conexao,$sqlaqd);
					if($sqlad) {
						$msglog="Usuario [".$adm_usuario."] - Desfez a confirmação do recebimento do voto [".$_GET['cod']."] ";
						$datalog=date('Y-m-d H:i:s');
						$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
						VALUES('$idu','$msglog','$datalog')");
						$bgc="msg-error"; 
						$cks="yellow";
						$msg="<div class=\"w3-panel w3-yellow w3-card-4\"><p><h2>
						Confirmação de recebimento do voto DESFEITA pelo usuário !</h2></p></div>"; 
					}
				
				}
	
?>
           <div  class="w3-panel w3-pale-<?=$cks?> w3-border w3-border-<?=$cks?>">
          <p><?=$msg?></p> </div>




		

  <form  name="form1" id="form1" method="post"  action="votacao_acao.php"  autocomplete="off">

<div class="w3-panel w3-withe w3-card-4">
  <p>
    <header class="w3-container w3-teal">
     <h1>LOCALIZAR</h1>
     </header></p>
	 <p>


<input class="w3-radio" type="radio" name="ftipo" value="crefito" <? if ($ftipo=="crefito") { echo "checked"; } ?>>
<label class="w3-text-teal">Código de Barras ou INSCRIÇÃO</label>

<input class="w3-radio" type="radio" name="ftipo" value="nome" <? if ($ftipo=="nome") { echo "checked"; } ?>>
<label class="w3-text-teal">Nome</label> 

 <input name="busca"  style="width:auto" type="text"  id="busca" value="" autofocus  tabindex=1 autocomplete="off"   />

 <input type="submit" name="button2" id="button2" value="Procurar"  class="w3-btn w3-teal w3-round-xxlarge" tabindex=2 />
 <input type="button" value="Limpa" class="w3-btn w3-teal w3-round-xxlarge" onClick="limpa()" >
 <p><input name="regaut" type="checkbox" style="width:auto" id="regaut" value="sim" checked/>&nbsp;Confirmar automático despois de alguns segundos
</p><? if($busca!=NULL) { ?>
<div class="w3-panel w3-leftbar w3-light-grey">
  <p class="w3-xlarge w3-serif">
   <i>Último dado procurado foi: <font color=red><?=$busca;?></font></i>
   </div><? } ?>
  </div>

 
</form>
 
</div>


</div>
</body>
</html>
