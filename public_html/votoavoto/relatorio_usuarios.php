<? 
include("config.ini.php");
include("sec.php");
?><!DOCTYPE html>
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
						<H2>PROFISSIONAIS COM OS VOTOS CONTABILIZADOS POR USUARIO</H2>
				
					</div>
	        <!-- End Box Head -->	

					<!-- Table -->
				
					<div class="table">
						<table  border="0" cellspacing="0" cellpadding="0" >
                        
	
							<? 
							
		$texto2='<table width="100%" border="0" cellspacing="0" cellpadding="0" >';
					
						
							
							
	$sqlp=" select id_inscricao,nome,crefito,votou,forma,id_usuario,data_horario 
	from profissionais WHERE votou='sim' order by id_usuario, nome";
	//echo '<br>SQL: '.$sql.'<br>Ano: '.$fano;
					
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
						      <td width="66%" height="1">'.$dadosp["nome"].' -'.$dadosp["crefito"].'</td>
							  <td width="33%" height="1">';
							
							?>
							
							<tr>
							  <td width="1%" height="1" style="background:<?=$cor?>; border:0; padding:0">&nbsp;</td>
						      <td width="66%" height="1" style="background:<?=$cor?>; border:0; padding:0"><?=utf8_encode($dadosp["nome"])." - ".$dadosp["crefito"]?></td>
						      <td width="33%" height="1" style="background:<?=$cor?>; border:0; padding:0"> <?
                              $sqlusr=mysqli_fetch_array(mysqli_query($conexao,"select id,usuario,tipo from admin where id='".$dadosp["id_usuario"]."'"));
							  if($dadosp["forma"]!=NULL) { 
							    $datetime = $dadosp["data_horario"];
								$orgdate = date("d/m/Y H:i", strtotime($datetime ));
								 echo "Voto ".$dadosp["forma"]." <br><id> 
								 Registrado por [".$sqlusr["usuario"]."] as ".$orgdate."</i>"; 
							  		$texto2=$texto2."Voto ".$dadosp["forma"]." 
									<br><id> Registrado por [".$sqlusr["usuario"]."] as ".$orgdate."</i>"; 
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
						<h1><b><font color="#000000">Foram <?=$x?> o total de votos por correspondência!</font></b></h1>
						</td>
			          </tr>			
						</table>
						
						<? 
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
						CREFITO VOTO A VOTO</B></h1>  </td>
			          </tr>
					    <tr>
			            <td colspan="5" align="center" height="1">
_______________________________________________________________________________________________</td>
			          </tr>
					 
					  <tr>
			            <td colspan="5" align="left"> 


<div align="justify">'.utf8_decode('Relação de votantes por correspondência. 
A relação abaixo foi gerada e impressa em ').date('d/m/Y').':  </div>

</td>
			          <tr>
			            <td colspan="5" align="left"  style=" border: 1px solid black ">';
					  
  		$texto=utf8_encode($texto1.$texto2);
		
		$texto.='		</td>
			          </tr>	
					   <tr>
			            <td colspan="5" align="left"  style=" border: 1px solid black ">
						<b><h1>Foram '.$x.' o total de votos por correspondência!</h1><b>
						</td>
			          </tr>					
					</table>
					</body>
						</htm>';
							
						?>
					  <!-- Pagging -->
					  <div class="pagging">
                      
                     <? 
                      $pagename = "relatorio_votacao.html";
						$fp = fopen($pagename , "w");
						//$texto=utf8_encode($texto);
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


	
</body>
</html>