<?php 
include("../config.ini.php");
include("../sec.php");
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
<?php if ($_GET[f]=="sim"){ ?>
<script language="JavaScript">
	javascript: setTimeout('window.close()',1)
</script>
<?php } 
 if($_GET[acao]=="limpar"){
 $limpalog= mysqli_query($conexao,"DELETE FROM log");
 ?> <meta http-equiv=refresh content='1; url=log.php?f=sim'> 
 <?php
}
?>
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
					<div align="center">
						<H2>LOG DE REGISTROS DO SISTEMA</H2>
				<br><br><a href="log.php?acao=limpar"  onClick="return confirm('Deseja realmente apagar o LOG? Este processo nao permite recuperacao.')">
			Limpar Log </a><br><br>
					</div>
	        <!-- End Box Head -->	

					<!-- Table -->
		<div><?php echo $_GET[f];
		 $sp="select * from log order by data desc";
		$qpr=mysqli_query($conexao,$sp);				
		
		?></div>		
					<div class="table">
						<table  border="1" cellspacing="0" cellpadding="0" >
                        	<tr>
							  <td  height="1" style="border:1; padding:0">ID</td>
						      <td  height="1" style="border:1; padding:0">Usuario e Horario</td>
						      <td  height="1" style=" border:1; padding:0"> 
							  Ação</td>
						  </tr>
							
	
<?php 

 while($dsp=mysqli_fetch_array($qpr)){
 ?>
							
							<tr>
							  <td  height="1" style="border:1; padding:0"><?php echo $dsp["id"];?></td>
						      <td  height="1" style="border:1; padding:0"><?php
                              $sqlusr=mysqli_fetch_array(mysqli_query($conexao,"select id, usuario,tipo from admin where id='".$dsp[id_usuario]."'"));
							  $datetime = $dsp["data"];
							  $orgdate = date("d/m/Y H:i", strtotime($datetime ));
							  echo $sqlusr["usuario"]." as ".$orgdate.""; 
							  ?></td>
						      <td  height="1" style=" border:1; padding:0"> 
							  <?php echo  $dsp["acao"] ; ?></td>
						  </tr>
							
							<?php 
							
							} 
							
							?>
                             		
						</table>
						
					
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