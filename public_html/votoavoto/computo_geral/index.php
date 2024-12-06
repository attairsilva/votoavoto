<?php  include("sec.php"); ?>


<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Votações  -  V.01.beta</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/w3_offline.css">
<link rel="stylesheet" href="../css/font-awesome.min.css">
 <script type="text/javascript" src="../ajax.js"></script>
 <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>

<div class="w3-main" >

<div class=" w3-mobile ">
     	<div class="w3-container w3-teal ">
          <?php include("barramenu_configuracao.php");?>
        </div>
 </div> 
    
    <div id="Resultado" style="height: 100vh;">
					<?php
				
							if($_GET['op']==NULL) { 
								include("principal.php");
							}if($_GET['op']=="computo") { 
								include("computo.php");
							}if($_GET['op']=="mesa") { 
								include("mesa.php");
							}
					?></div>
    
</div>



<?php include("../rodape.php"); ?>

</body>
</html>