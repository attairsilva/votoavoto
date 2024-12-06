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
						<H2>ENVELOPE DE VOTOS NÃO LIDOS</H2>
				
					</div>
	        <!-- End Box Head -->	

					<!-- Table -->
				
					<div class="table">
						<table  cellspacing="0" cellpadding="0" >
                        
	
							<?php 

	// verifica a pagina aberta setada
	$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

	// contando o total de registros
	$contasql= mysqli_query($conexao,"select id_inscricao,nome,crefito,votou,forma,id_usuario,data_horario from profissionais WHERE votou='nao'");
	$total= mysqli_num_rows($contasql);
	
	// qtd de registros por pagina
	$registros = 100;
	
	// calculando numero de paginas por resultado e arredondando para cima
	$numPaginas = ceil ($total/$registros);					
	
	// calcula o inicio da visualização com base na pagina atual
	$inicio = ($registros*$pagina)-$registros;

	$sqlp=" select id_inscricao,nome,crefito,votou,forma,id_usuario,data_horario 
	from profissionais WHERE votou='nao'
	 order by nome  limit $inicio, $registros";

	?>
	<tr>
	<td width="1%" height="1" style="background:<?=$cor?>; border:0; padding:0">
	</td>
		<td colspan="2" width="66%" height="1" style="background:<?=$cor?>; border:0; padding:0"><b><font color="#000000"><b><?=$total?></b> não recebido</font></b>
	<br><b>Páginas: </b>  
<?php
for($i=1; $i < $numPaginas + 1; $i++){
	?>
	<input type="hidden" name="txtnome3<?=$i?>" id="txtnome3<?=$i?>" 
	value="relatorio_nao.php?pagina=<?=$i?>"/>
	<input type="button"  value="<?=$i?>" onclick="getDados(3<?=$i?>);" style="border: #000 solid 0px; background-color:transparent; font-size:10px"  class="w3-bar-item w3-button w3-green" />&nbsp;
	<?php 
	
}
?>
</td>
		
</tr>
	<?php
			$qprocessos=mysqli_query($conexao,$sqlp);				
			if(!$qprocessos) { echo 'Erro!'; }
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
