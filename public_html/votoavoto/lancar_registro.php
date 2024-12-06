<?php
include("config.ini.php");
include("sec.php");
 if ($ftipo==""){
	  $ftipo="endereco"; 
 }
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>VOTO A VOTO - CREFITO</title>
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
       <?php // include("barramenu_v2.php");?>
      </div>
	  <div class="w3-green">

		</div> 
</div> 
-->
<div class="w3-green">
<div class="w3-bar w3-border w3-light-grey">
  <?php //include("barramenu2.php");?>
</div>
</div> 
<div class="w3-container">
  <div class="w3-panel w3-leftbar w3-light-grey">
  <p class="w3-xlarge w3-serif">Sessão destinada a lançamento de um registro no banco</p></div>
  
  <div>	



  <form  name="form1" id="form1" method="post"  action="lancar_registro_acao.php"  autocomplete="off">

<div class="w3-panel w3-withe w3-card-4">
  <p>
    <header class="w3-container w3-teal">
     <h1>NOVO REGISTRO</h1>
     </header></p>
	 <p>


 <p>
<label class="w3-text-teal">Nome</label>
<input   type="text" name="fnome" autofocus autocomplete="off" tabindex=2 id="fnome" style="width:100%">
 </p>
  <p>
<label class="w3-text-teal">Cód. Barras ou INSCRIÇÃO</label> 
<input  style="width:auto" type="text" name="finscricao" tabindex=2 autocomplete="off" id="finscricao">
 </p>
<input type="submit" name="button2" id="button2" value="Gravar"  class="w3-btn w3-teal w3-round-xxlarge" tabindex=2 />
 <input type="button" value="Limpa" class="w3-btn w3-teal w3-round-xxlarge" onClick="limpa()" >
 
 
<div class="w3-panel w3-leftbar w3-light-grey">
  <p class="w3-xlarge w3-serif">
   <i>Utilize em caso de registro não encontrado, desde que tenha certeza que o dado está consistente.</font></i>
   </div>
  </div>

 
</form>

</div>

</div>



	<script>
			document.forms['form1'].elements['busca'].focus();
			 $(document).ready(function(){
    			setTimeout("try{document.getElementById( 'form1' ).focus();}catch(error){}",100);
    		 });
    </script>
</body></html>
