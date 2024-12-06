<?php  include("sec.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Votações  -  V.01.beta</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="W3.css">
 <script type="text/javascript" src="ajax.js"></script>
</head>

<body>
 <div class="w3-teal">
 &nbsp; 
</div> 
<div class="w3-bar w3-border w3-light-grey">
  <? include("barramenu.php");?>
</div>

<div class="w3-main" >

    <div class="w3-teal">
     <!-- <button class="w3-button w3-teal w3-xlarge w3-left" onclick="w3_open()">&#9776;</button>-->
      <div class="w3-container">
        <h1>VOTO A VOTO</h1> 
      </div>
    </div> 
    
    <div id="Resultado"><?=include("votacao_acao.php");?></div>
    
</div>



<? include("rodape.php"); ?>

</body>
</html>