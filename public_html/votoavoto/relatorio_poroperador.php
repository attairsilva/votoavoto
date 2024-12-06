<!DOCTYPE html >
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
o
<? 
$busca=$_POST[busca];
if($busca==NULL) { 
	$busca=$_GET[busca];
}
?>
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
		  <h1><a href="#">CONTROLE DE VOTOS</a></h1>
		  <div id="top-navigation">Bem vindo(a) <strong>
			   <?  

$adm_usuario=$_COOKIE[login];
$nivel=$_COOKIE[nivel];
include("config.ini.php");
include("sec.php");
echo $adm_usuario."(<a href='alterarpass.php'>alterar senha</a>)";
?>
			</strong>
				 
				<span>|</span>
			<a href="logout.php">Sair</a></div>
		</div>
		<!-- End Logo + Top Nav -->
		
		<!-- Main Nav -->
		<? include("barramenu.php"); ?>
		<!-- End Main Nav -->
	</div>
</div>
<!-- End Header -->

<!-- Container -->
<div id="container">
	<div class="shell">
		
	
	  <!-- Main -->
    <div id="main">
		  <!-- Content -->
		  
	  <div id="content">
				
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						PROFISSIONAIS COM OS VOTOS CONTABILIZADOS
						  <div class="right">
							<form id="form2" name="form2" method="post" action="">
							</form>
						</div>
					</div>
	        <!-- End Box Head -->	

					<!-- Table -->
					<h2>&nbsp;</h2>
				  <p> <br /></p>
					<div class="table">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" >
                        
	
							<? 
							
		$texto2='<table width="100%" border="0" cellspacing="0" cellpadding="0" >';
					
						
							
							
	$sqlp=" select id_inscricao,nome,crefito,votou,forma,id_usuario,data_horario from profissionais WHERE votou='sim' order by nome";
	//echo '<br>SQL: '.$sql.'<br>Ano: '.$fano;
			$sessao_a=0;
			$sessao_b=0;		
			$qprocessos=mysql_query($sqlp);				
			if(!$qprocessos) { echo 'Erro: '.mysql_error(); }
			while($dadosp=mysql_fetch_array($qprocessos)){
				$x=$x+1;
				
				if($dadosp[id_usuario]==8) { $sessao_4=$sessao_4+1; }
				elseif($dadosp[id_usuario]==7){ $sessao_5=$sessao_5+1; }
				
				
				
				if($x%2==0) { $cor="#FFFFFF"; }
				else{
								$cor="#FFFFCC";
				}	
				
				if($dadosp[votou]=="sim") { $cor="#B1E2FC"; }
							
							$texto2=$texto2.'<tr>
							  <td width="1%" height="1">&nbsp;</td>
						      <td width="66%" height="1">'.$dadosp[nome].' - '.$dadosp[crefito].' - COD. BARRAS: '.$dadosp[id_inscricao].'</td>
							  <td width="33%" height="1">';
							
							?>
							
							<tr>
							  <td width="1%" height="1" style="background:<?=$cor?>; border:0; padding:0">&nbsp;</td>
						      <td width="66%" height="1" style="background:<?=$cor?>; border:0; padding:0"><?=$dadosp[nome]." - ".$dadosp[crefito]." - COD. BARRAS: ".$dadosp[id_inscricao]?></td>
						      <td width="33%" height="1" style="background:<?=$cor?>; border:0; padding:0"> <?
                              $sqlusr=mysql_fetch_array(mysql_query("select id,usuario,tipo from admin where id='".$dadosp[id_usuario]."'"));
							  if($dadosp[forma]!=NULL) { 
							    $datetime = $dadosp[data_horario];
								$orgdate = date("d/m/Y", strtotime($datetime ));
							
							  		echo "Voto ".$dadosp[forma]." <br><id> Registrado por [".$sqlusr[usuario]."] <br>".$orgdate."</i>"; 
							  		$texto2=$texto2."Voto ".$dadosp[forma]." <br><id> Registrado por [".$sqlusr[usuario]."] <br>".$orgdate."</i>"; 
								}else{ 
									echo "----------------------"; 
									$texto2=$texto2.'----------------'; 
								} 
							  ?></td>
						  </tr>
							
							<? 
								$texto2=$texto2.'</td></tr>';
							
							} 
							
							
							
							
							
							
							
							?>
                             <tr>
			            <td colspan="3" align="left"  style=" border: 1px solid black ">
						<b><h1><font color="#000000">Foram <?=$x?> o total de votos por correspondência!<br />
						  <br />
						Sessão 4 =<?=$sessao_4?><br />
