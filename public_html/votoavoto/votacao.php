﻿<?php
include("config.ini.php");
include("sec.php");
if($ftipo==NULL) {
	$ftipo="crefito";
}

?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>VOTO A VOTO </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="W3.css">
 <script type="text/javascript" src="ajax.js"></script>
<script>
function limpa() {
if(document.getElementById('busca').value!="") {
document.getElementById('busca').value="";
document.getElementById('busca').focus();
}
}
</script>
<script src="js/jquery-3.2.1.slim.min.js"></script>
</head>

<body>
<?php 
$busca=$_POST["busca"];
if($busca==NULL) { 
	$busca=$_GET["busca"];
}
?>
<!--
 <div class="w3-teal">
     <div class="w3-container">
       <?php //include("barramenu_v2.php");?>
      </div>
	  <div class="w3-green">

		</div> 
</div> -->

<div class="w3-green">
<div class="w3-bar w3-border w3-light-grey">
  <?php //include("barramenu2.php");?>
</div>
</div> 

<div class="w3-container">
   <div class="w3-panel w3-leftbar w3-light-grey">
  <p class="w3-xlarge w3-serif">Sessão destinada a leitura de etiquetas.</p></div>
  <div>		

<?php if($sqldv['id_inscricao']=="") { ?>	




  <form  name="form1" id="form1" method="post"  action="votacao_acao.php"  autocomplete="off">

<div class="w3-panel w3-withe w3-card-4">
  <p>
    <header class="w3-container w3-teal">
     <h1>LOCALIZAR</h1>
     </header></p>
	 <p>


<input class="w3-radio" type="radio" name="ftipo" value="crefito" <? if ($ftipo=="crefito") { echo "checked"; } ?>>
<label class="w3-text-teal">Código de Barras ou INSCRIÇÃO</label>

<input class="w3-radio" type="radio" name="ftipo" value="nome" <? if ($ftipo=="nome") { echo "checked"; } ?>>
<label class="w3-text-teal">Nome</label> 

 <input name="busca"  style="width:auto" type="text"  id="busca" value="" autofocus  tabindex=1 autocomplete="off"   />

 <input type="submit" name="button2" id="button2" value="Procurar"  class="w3-btn w3-teal w3-round-xxlarge" tabindex=2 />
 <input type="button" value="Limpa" class="w3-btn w3-teal w3-round-xxlarge" onClick="limpa()" >
 <p><input name="regaut" type="checkbox" style="width:auto" id="regaut" value="sim" checked/>&nbsp;Confirmar automático despois de alguns segundos
</p><? if($busca!=NULL) { ?>
<div class="w3-panel w3-leftbar w3-light-grey">
  <p class="w3-xlarge w3-serif">
   <i>Último dado procurado foi: <font color=red><?=$busca;?></font></i>
   </div><? } ?>
  </div>

 
</form>

</div>

  
         
     </div>             
</div>
  <?php
}

if($_GET['log']!=NULL){
	$msglog="";
	$msglog="Usuario [".$adm_usuario."] cancelou a confirmação de leitura para: [".$_GET['log']."]";
	$datalog=date('Y-m-d H:i:s');
	$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
	VALUES('$idu','$msglog','$datalog')");
}
	

?>
</div>


</div> 
	<script>
			document.forms['form1'].elements['busca'].focus();
			 $(document).ready(function(){
    			setTimeout("try{document.getElementById( 'form1' ).focus();}catch(error){}",100);
    		 });
    </script>
</body></html>