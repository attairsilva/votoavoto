<?php

$op=$_GET["op"];
if($op=="") { $op="index"; }
$nar=basename($_SERVER['PHP_SELF'],'.php'); 
$enar=explode('/',$nar);
//echo "==>".$enar[0];
if($nivel<=11) {	   
				  
	$camc="index.php";
 
			   ?> <a href="<?=$camc?>"  class="w3-bar-item w3-button w3-green">INICIO </a>
             <!--  <input type="hidden" name="txtnome0" id="txtnome0" value="<?=$camc?>"/>
                <input type="button" value="&nbsp;&nbsp;INICIO" onclick="getDados(0);" style="border: #000 solid 0px; background-color:transparent; font-size:14px"  class="w3-bar-item w3-button w3-green"/>--> 
               
<?php

	if($enar[0]!='configuracao') { 
	$camc="votacao.php";
//echo '==>'.$camc;
			   ?>
               <!-- <input type="hidden" name="txtnome1" id="txtnome1" value="<?=$camc?>"/>
                <input type="button" value="&nbsp;&nbsp;VOTAÇÃO" onclick="getDados(1);" style="border: #000 solid 0px; background-color:transparent; font-size:14px"  class="w3-bar-item w3-button w3-green" /> 
     --> <a href="<?=$camc?>" class="w3-bar-item w3-button w3-green">REGISTRAR VOTO</a>
            
   
<?php

 $camc="relatorio_pormesa.php";
//echo '==>'.$camc;
			   ?> <a href="<?=$camc?>" class="w3-bar-item w3-button w3-green" target="_blank">RELATORIO VOTANTES</a>
               <!-- <input type="hidden" name="txtnome2" id="txtnome2" value="<?=$camc?>"/>
                <input type="button"  value="&nbsp;&nbsp;COMPUTADOS" onclick="getDados(2);" style="border: #000 solid 0px; background-color:transparent; font-size:14px"  class="w3-bar-item w3-button w3-green" /> 
			   -->
<?php

 $camc="relatorio_geral.php";
//echo '==>'.$camc;
			   ?> <a href="<?=$camc?>" class="w3-bar-item w3-button w3-green" target="_blank">RELATORIO GERAL</a>
               <!-- <input type="hidden" name="txtnome2" id="txtnome2" value="<?=$camc?>"/>
                <input type="button"  value="&nbsp;&nbsp;COMPUTADOS" onclick="getDados(2);" style="border: #000 solid 0px; background-color:transparent; font-size:14px"  class="w3-bar-item w3-button w3-green" /> 
			   -->
<?php $camc="relatorio.php";
//echo '==>'.$camc;
			   ?> <!--<a href="<?=$camc?>" class="w3-bar-item w3-button">COMPUTADOS</a>-->
                <input type="hidden" name="txtnome2" id="txtnome2" value="<?=$camc?>"/>
                <input type="button"  value="&nbsp;&nbsp;COMPUTADOS" onclick="getDados(2);" style="border: #000 solid 0px; background-color:transparent; font-size:14px"  class="w3-bar-item w3-button w3-green" /> 
			
<?php

	}

}
   
if($nivel==10) { 

 	 $camc="relatorio_nao.php";

			   ?><!--<a href="<?=$camc?>" class="w3-bar-item w3-button" target="_blank">NÃO COMPUTADOS</a>-->
                <input type="hidden" name="txtnome3" id="txtnome3" value="<?=$camc?>"/>
                <input type="button"  value="&nbsp;&nbsp;NÃO COMPUTADOS" onclick="getDados(3);" style="border: #000 solid 0px; background-color:transparent; font-size:14px"   class="w3-bar-item w3-button w3-green"/> 
<?php   $camc="relatorio_duplicados.php";

			   ?><!--<a href="<?=$camc?>" class="w3-bar-item w3-button" target="_blank">NÃO COMPUTADOS</a>-->
                <input type="hidden" name="txtnome4" id="txtnome4" value="<?=$camc?>"/>
                <input type="button"  value="&nbsp;&nbsp;DUPLICADOS" onclick="getDados(4);" style="border: #000 solid 0px; background-color:transparent; font-size:14px"   class="w3-bar-item w3-button w3-green"/> 
<?php          $camc="configuracao.php";
			 ?><a href="<?=$camc?>"  class="w3-bar-item w3-button w3-green">CONFIGURAÇÃO</a>
              <!--<input type="hidden" name="txtnome4" id="txtnome4" value="<?=$camc?>"/>
                <input type="button"  value="&nbsp;&nbsp;CONFIGURAÇÃO" onclick="getDados(4);" style="border: #000 solid 0px; background-color:transparent; font-size:14px"  class="w3-bar-item w3-button w3-green" />--> 
             
<?php 
} 
  $camc="logout.php";

			   ?><!--<a href="<?=$camc?>" class="w3-bar-item w3-button">SAIR</a>-->
                <input type="hidden" name="txtnome5" id="txtnome5" value="<?=$camc?>"/>
                <input type="button"  value="&nbsp;&nbsp;SAIR" onclick="getDados(5);" style="border: #000 solid 0px; background-color:transparent; font-size:14px"  class="w3-bar-item w3-button w3-green"/>     
                
    <?php
    $dadouser=mysqli_fetch_array(mysqli_query($conexao,"
    SELECT id, usuario FROM admin WHERE id='$idu'"));
    echo  "Logado como: ".$dadouser[usuario];
    ?>
