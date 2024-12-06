<?php

$op=$_GET["op"];
if($op=="") { $op="index"; }
$nar=basename($_SERVER['PHP_SELF'],'.php'); 
$enar=explode('/',$nar);
//echo "==>".$enar[0];
//echo $idu;
?>

<div class="w3-bar w3-mobile">
    <div class="w3-bar-item">
       <p>  <img src="../img/icologo.png" class="w3-circle" alt="Alps" style="width:100%;max-width:50px"></p>
      </div>

    <div class="w3-bar-item"> 
        
        <? $camc="../index.php"; ?>
        <p><button class="w3-btn  w3-border w3-border-black w3-green w3-xlarge w3-bar-item w3-button w3-mobile  " onclick="window.location.href='<?=$camc?>'">Início<i class="w3-margin-left material-icons">home</i></button>
        
        <? $camc="index.php"; ?>
        <button class="w3-btn  w3-border w3-border-black w3-green w3-xlarge w3-bar-item w3-button w3-mobile  " onclick="window.location.href='<?=$camc?>'">Principal<i class="w3-margin-left material-icons">home</i></button> 
        
    <? 
    
     // Consulta segura com prepared statements
 
     $sql = "SELECT id, usuario FROM admin WHERE id=  ? ";
     $stmt = $conexao->prepare($sql);
     if ($stmt === false) {
			die("Erro na preparação da query: " . $conexao->error);
		} 
     $stmt->bind_param("s", $iddu);
     $iddu=$idu;
     $stmt->execute();
     $result = $stmt->get_result();
 
     // Verifica o resultado
     if ($result->num_rows > 0) {
         $dados = $result->fetch_assoc();
     }
     $camc="../log_usuario.php";
   ?> 
     
     <input type="hidden" name="txtnome11" id="txtnome11" value="<?=$camc?>"/>
    <input type="button"  class="w3-btn  w3-border w3-border-black w3-green w3-xlarge w3-bar-item w3-button w3-mobile  "  value="Log" onclick="getDados(11);" />		
               <? $camc="../logout.php";    ?> 
       <button class="w3-btn  w3-border w3-border-black w3-green w3-xlarge w3-bar-item w3-button w3-mobile  " onclick="window.location.href='<?=$camc?>'">Sair<i class="w3-margin-left material-icons">logout</i></button> 
     
    </div>
</div>
	
 



