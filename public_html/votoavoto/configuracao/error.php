<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header('Content-Type: text/html; charset=utf-8');
?><html>
<head>
<title>Voto a Voto</title>
<?php error_reporting(E_ERROR | E_WARNING | E_PARSE); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://w3.p2hp.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
  <div class="w3-container w3-teal">&nbsp;</div>
  <div class="w3-panel w3-border" >
  <p align="center">  <img src="img/icologo.png" class="w3-circle" alt="Alps" style="width:100%;max-width:100px"></p>
</div>
 
 <div class="w3-container w3-teal">&nbsp;</div>

 
     <p align="center"><b><?php 
	$msg=$_GET['status'];
	if($msg!=NULL) { 
	?>
		<div class="w3-panel w3-card w3-yellow">
		   <?=utf8_encode($msg);?>
		</div>
	<?		
	} ?></b></p>
	<p align="center"><form action="adm.valida.usuario.php" method="post" name="" id="" class="w3-container w3-align-center"> 
	     <label class="w3-text-green">LOGIN</label> <input class="w3-input w3-border" name="FormUsuario" type="text"  id="FormUsuario" value="" style="width:auto"><label class="w3-text-green">SENHA</label> 
      <input class="w3-input w3-border" name="FormSenha" type="password"  id="FormSenha" style="width:auto" maxlength="15" value="">
     <br>
      <input name="FormBotton2" type="submit"  id="FormBotton2" value="Efetuar Login" class="w3-btn w3-green"></form>
	 </p>
   
 <div class="w3-container w3-teal">&nbsp;</div>

<div class="w1-row">
 <p align="center"><b><a href="appvotoavoto/votoavotoSigned.apk">Mobile Voto a Voto</a></b></p>
</div>

<div class="w1-row">
  
<span class="material-symbols-outlined">
support_agent
</span>
         <P align="center"> © Copyright 2018 - 2024 - Attair Silva - <a href="https://wa.me/5565992669978">(65) 99266-9978</a> <br>
  </P>
   
</div>


           
          
</body>
</html>

