<?php

$op=$_GET["op"];
if($op=="") { $op="index"; }
$nar=basename($_SERVER['PHP_SELF'],'.php'); 
$enar=explode('/',$nar);

if($nivel<=11) {	   
				  
	$camc="index.php";
 
			   ?> <a href="<?=$camc?>"  class="w3-bar-item w3-button w3-green">RETORNAR </a>
             <!--  <input type="hidden" name="txtnome0" id="txtnome0" value="<?=$camc?>"/>
                <input type="button" value="&nbsp;&nbsp;INICIO" onclick="getDados(0);" style="border: #000 solid 0px; background-color:transparent; font-size:14px"  class="w3-bar-item w3-button w3-green"/>--> 
               
<?php

	if($enar[0]!='configuracao') { 
	
	$camc="votacao.php";

			   ?>
               <!-- <input type="hidden" name="txtnome1" id="txtnome1" value="<?=$camc?>"/>
                <input type="button" value="&nbsp;&nbsp;VOTAÇÃO" onclick="getDados(1);" style="border: #000 solid 0px; background-color:transparent; font-size:14px"  class="w3-bar-item w3-button w3-green" /> 
     --> 
            
<?php 

	}

}
 ?>