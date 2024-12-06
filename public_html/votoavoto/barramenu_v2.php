<?php

$op=$_GET["op"];
if($op=="") { $op="index"; }
$nar=basename($_SERVER['PHP_SELF'],'.php'); 
$enar=explode('/',$nar);
//echo "==>".$enar[0];
?>
<div class="w3-bar">
  <div class="w3-bar-item">
       <p>  <img src="img/icologo.png" class="w3-circle" alt="Alps" style="width:100%;max-width:50px"></p>
  </div>
  <div class="w3-bar-item"> 
 
               <? $camc="index.php"; ?>
               <button class="w3-btn w3-green  w3-border w3-border-black w3-xlarge w3-bar-item w3-button w3-mobile  " onclick="window.location.href='<?=$camc?>'">Inicio<i class="w3-margin-left material-icons">home</i></button>
          
              <? $camc="votacao.php"; ?>
	            <input type="hidden" name="txtnome2" id="txtnome2" value="<?=$camc?>"/>
              <button class="w3-btn w3-green  w3-border w3-border-black w3-xlarge w3-bar-item w3-button w3-mobile " onclick="getDados(2);">Código<i class="w3-margin-left material-icons">search</i></button>						
             
              <? $camc="endereco.php"; ?>  
              <input type="hidden" name="txtnome3" id="txtnome3" value="<?=$camc?>"/>
              <button  class="w3-btn w3-green  w3-border w3-border-black w3-xlarge w3-bar-item w3-button w3-mobile  "  value="Endereço" onclick="getDados(3);">Endereço<i class="w3-margin-left material-icons">search</i></button>		
            
              <? $camc="relatorio.php"; ?> 	
              <input type="hidden" name="txtnome4" id="txtnome4" value="<?=$camc?>"/>
              <input type="button"  class="w3-btn  w3-border w3-border-black w3-green w3-xlarge w3-bar-item w3-button w3-mobile  "  value="Computados" onclick="getDados(4);" />		
  
  <? if($nivel==10) { ?> 
 

              
            <div class="w3-dropdown-hover w3-mobile w3-green w3-border w3-border-black w3-round-largen " >

              <button class="w3-btn w3-green  w3-border w3-border-black w3-xlarge w3-bar-item w3-button w3-mobile  ">Administrador<i class="fa fa-caret-down" ></i></button>
             
              <div class="w3-dropdown-content w3-bar-block w3-dark-grey">
                    <?  
                    $camc="computo_geral"; ?>	
                   <a href="<?=$camc?>" class="w3-bar-item w3-button w3-mobile">  &nbsp;&nbsp;ATA DE COMPUTO GERAL</a>
                    <? $camc="relatorio_pormesa.php"; ?> 
                    <!-- <a href="<?=$camc?>"  class="w3-bar-item w3-button w3-mobile" target="_blank">RELATORIO VOTANTES</a>-->
                    <input type="hidden" name="txtnome5" id="txtnome5" value="<?=$camc?>"/>
                      <input type="button"  value="&nbsp;&nbsp;RELAÇÃO REGISTRADO" onclick="getDados(5);"       class="w3-bar-item w3-button w3-mobile"/>								
                    <? $camc="relatorio_geral.php"; ?> 
                    <!--<a href="<?=$camc?>" class="w3-bar-item w3-button w3-mobile" target="_blank">LISTA GERAL</a>-->
                    <input type="hidden" name="txtnome6" id="txtnome6" value="<?=$camc?>"/>
                      <input type="button"  value="&nbsp;&nbsp;RELAÇÃO GERAL" onclick="getDados(6);"      class="w3-bar-item w3-button w3-mobile"/>								
                    <? $camc="relatorio_nao.php"; ?>
                    <input type="hidden" name="txtnome7" id="txtnome7" value="<?=$camc?>"/>
                      <input type="button"  value="&nbsp;&nbsp;RELAÇÃO NÃO REGISTRADO" onclick="getDados(7);"     class="w3-bar-item w3-button w3-mobile"/>							
                    <?php 
                    $camc="relatorio_duplicados.php";
                    ?>        
                    <input type="hidden" name="txtnome8" id="txtnome8" value="<?=$camc?>"/>
                      <input type="button"  value="&nbsp;&nbsp;RELAÇÃO DUPLICADOS" onclick="getDados(8);"      class="w3-bar-item w3-button w3-mobile "/> 

                 <!-- <? $camc="relatorio_comparativo.php"; ?>
                    <input type="hidden" name="txtnome9" id="txtnome9" value="<?=$camc?>"/>
                      <input type="button"  value="&nbsp;&nbsp;RELATORIO COMPARATIVO" onclick="getDados(9);"     class="w3-bar-item w3-button w3-mobile"/>	
  --> 
                  <? $camc="lancar_registro.php"; ?>
                    <input type="hidden" name="txtnome10" id="txtnome10" value="<?=$camc?>"/>
                    <input type="button"  value="&nbsp;&nbsp;LANÇAR REGISTRO" onclick="getDados(10);"     class="w3-bar-item w3-button w3-mobile"/>	
                    <?  
                    $camc="configuracao"; ?>	
                  <a href="<?=$camc?>" class="w3-bar-item w3-button w3-mobile">  &nbsp;CONFIGURAÇÃO</a>
                    <!-- <input type="hidden" name="txtnome11" id="txtnome11" value="<?=$camc?>"/>
                    <input type="button"  value="&nbsp;&nbsp;CONFIGURAÇÃO" onclick="getDados(11);"    class="w3-bar-item w3-button w3-mobile"/> -->
               </div>
          </div>


 <? } 
?>
 <? $dadouser=mysqli_fetch_array(mysqli_query($conexao,"SELECT id, usuario FROM admin WHERE id='$idu'"));
     $camc="log_usuario.php";
   ?> 
              <input type="hidden" name="txtnome11" id="txtnome11" value="<?=$camc?>"/>
              <input type="button"  class="w3-btn  w3-border w3-border-black w3-green w3-xlarge w3-bar-item w3-button w3-mobile  "  value="Log" onclick="getDados(11);" />		
              <!--<button class="w3-btn w3-green  w3-border w3-border-black w3-xlarge w3-bar-item w3-button w3-mobile  "  onclick="window.location.href='<?=$camc?>'">Log<i class="w3-margin-left material-icons">wysiwyg</i></button>-->
    
              <? $camc="logout.php"; ?> 
    <button class="w3-btn w3-green  w3-border w3-border-black w3-xlarge w3-bar-item w3-button w3-mobile  "  onclick="window.location.href='<?=$camc?>'"  >Sair<i class="w3-margin-left material-icons">logout</i></button>
 
    </div>
 

 </div>


