<?php  include("sec.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Votações  -  V.01.beta</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3_offline.css">
 <script type="text/javascript" src="ajax.js"></script>
</head>

<body>

<div class="w3-main" >
    
    <div id="Resultado"><p>
					<?php 
						include("configuracao/escrever.php"); 
						
					     
   if($_GET['acao']=="escrever") {
		
		if($_GET['tipo']=="profissionais") { 
		
			include("configuracao/incorp_escreve_pf.php"); 
		
		}	
	}
	

					 ?></p></div>
    
</div>



<?php include("rodape.php"); ?>

</body>
</html>