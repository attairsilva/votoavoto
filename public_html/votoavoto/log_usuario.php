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

<div class="w3-card-4">
		<header class="w3-container w3-teal">
		<h1 class="w3-text-white" style="text-shadow:1px 1px 0 #444" > LOG do Usuário</h1>
		</header>
		<div class="w3-container  w3-cursive">
			<h3>	<?php echo $_GET['f'];
							$sp="select * from log where id_usuario='".$idu."' order by data desc";
							$qpr=mysqli_query($conexao,$sp);				
						
						?>
						<table  class="w3-table-all">
                        	<tr>
							  <th  height="1" style="border:1; padding:0"><h4>ID</h4></th>
						      <th  height="1" style="border:1; padding:0"><h4>Usuario e Horario</h4></th>
						      <th  height="1" style=" border:1; padding:0"> 
							  <h4>Ação</h4></th>
							</tr>
							<?php  while($dsp=mysqli_fetch_array($qpr)){ ?>
							<tr>
							  <td  height="1" style="border:1; padding:0"><h4><?php echo $dsp["id"];?></h4></td>
						      <td  height="1" style="border:1; padding:0"><h4><?php
                              $sqlusr=mysqli_fetch_array(mysqli_query($conexao,"select id, usuario,tipo from admin where id='".$dsp['id_usuario']."'"));
							  $datetime = $dsp["data"];
							  $orgdate = date("d/m/Y H:i", strtotime($datetime ));
							  echo $sqlusr["usuario"]." as ".$orgdate.""; 
							  ?></h4></td>
						      <td  height="1" style=" border:1; padding:0"> 
							  <h4> <?php echo  $dsp["acao"] ; ?></h4></td>
						   </tr>
						   <?php }  ?>
                             		
						</table>
			</h3>
		</div>
</div>

</body>
</html>
						
		