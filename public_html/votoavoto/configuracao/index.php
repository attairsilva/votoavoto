<?php  include("sec.php"); ?>


<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Votações  -  V.01.beta</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/w3_offline.css">
 <script type="text/javascript" src="../ajax.js"></script>
 <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
 <style>
h1{font-size:34px;}
h2{font-size:28px;}
h3{font-size:16px;}
h4{font-size:14px;}
h5{font-size:12px;}
h6{font-size:10px;}
.material-icons {vertical-align:-14%}
 </style>
</head>

<body>

<div class="w3-main" >

 <div class="w3-teal">
     <div class="w3-container">
       <?php include("barramenu_configuracao.php");?>
      </div>
</div> 
    			<?php
 
	include("incorp_postar_arquivo.php");
 ?>
    <div id="Resultado"  style="height: 100vh;"><p>
		</p></div>
    
</div>



<?php include("../rodape.php"); ?>

</body>
</html>