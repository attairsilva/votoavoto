<?php

$op=$_GET["op"];
if($op=="") { $op="index"; }
$nar=basename($_SERVER['PHP_SELF'],'.php'); 
$enar=explode('/',$nar);
//echo "==>".$enar[0];
?>
<div class="w3-bar">
   <div class="w3-bar-item">
       <p>  <img src="../img/icologo.png" class="w3-circle" alt="Alps" style="width:100%;max-width:50px"></p>
      </div>
      <div class="w3-bar-item"> 
            <? $camc="../index.php"; ?>
            <button class="w3-btn  w3-border w3-border-black w3-green w3-xlarge w3-bar-item w3-button w3-mobile  " onclick="window.location.href='<?=$camc?>'">Início<i class="w3-margin-left material-icons">home</i></button>
            <? $camc="index.php"; ?>
            <button class="w3-btn  w3-border w3-border-black w3-green w3-xlarge w3-bar-item w3-button w3-mobile  " onclick="window.location.href='<?=$camc?>'">Principal<i class="w3-margin-left material-icons">home</i></button><button class="w3-btn  w3-border w3-border-black w3-green w3-xlarge w3-bar-item w3-button w3-mobile  " onclick="window.location.href='index.php?acao=chapa'" >Chapas</button>
            <button class="w3-btn  w3-border w3-border-black w3-green w3-xlarge w3-bar-item w3-button w3-mobile  "  onclick="window.location.href='index.php?acao=comissao'">Comissão</button>
            <button class="w3-btn  w3-border w3-border-black w3-green w3-xlarge w3-bar-item w3-button w3-mobile  " onclick="window.location.href='?op=mesa'">Mesas</button>
            <button class="w3-btn  w3-border w3-border-black w3-green w3-xlarge w3-bar-item w3-button w3-mobile  "  onclick="window.location.href='?op=computo'">Computo</button>
    <? $dadouser=mysqli_fetch_array(mysqli_query($conexao,"SELECT id, usuario FROM admin WHERE id='$idu'"));
      $camc="../log_usuario.php";
    ?> 
              <input type="hidden" name="txtnome11" id="txtnome11" value="<?=$camc?>"/>
              <input type="button"  class="w3-btn  w3-border w3-border-black w3-green w3-xlarge w3-bar-item w3-button w3-mobile  "  value="Log" onclick="getDados(11);" />		
                        
           <!-- <button class="w3-btn  w3-border w3-border-black w3-green w3-xlarge w3-bar-item w3-button w3-mobile  "  onclick="window.location.href='<?=$camc?>'">Log<i class="w3-margin-left material-icons">wysiwyg</i></button>-->
            <? $camc="../logout.php"; ?> 
            <button class="w3-btn  w3-border w3-border-black w3-green w3-xlarge w3-bar-item w3-button w3-mobile  "  onclick="window.location.href='<?=$camc?>'"  >Sair<i class="w3-margin-left material-icons">logout</i></button>
           
    </div>
   
  </div>




