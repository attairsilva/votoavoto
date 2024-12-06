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
						<H2>PROFISSIONAIS EM DUPLICIDADE DE NOME</H2>
				
					</div>
	        <!-- End Box Head -->	

					<!-- Table -->
				
					<div class="table">
						<table  cellspacing="0" cellpadding="0" >
                        
	
							<?php 


	// contando o total de registros
	mysqli_query($conexao, "SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
	$contasql= mysqli_query($conexao,"SELECT DISTINCT profissionais.nome, profissionais.crefito, 
	profissionais.votou, profissionais.forma, profissionais.id_usuario, profissionais.data_horario 
	FROM profissionais  WHERE profissionais.nome <> '' 
	GROUP BY profissionais.nome 
	HAVING count(profissionais.nome) > 1");
	$total= mysqli_num_rows($contasql);
	
	
	$sqlp=" SELECT DISTINCT profissionais.nome, profissionais.crefito, profissionais.votou, profissionais.forma, profissionais.id_usuario,profissionais.data_horario FROM profissionais WHERE profissionais.nome <> '' GROUP BY profissionais.nome HAVING count(profissionais.nome) > 1";

	?>
	<tr>
	<td width="1%" height="1" style="background:<?=$cor?>; border:0; padding:0">
	</td>
		<td colspan="2" width="66%" height="1" style="background:<?=$cor?>; border:0; padding:0"><b><font color="#000000"><b><?=$total?></b> de duplicados</font></b>
</td>
		
</tr>
	<?php
			$qprocessos=mysqli_query($conexao,$sqlp);				
			if(!$qprocessos) { echo 'Erro: '.mysqli_error(); }
			while($dadosp=mysqli_fetch_array($qprocessos)){
				$x=$x+1;
				
				
				
				if($x%2==0) { $cor="#FFFFFF"; }
				else{
								$cor="#FFFFCC";
				}	
							
							?>
							
							<tr>
							  <td width="1%" height="1" style="background:<?=$cor?>; border:0; padding:0">&nbsp;</td>
						      <td width="66%" height="1" style="background:<?=$cor?>; border:0; padding:0"><?=utf8_encode($dadosp["nome"])." - ".$dadosp["crefito"]?></td>
						      <td width="33%" height="1" style="background:<?=$cor?>; border:0; padding:0"></td>
						  </tr>
							
							<?php 
							} 
							?>
               
						</table>
						 
					  <!-- Pagging -->
					  <div class="pagging">
                
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
