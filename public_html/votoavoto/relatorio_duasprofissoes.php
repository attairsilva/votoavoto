<? 
include("config.ini.php");
include("sec.php");
set_time_limit(10000);
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
						<H2>PROFISSIONAIS COM DUAS PROFISSÕES</H2>
				
					</div>
	        <!-- End Box Head -->	

					<!-- Table -->
					<h2>&nbsp;</h2>
				  <p> <br /></p>
					<div class="table">
						<table  border="0" cellspacing="0" cellpadding="0" >
                        
	
							<? 
							
		$texto2='<table width="100%" border="0" cellspacing="0" cellpadding="0" >';
					
						
	    $sqlp=" SELECT DISTINCT nome, crefito, votou, forma, id_usuario, data_horario FROM profissionais 
	            WHERE votou='sim' GROUP BY nome HAVING count(nome) > 1";
	     //echo '<br>SQL: '.$sqlp;
					
			$qprocessos=mysqli_query($conexao,$sqlp);				
			if(!$qprocessos) { echo 'Erro: '.mysqli_error(); }
			while($dadosp=mysqli_fetch_array($qprocessos)){
				
				$x=$x+1;
				
				
				
				if($x%2==0) { $cor="#FFFFFF"; 
				}
				else{
								$cor="#FFFFCC";
				}	
				

							
							$texto2=$texto2.'<tr>
							
						      <td width="100%" height="1"  colspan="3">'.utf8_encode($dadosp["nome"]).' - '.$dadosp["crefito"].'</td>
							  </tr>';
							
							?>
							
							<tr>
							  <td width="1%" height="1" style="background:<?=$cor?>; border:0; padding:0" colspan="3"><?=$dadosp["nome"]." - ".$dadosp["crefito"]?></td>
						    
						  </tr>
							
							<? 
							
							
							} 
							
							
							?>
                             <tr>
			            <td colspan="3" align="left"  style=" border: 1px solid black ">
						<h1><b><font color="#000000"><?=$x?>
					    profissionais com duas profissões ou duplicados</font></b></h1>
						</td>
			          </tr>			
						</table>
						
						<? 
						
	
						$texto2=$texto2."</table>";
								$texto1='
		
<html>
<head>
<title>CREFITO - VOTO A VOTO </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
		
		<table align="center" width="800" border="0" cellspacing="0" cellpadding="10">
					 
					  <tr>
			            <td colspan="5" align="center" height="30"> <h1><B>
						'.utf8_encode("ELEIÇÕES").'</B></h1>  </td>
			          </tr>
					    <tr>
			            <td colspan="5" align="center" height="1">
_______________________________________________________________________________________________</td>
			          </tr>
					 
					  <tr>
			            <td colspan="5" align="left"> 


<div align="justify">'.utf8_encode('Profissionais <b> com duas profissões ou duplicados</b>').':   </div>

</td>
			          <tr>
			            <td colspan="5" align="left"  style=" border: 1px solid black ">';
					  
  		$texto=utf8_decode($texto1.$texto2);
		
		$texto.='		</td>
			          </tr>	
					   <tr>
			            <td colspan="5" align="left"  style=" border: 1px solid black ">
						<b><h1>'.$x.' registros.</h1><b>
						</td>
			          </tr>					
					</table>
					</body>
						</htm>';
							
						?>
					  <!-- Pagging -->
					  <div class="pagging">
                      
                     <? 
                      $pagename = "relatorio_duplos.html";
						$fp = fopen($pagename , "w");
						//$texto=utf8_encode($texto);
						$fw = fwrite($fp, $texto);

						#Verificar se o arquivo foi salvo.
						if($fw == strlen($texto)) {
							
								echo '<a href="'.$pagename.'" target="_blank"><B>CLIQUE AQUI PARA IMPRIMIR</B></a>';
								/*include("mpdf60/mpdf.php");
								$mpdf=new mPDF();
								$mpdf->SetDisplayMode('fullpage');
								$css = file_get_contents("css/style.css");
								$mpdf->WriteHTML($css,1);
								$mpdf->WriteHTML($texto);
								$mpdf->Output();*/

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