Sessão 5 = <?=$sessao_5?><br />
</font></h1><b>						</td>
			          </tr>			
						</table>
						
						<? 
						$texto2=$texto2."</table>";
								$texto1='
		
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>vOTO A VOTO</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
		
		<table align="center" width="800" border="0" cellspacing="0" cellpadding="10">
					 
					  <tr>
			            <td colspan="5" align="center" height="30"> <img src="logo.jpg" width="359" height="88" />  </td>
			          </tr>
					    <tr>
			            <td colspan="5" align="center" height="1">Rua H, Quadra 4, Setor A, Lote 2 - Centro Político Administrativo - Cuiabá/MT<br />
(65) 3644-4272 - www.crefito9.org.br - eleicoes@crefito9.org.br<br />
_______________________________________________________________________________________________</td>
			          </tr>
					 
					  <tr>
			            <td colspan="5" align="left"> 


<div align="justify">Relação de votantes no Quadriênico 2018 - 2022 do Conselho Regional de Fisioterapia e Terapia Ocupacional da Nona Região. A relação abaixo foi gerada e impressa em '.date('d/m/Y').':  </div>

</td>
			          <tr>
			            <td colspan="5" align="left"  style=" border: 1px solid black ">';
					  
  		$texto=$texto1.$texto2;
		
		$texto.='		</td>
			          </tr>	
					   <tr>
			            <td colspan="5" align="left"  style=" border: 1px solid black ">
						<b><h1>Foram '.$x.' o total de votos por correspondência!<br />
Operador 02 - Sessão 4 => '.$sessao_4.'<br />
Operador 01 - Sessão 5 => '.$sessao_5.'<br />

</h1><b>
						</td>
			          </tr>					
					</table>
					</body>
						</htm>';
							
						?>
					  <!-- Pagging -->
					  <div class="pagging">
                      
                     <? 
                      $pagename = "relatorio_votacaoporoperador.html";
						$fp = fopen($pagename , "w");
						$texto=utf8_decode($texto);
						$fw = fwrite($fp, $texto);

						#Verificar se o arquivo foi salvo.
						if($fw == strlen($texto)) {
							
								echo '<a href="'.$pagename.'" target="_blank"><B>CLIQUE AQUI PARA IMPRIMIR </B></a>';
							
						}else{
						   	echo 'falha ao criar arquivo';
						}
?>
                      </div>
						<!-- End Pagging -->
					</div>
					<!-- Table -->
				</div>
<!-- End Box -->
				
				<!-- Box --><!-- End Box -->
			</div>
	    <!-- End Content -->
        
			
			<!-- Sidebar --><!-- End Sidebar -->
			
		  <div class="cl">&nbsp;</div>			
		</div>
	  <!-- Main -->
	</div>
</div>
<!-- End Container -->

<!-- Footer -->
<div id="footer">
	<div class="shell">
		<span class="left">&copy; 2018 - Attair Silva -  Suporte (65) 928161-4053</span>
		<span class="right">
			Design by <a href="http://chocotemplates.com" target="_blank" title="The Sweetest CSS Templates WorldWide">Chocotemplates.com</a>		</span>	</div>
</div>
<!-- End Footer -->
</body>
</html>
