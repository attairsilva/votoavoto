 
 <!DOCTYPE html>
<?php 
include("sec.php");
include("config.ini.php");
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>VOTO A VOTO</title>
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
		////
		//// se busca diferente de vazio
		//// entra na busa
		if($busca!=NULL) {

				if($ftipo=="crefito") {
					$condicional = " $ftipo = '$busca' ";
				}
				elseif($ftipo=="nome") {
					$condicional = " $ftipo like '%$busca%' ";
				}else{
					$condicional = " $ftipo = '$busca' ";
				}

				/// se ainda não confirmou busca, procura
				if($_GET["confirma"]!="ok") {
				
				
					$sqlqq=mysqli_query($conexao,"SELECT id_inscricao, nome, crefito, votou, data_horario, id_usuario  
						FROM  profissionais WHERE $condicional");
										
					$total=0;
					
					while($sqldver=mysqli_fetch_array($sqlqq, MYSQLI_ASSOC)){
						$total=$total+1;
						$creff=$sqldver['crefito'];
						$pvotou=$sqldver['votou'];
						$encid=$sqldver['id_inscricao'];
						$mcreffr=$sqldver['nome'];
						$mcreff=utf8_decode($sqldver['nome']);
						$gdatetime = $sqldver["data_horario"];
						$gorgdate = date("d/m/Y H:i", strtotime($gdatetime ));
						$idusrmsa = $sqldver["id_usuario"];
						$sqldup=mysqli_fetch_array(mysqli_query($conexao,"SELECT id, usuario FROM  admin WHERE id='$idusrmsa'"),MYSQLI_ASSOC);
						$nmsusr=$sqldup['usuario'];
					}
			

					if ($total==0) {
							//// se total for 0, nao foi encontrado
							$bgc="msg-error";
							$cks="red";
							$msg="<div class=\"w3-panel w3-red\">
									<p><h3>ATENÇÃO OPERADOR!</h3>
									<i>O REGISTRO NÃO FOI LOCALIZADO NO BANCO DE DADOS</i><br>
									Não abra, separe este envelope, no final da leitura de todos os envelopes da mesa, 
									poderão ser analisados novamente.
									</p></div>";
							// inicio log
							$msglog="Usuario [".$adm_usuario."] não localizou o no campo [".$ftipo."] o dado lido [".utf8_encode($busca)."] no banco.<br>";
							$datalog=date('Y-m-d H:i:s');
							$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
							VALUES('$idu','$msglog','$datalog')");
							// fim log
			 		}elseif($total==1) {
						// se o total é igual 1 é porque foi encontrado o registro
						// entao verifica se esta setado como nao votou
						if($pvotou=='nao'){
									$totalduplo=0;
									mysqli_query($conexao, "SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
									$contasqlduplo= mysqli_query($conexao,"SELECT DISTINCT nome, crefito, votou, forma, id_usuario, data_horario FROM profissionais  WHERE nome='$mcreffr'  GROUP BY nome HAVING count(nome) > 1");
									$totalduplo= mysqli_num_rows($contasqlduplo);
									if($totalduplo>0) { 
														if($regaut=="sim") { 
															$regaut="nao";
															$msg=$msg."<div class=\"w3-panel w3-red\">
															<p><h3>ATENÇÃO!</h3>
															A CONFIRMAÇÃO AUTOMÁTICA FOI DESATIVADA -
															CONFIRME MANUALMENTE</p></div>";
														}else{
														$msg=$msg."<div class=\"w3-panel w3-red\">
															<p><h3>ATENÇÃO!</h3>
															</p></div>";
														}
														
														$cks="yellow";
														$msg=$msg."<b>Homônimo, compare o endereço, se divergente confirme manualmente.</b>";
									
														$msg=$msg."<ul>";
														$sqldup=mysqli_query($conexao,"SELECT id_inscricao, nome, crefito, votou FROM  profissionais WHERE nome='$mcreffr'");
														while($dsql=mysqli_fetch_array($sqldup)){
															if($dsql[votou]=="sim") { $opv=" com voto computado. ";}else{ $opv=" sem voto computado."; }
															$msg=$msg."<li>* <b>".$dsql['nome']." -  ".$dsql['crefito']."</b>, ".$opv."<br> ";
															$dsqle=mysqli_fetch_array(mysqli_query($conexao,"SELECT crefito, logradouro, bairro, municipio, estado, CEP FROM  profissionais_enderecos WHERE crefito='".$dsql['crefito']."'"));
															$msg=$msg."Endereço: <i><b>".$dsqle['logradouro']."</b>, ".$dsqle['bairro']." - <b>".$dsqle['municipio']."/".$dsqle['estado']."</b>, CEP ".$dsqle['CEP']."</i>";
															$msg=$msg."</li>";
														}
														$msg=$msg."</ul>";
														
														// inicio log
														$msglog="Usuario [".$adm_usuario."] encontrou registro homônimo, mesmo nome , considerando o nome e sobrenome:<br>
														".$msg;
														$datalog=date('Y-m-d H:i:s');
														$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
														VALUES('$idu','$msglog','$datalog')");
														 print(mysqli_error($conexao)); 
														// fim log
														
													
												
														

									}else{
										 $cks="teal";
									}
				
									 $bgc="msg-ok";
									 $msg=$msg."<div class=\"w3-panel w3-teal  w3-card-4\"><p>
									 <h1><b>".utf8_encode($mcreff)."<br>  ".$creff."</b></h1></p>
									 </div> 
									 <h3><b>Você confirma o recebimento do VOTO?</h3>					 
									 <input name=\"confirma\" type=\"hidden\" 
									 class=\"field small-field\" id=\"confirma\" value=\"".$encid."\" 
									 />
          							<input type=\"hidden\" name=\"txtnome22\" id=\"txtnome22\"
									 value=\"votacao_acao_confirma.php\"/>
									<a href=\"votacao_acao_confirma.php?confirma=$encid&cod=$creff\" class=\"w3-btn w3-blue w3-round-xxlarge\" accesskey=\"S\" />
									CONFIRMAR</a>(Alt + S)
									&nbsp;
									<a href=\"votacao.php?log=$creff\"  class=\"w3-btn w3-red w3-round-xxlarge\" accesskey=\"N\">
									CANCELAR</a>(Alt + N)</font><br><br>
									";
									// confirmação automatica
									// inicio log
									$msglog="Usuario [".$adm_usuario."] fez a leitura do codigo de barras referente a [".utf8_encode($mcreff)." - ".$creff."]. <br>
									Pendente de Confirmação ou Cancelamento.";
									$datalog=date('Y-m-d H:i:s');
									$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
									VALUES('$idu','$msglog','$datalog')");
									// fim log
									
									if($regaut=="sim" && $ftipo=='crefito') {
										$msg=$msg.'<meta http-equiv="refresh" content="1; url=http://'.$_SERVER['HTTP_HOST'].'/votoavoto/votacao_acao_confirma.php?confirma='.$encid.'&cod='.$creff.'&regaut=sim" />';
							
									}//
									
                        //// ja votou (sim) inicio
						}else{
							   $bgc="msg-error";
							    $cks="red";
								 $msg="<div class=\"w3-panel w3-red\">
													<p><h3>ATENÇÃO!</h3>
													
								 <i>O voto deste registro já foi inserido no sistema em <b>".$gorgdate."</b> por <b>".$nmsusr."</b></i></p></div>
								 
								<div class=\"w3-panel w3-teal  w3-card-4\">
								<p><h1><b>".utf8_encode($mcreff)." <br>Crefito/".$creff."
								</b></h1></p></div>";
								
								// inicio log
								$msglog="Usuario [".$adm_usuario."] - Se deparou com a leitura do dado [".utf8_encode($mcreff)." - ".$creff."] apontando para registro com voto ja inserido no sistema.<br>
								O voto deste registro foi inserido no sistema em ".$gorgdate." por ".$nmsusr."";
								$datalog=date('Y-m-d H:i:s');
								$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
								VALUES('$idu','$msglog','$datalog')");
								// fim log
						}
						
					}elseif($total>1) {
						// se foi encontrado mais de um registro, pede para refinar busca			
								 $bgc="msg-error";
								 $cks="red";
								 $msg="<div class=\"w3-panel w3-red\">
										<p><h3>ATENÇÃO!</h3>
									Ops! Refine a sua busca, experimente procurar pelo nome completo marcando o checkbox 'Nome' no formulário.
									<br> </p></div>
								 ";					
						 
					}	
				
				}
	
?>
        <div  class="w3-panel w3-pale-<?=$cks?> w3-border w3-border-<?=$cks?>">
          <p><?=$msg?></p> </div>
           
<?php } 

if($cks=="red" || $cks==NULL ) {
?>       
     

<form  name="form1" id="form1" method="post" autocomplete="off">

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
 <input type="hidden" name="txtnome11" id="txtnome11" value="votacao_acao.php"/>
 <input type="submit" name="button2" id="button2" value="Procurar"  class="w3-btn w3-teal w3-round-xxlarge" tabindex=2 onclick="getDados(11);"    />
 <input type="button" value="Limpa" class="w3-btn w3-teal w3-round-xxlarge" onClick="limpa()" >
 <p><input name="regaut" type="checkbox" style="width:auto" id="regaut" value="sim" <?php if($regaut=="sim") { echo "checked"; } ?>/>&nbsp;Confirmar automático
</p><? if($busca!=NULL) { ?>
<div class="w3-panel w3-leftbar w3-light-grey">
  <p class="w3-xlarge w3-serif">
   <i>Último dado procurado foi: <font color=red><?=$busca;?></font></i>
   </div><? } ?>
  </div>

 
</form>
<? }else{
	?>
	
	 <div  class="w3-panel w3-pale-<?=$cks?> w3-border w3-border-<?=$cks?>">
          <p><a href='votacao.php' class="w3-button w3-black" autofocus  tabindex=1 >Voltar e tentar novamente<a></p> </div>
	<?
	
} ?>
</div>



</div>

</body>
</html>  
