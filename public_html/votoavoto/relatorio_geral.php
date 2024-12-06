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
	<div class="shell">
		
	
	  <!-- Main -->
    <div id="main">
		  <!-- Content -->
		  
	  <div id="content">
				
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div>
						<H2>RELATORIO GERAL</H2>
				
					</div>
	        <!-- End Box Head -->	

					<!-- Table -->
				
					<div class="table">
						<table  cellspacing="0" cellpadding="0" >
                        
	
							<?php 

	// verifica a pagina aberta setada
	$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

	// contando o total de registros
	$contasql= mysqli_query($conexao,"select id_inscricao,nome,crefito,votou,forma,id_usuario,data_horario from profissionais order by nome");
	$total= mysqli_num_rows($contasql);
	$total2 = $total;
	?>
	<tr>
	<td width="1%" height="1" style="background:<?=$cor?>; border:0; padding:0">
	</td>
		<td width="66%" height="1" style="background:<?=$cor?>; border:0; padding:0"><b>TOTAL DA LISTA: </b> <?=$total?> </td>
		<td width="33%" height="1" style="background:<?=$cor?>; border:0; padding:0"></td>
</tr>
<?php 
	/*
	// qtd de registros por pagina
	$registros = 100;
	
	// calculando numero de paginas por resultado e arredondando para cima
	$numPaginas = ceil ($total/$registros);					
	
	// calcula o inicio da visualização com base na pagina atual
	$inicio = ($registros*$pagina)-$registros;

	$sqlp=" select id_inscricao,nome,crefito,votou,forma,id_usuario,data_horario 
	from profissionais order by nome limit $inicio, $registros";
	*/
	$sqlp=" select id_inscricao,nome,crefito,votou,forma,id_usuario,data_horario 
	from profissionais order by nome";
	
	$texto2='<table width="100%" border="0" cellspacing="0" cellpadding="0" >';

					
			$qprocessos=mysqli_query($conexao,$sqlp);				
			if(!$qprocessos) { echo 'Erro!'; }
			while($dadosp=mysqli_fetch_array($qprocessos)){
				$x=$x+1;
				
				
				
				if($x%2==0) { $cor="#FFFFFF"; }
				else{
								$cor="#FFFFCC";
				}	
				if($dadosp["votou"]!="sim") { 
						$cor="#dcdcdc";
				}
				
				
							$e_nome=$dadosp["nome"];
							$e_crefito=$dadosp["crefito"];
							$texto2=$texto2.'<tr>
							  <td width="1%" height="1">&nbsp;</td>
						      <td width="66%" height="1">'.$dadosp["nome"].' - '.$dadosp["crefito"].'</td>
							  <td width="33%" height="1">';
							 $iducc=$dadosp["id_usuario"]; 
							 $somau[$iducc]=$somau[$iducc]+1;
							
							?>
							
							<tr>
							  <td width="1%" height="1" style="background:<?=$cor?>; border:0; padding:0">&nbsp;</td>
						      <td width="66%" height="1" style="background:<?=$cor?>; border:0; padding:0"><?=utf8_encode($dadosp["nome"])." - ".$dadosp["crefito"]?></td>
						      <td width="33%" height="1" style="background:<?=$cor?>; border:0; padding:0"> <?php  $sqlusr=mysqli_fetch_array(mysqli_query($conexao,"select id,usuario,tipo from admin where id='".$dadosp["id_usuario"]."'"));
							  if($dadosp["votou"]=="sim") { 
									$xv=$xv+1;
									$e_voto="computado";
								  if($dadosp["forma"]!=NULL) { 
									$datetime = $dadosp["data_horario"];
									$orgdate = date("d/m/Y H:i", strtotime($datetime ));
									 echo "Voto ".$dadosp["forma"]." <br><id> 
									 Registrado por [".$sqlusr["usuario"]."] <br>Data/Hora ".$orgdate."</i>"; 
										$texto2=$texto2."Voto ".$dadosp["forma"]." 
										<br><id> Registrado por [".$sqlusr["usuario"]."] <br>Data/Hora ".$orgdate."</i>"; 
									}else{ 
										echo "----------------------"; 
										$texto2=$texto2.'----------------'; 
									}
							  }else{
								  $xnv=$xnv+1;
									echo "<b><font color=\"red\">Não recebidos</font></b>"; 
										$texto2=$texto2.utf8_decode('<b><font color="red">Não recebidos</font></b>'); 
										$e_voto="nao computado";
							  }
							  ?></td>
						  </tr>
							
							<?php
								$texto2=$texto2.'</td></tr>';
								$texto2=$texto2.'<tr>
							  <td width="1%" colspan="3">-----------------------------------------------------------------------------------------------------------</td> </tr>';
								$e_carrega=$e_carrega.$e_crefito.";".$e_nome."; ".$e_voto."\n";
								//echo $texto2;
							} 
							
							
							
							
							
							
							
							?>
                             <tr>
			            <td colspan="3" align="left"  style=" border: 1px solid black ">
						<h1><b><font color="#000000">Envelopes de votos registrado como recebidos: <?=$xv?>;<br>
						Envelopes de votos não recebidos: <?=$xnv?>;</font></b></h1>
						<b><font color="#000000">Quantidade de apuração por usuário:</font></b><br><?php
						$ssqq=mysqli_query($conexao,"select id,usuario from admin order by id desc");
						while($somassq=mysqli_fetch_array($ssqq)){						
						 $idusd=$somassq["id"];
					     if($somau[$idusd]!=NULL) { $textoparam=$textoparam." ".$somassq[usuario].": ".$somau[$somassq["id"]]."<br>";  }
						}
						echo $textoparam;
						$texto2=$texto2.'<tr>
							  <td width="1%" colspan="3"><b><font color="#000000">Votos registrados por usuario:</font></b><br>
							  '.$textoparam.'</td> </tr>';
						
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


<div align="justify">'.utf8_decode('Relatório geral de conferência dos votos.  
Relação gerada em ').date('d/m/Y').':  </div>

</td>
			          <tr>
			            <td colspan="5" align="left"  style=" border: 1px solid black ">';
					  
  		$texto=utf8_encode($texto1.$texto2);
		
		$texto.='		</td>
			          </tr>	
					   <tr>
			            <td colspan="5" align="left"  style=" border: 1px solid black ">
						<b><h1>Envelopes de votos recebidos: '.$xv.';<br>
						Não recebidos: '.$xnv.';</h1><b>
						</td>
			          </tr>					
					</table>
					</body>
						</htm>';
							
						?>
					  <!-- Pagging -->
					  <div class="pagging">
                      
                     <?php
                      $pagename = "relatorio_geral.html";
					  $pagenamecsv = "relatorio_geral.csv";
						$fp = fopen($pagename , "w");
						//$texto=utf8_encode($texto);
						$fw = fwrite($fp, $texto);

						#Verificar se o arquivo foi salvo.
						if($fw == strlen($texto)) {
							
								echo '<br><br> <a href="'.$pagename.'" target="_blank"><B>RELATORIO HTML </B></a>';
								
								$fp=fopen($pagenamecsv, "w");
								$gerarcsv=fwrite($fp,$e_carrega);
								fclose($fp);
								
								echo '<br><br><a href="'.$pagenamecsv.'" target="_blank"><B>RELATORIO CSV (EXCEL) </B></a>';
							
							
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


	
</body>
</html>
