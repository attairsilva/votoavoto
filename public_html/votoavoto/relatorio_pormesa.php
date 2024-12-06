<?php 
include("sec.php");
include("config.ini.php");
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
	<div class="shell">
		
	
	  <!-- Main -->
    <div id="main">
		  <!-- Content -->
		  
	  <div id="content">
				
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div>
						<H2>PROFISSIONAIS COM OS VOTOS CONTABILIZADOS - para impressão</H2>
				
					</div>
	        <!-- End Box Head -->	

					<!-- Table -->
				
					<div class="table">
						<table  cellspacing="0" cellpadding="0" >
                        
	
							<?php 

	// verifica a pagina aberta setada
	$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

	// contando o total de registros
	$contasql= mysqli_query($conexao,"select id_inscricao,nome,crefito,votou,forma,id_usuario,data_horario from profissionais WHERE votou='sim' order by data_horario");
	$total= mysqli_num_rows($contasql);
	$total2 = $total;
	?>
	<tr>
	<td width="1%" height="1" style="background:<?=$cor?>; border:0; padding:0">
	</td>
		<td width="66%" height="1" style="background:<?=$cor?>; border:0; padding:0"><b>TOTAL:</b> <?=$total?> </td>
		<td width="33%" height="1" style="background:<?=$cor?>; border:0; padding:0"></td>
</tr>
<?php 
	// qtd de registros por pagina
	//$registros = 100;
	
	// calculando numero de paginas por resultado e arredondando para cima
	//$numPaginas = ceil ($total/$registros);					
	
	// calcula o inicio da visualização com base na pagina atual
	//$inicio = ($registros*$pagina)-$registros;

	/*$sqlp=" select id_inscricao,nome,crefito,votou,forma,id_usuario,data_horario 
	from profissionais WHERE votou='sim'
	 order by data_horario limit $inicio, $registros";*/
	 
	 $sqlp=" select id_inscricao,nome,crefito,votou,forma,id_usuario,data_horario 
	from profissionais WHERE votou='sim'
	 order by data_horario";

	$texto2='<table width="100%" border="0" cellspacing="0" cellpadding="0" >';

					
			$qprocessos=mysqli_query($conexao,$sqlp);				
			if(!$qprocessos) { echo 'Erro!'; }

			while($dadosp=mysqli_fetch_array($qprocessos)){
				$x=$x+1;
				
				
				
				if($x%2==0) { $cor="#FFFFFF"; }
				else{
								$cor="#FFFFCC";
				}	
				
				
							
							$texto2=$texto2.'<tr>
							  <td width="1%" height="1">&nbsp;</td>
						      <td width="66%" height="1">'.$dadosp["nome"].' - CREFITO/'.$dadosp["crefito"].'</td>
							  <td width="33%" height="1">';
							 $iducc=$dadosp["id_usuario"]; 
							 $somau[$iducc]=$somau[$iducc]+1;
							
							?>
							
							<tr>
							  <td width="1%" height="1" style="background:<?=$cor?>; border:0; padding:0">&nbsp;</td>
						      <td width="66%" height="1" style="background:<?=$cor?>; border:0; padding:0"><?=utf8_encode($dadosp["nome"])." - ".$dadosp["crefito"]?></td>
						      <td width="33%" height="1" style="background:<?=$cor?>; border:0; padding:0"> <?php  $sqlusr=mysqli_fetch_array(mysqli_query($conexao,"select id,usuario,tipo from admin where id='".$dadosp["id_usuario"]."'"));
							  if($dadosp["forma"]!=NULL) { 
								$e_nome=$dadosp["nome"];
								$e_crefito=$dadosp["crefito"];
							    $datetime = $dadosp["data_horario"];
								$orgdate = date("d/m/Y H:i", strtotime($datetime ));
								 echo "Voto ".$dadosp["forma"]." <br><id> 
								 Registrado por [".$sqlusr["usuario"]."] <br>Data/Hora ".$orgdate."</i>"; 
							  		$texto2=$texto2."Voto ".$dadosp["forma"]." 
									<br><id> Registrado por [".$sqlusr["usuario"]."] <br>Data/Hora ".$orgdate."</i>";
									$e_dadovv=$orgdate;
									$e_dadovn=$sqlusr["usuario"];								
								}else{ 
									echo "----------------------"; 
									$texto2=$texto2.'----------------'; 
								} 
							  ?></td>
						  </tr>
							
							<?php
								$texto2=$texto2.'</td></tr>';
								$texto2=$texto2.'<tr>
							  <td width="1%" colspan="3">-----------------------------------------------------------------------------------------------------------</td> </tr>';
							  $e_carrega=$e_carrega.$e_crefito.";".$e_nome.";".$e_dadovv.";".$e_dadovn."\n";
							} 
							
							
							
							
							
							
							
							?>
                             <tr>
			            <td colspan="3" align="left"  style=" border: 1px solid black ">
						<h1><b><font color="#000000">Foram <?=$total2?>  o total de envelopes de votos por correspondência recebidos.</font></b></h1>
						<b><font color="#000000">Quantidade por usuário:</font></b><br><?php
						$ssqq=mysqli_query($conexao,"select id,usuario from admin order by id desc");
						while($somassq=mysqli_fetch_array($ssqq)){						
						 $idusd=$somassq["id"];
					     if($somau[$idusd]!=NULL) { $textoparam=$textoparam." ".$somassq['usuario'].": ".$somau[$somassq["id"]]."<br>";  }
						}
						echo $textoparam;
						$texto2=$texto2.'<tr>
							  <td width="1%" colspan="3"><b><font color="#000000">Registros por usuario:</font></b><br>'.$textoparam.'</td> </tr>';
						
						?>
						</td>
			          </tr>	
					  
						</table>
						
						<?php
						$texto2=$texto2."</table>";
								$texto1='
		
<html>
<head>
<title>VOTO A VOTO </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
		
		<table align="center" width="800" border="0" cellspacing="0" cellpadding="10">
					 
					  <tr>
			            <td colspan="5" align="center" height="30"> <h1><B>
						'.utf8_decode('ELEIÇÕES').' </B></h1>  </td>
			          </tr>
					    <tr>
			            <td colspan="5" align="center" height="1">
_______________________________________________________________________________________________</td>
			          </tr>
					 
					  <tr>
			            <td colspan="5" align="left"> 


<div align="justify">'.utf8_decode('Profissionais <b> com envelopes registrados no sistema </b> após conferência da correspondência.  
Relação gerada em ').date('d/m/Y').':  </div>

</td>
			          <tr>
			            <td colspan="5" align="left"  style=" border: 1px solid black ">';
					  
  		$texto=utf8_encode($texto1.$texto2);
		
		$texto.='		</td>
			          </tr>	
					   <tr>
			            <td colspan="5" align="left"  style=" border: 1px solid black ">
						<b><h1>Foram '.$total2.' o total de envelopes de votos por correspondência recebidos.</h1><b>
						</td>
			          </tr>					
					</table>
					</body>
						</htm>';
							
						?>
					  <!-- Pagging -->
					  <div class="pagging">
                      
                     <?php
					 if($e_carrega!=NULL) { 
						$pagenamecsv = "relatorio_votacao_computado.csv";
						$pagename = "relatorio_votacao.html";
							$fp = fopen($pagename , "w");
							//$texto=utf8_encode($texto);
							$fw = fwrite($fp, $texto);

							#Verificar se o arquivo foi salvo.
							if($fw == strlen($texto)) {
								
									echo '<br><br><a href="'.$pagename.'" target="_blank"><B>RELATORIO HTML </B></a>';
									$fp=fopen($pagenamecsv, "w");

									$gerarcsv=fwrite($fp,$e_carrega);
									fclose($fp);
									
									echo '<br><br><a href="'.$pagenamecsv.'" target="_blank"><B>RELATORIO CSV (EXCEL) </B></a><br><br>';
								
							}else{
								echo 'falha ao criar arquivo';
							}
					    }else{
							echo '<br><br>Sem registro!<br><br>';
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


	
</body>
</html>
