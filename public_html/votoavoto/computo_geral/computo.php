<?php 
include("functions.php");
$ssum= "SELECT id, mesa FROM admin WHERE id='$idu'";
$dssum=mysqli_fetch_array(mysqli_query($conexao,$ssum));
?>
<div class="w3-container" style="80%">
 <?
 if($_GET['acao']=="apagarcomputo"){
	  $idc=$_GET['idc'];
	  $epovt= "DELETE FROM ata_computo_geral WHERE id='$idc'";
	  $povt=mysqli_query($conexao,$epovt);
			if(!$povt) {
				 $msg=$msg."<br><font color=red>Erro ao apagar computo geral: ".mysqli_error($querys)."</font><br><br>"; 
				$lognot="Erro ao apagar computo geral";
			}else{
				$msg=$msg."<br>Computo apagado com sucesso!</font><br><br>"; 
				$lognot="Computo apagado com sucesso!";
			}
		//iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','$lognot','$datalog')");
			//fimlog
  }  

  if($_GET['acao']=="cadastrarcomputog_act"){
	  
	  $computo_crefito=$_POST['computo_crefito'];
	  $computo_urnas=$_POST['computo_urnas'];
	  $computo_data=$_POST['computo_data'];
	  $computo_hora=$_POST['computo_hora'];
	  $computo_municipio=$_POST['computo_municipio'];
	  $computo_uf=$_POST['computo_uf'];
	  $computo_quadrienio_n1=$_POST['computo_quadrienio_n1'];
	  $computo_quadrienio_n2=$_POST['computo_quadrienio_n2'];
	  $idc=$_POST['idc'];
	  $dta=$computo_data.' '.$computo_hora;


	  $inq= mysqli_query($conexao,"INSERT ata_computo_geral set
				crefito='$computo_crefito', 
				data='$dta',
				municipio='$computo_municipio',
				estado='$computo_uf',
				quadrienio_n1='$computo_quadrienio_n1',
				quadrienio_n2='$computo_quadrienio_n2',
				qtd_urnas='$computo_urnas'			
				");
	   if(!$inq) {
				 $msg=$msg."<br><font color=red>Erro ao registrar Ata Computo Geral: ".mysqli_error($conexao)."</font><br><br>"; 
				$lognot="Erro ao editar Ata Computo Geral";
			}else{
				$msg=$msg."<br>Computo Registrado!</font><br><br>"; 
				$lognot="Computo registrado!";
			}
	
		//iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','$lognot','$datalog')");
			//fimlog
  }
  
  if($_GET['acao']=="editarcomputog_act"){
	$computo_crefito=$_POST['computo_crefito'];
	$computo_crefitod=$_POST['computo_crefitod'];
	  $computo_urnas=$_POST['computo_urnas'];
	  $computo_data=$_POST['computo_data'];
	  $computo_hora=$_POST['computo_hora'];
	  $computo_municipio=$_POST['computo_municipio'];
	  $computo_uf=$_POST['computo_uf'];
	  $computo_quadrienio_n1=$_POST['computo_quadrienio_n1'];
	  $computo_quadrienio_n2=$_POST['computo_quadrienio_n2'];
	  $idchapaeleita=$_POST['idchapaeleita'];
	  $idc=$_POST['idc'];
	  $dta=$computo_data.' '.$computo_hora;
	  $computo_horafim=$_POST['computo_horafim'];

	  $inq= mysqli_query($conexao,"UPDATE ata_computo_geral set
				crefito='$computo_crefito', 
				crefitod='$computo_crefitod', 
				data=' $dta',
				municipio='$computo_municipio',
				estado='$computo_uf',
				quadrienio_n1= '$computo_quadrienio_n1',
				quadrienio_n2='$computo_quadrienio_n2',
				qtd_urnas='$computo_urnas',
				id_chapaeleita='$idchapaeleita',
				data_hora_fim='$computo_horafim'	
				WHERE id='$idc'");
	   if(!$inq) {
				 $msg=$msg."<br><font color=red>Erro ao editar Ata Computo Geral: ".mysqli_error($conexao)."</font><br><br>"; 
				$lognot="Erro ao editar Ata Computo Geral";
			}else{
				$msg=$msg."<br>Computo Editado!</font><br><br>"; 
				$lognot="Computo editado!";
			}
	
		//iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','$lognot','$datalog')");
			//fimlog
  }
 
   

 if($msg!=NULL) { ?>
	<div  id="id00" class="w3-panel   w3-light-grey  w3-display-container" style="display:block;  width: 50%">
	  <p>
	  <?php print(utf8_encode($msg)); ?>
	  </p>
	</div>
<? 
}

 if($_GET['acao']=='editarcomputo') {
		$idc=$_GET['idc'];
	    $epovt= "SELECT * FROM ata_computo_geral WHERE id='".$idc."'";
		$dpovt=mysqli_fetch_array(mysqli_query($conexao,$epovt));
		$dtn=$dpovt['data'];
		$ddt=explode(' ',$dtn);
		$ddtd=$ddt[0];
		$ddth=$ddt[1];
	?>
	<div id="id11" class="w3-panel   w3-light-grey  w3-display-container" style="display:block;  width:  <?=$perc?>">
  
		 <br><br> 
				<br><br><br>
				<div class="w3-container w3-teal">
				 <h2>Editar Computo</h2><p>
				</p>
				</div>
				 <form name="formenvia" method="post" action="index.php?op=computo&acao=editarcomputog_act" enctype="multipart/form-data" class="w3-container">   
				  <br> <input type="hidden" name="idc" id="idc" value="<?=$idc?>">
				  <label class="w3-text-teal"><b>Eleições do Regional:</b></label>
					<input type="number" name="computo_crefito" id="computo_crefito" style=" width: 20%" value="<?=$dpovt['crefito']?>"> 
					   <br>  <br> <label class="w3-text-teal"><b>Desmembrado de:</b></label>
					<input type="number" name="computo_crefitod" id="computo_crefitod" style=" width: 20%" value="<?=$dpovt['crefitod']?>"> (Quando for o caso)
					   <br>  <br>
					   <label class="w3-text-teal"><b>Qtd. de Mesas / Urnas:</b></label>
					<input type="number" name="computo_urnas" id="computo_urnas" style=" width: 10%" value="<?=$dpovt['qtd_urnas']?>"> 
					   <br>  <br>
					<label class="w3-text-teal"><b>Quadriênio: </b></label>
					De <input type="text" name="computo_quadrienio_n1"id="computo_quadrienio_n1" style=" width: 80px" value="<?=$dpovt['quadrienio_n1']?>"> 
					a <input type="text" name="computo_quadrienio_n2"id="computo_quadrienio_n2" style=" width: 80px" value="<?=$dpovt['quadrienio_n2']?>"> 
					<br>  <br>
				   <label class="w3-text-teal"><b>Data / Hora de Início da Ata de Apuração Geral: </b></label>
					 <input type="date" name="computo_data"id="computo_data" style=" width: 100px" value="<?=$ddtd?>" > 
					/ <input type="time" name="computo_hora"id="computo_hora" style=" width: 100px" value="<?=$ddth?>"> 
					<br>  <br>
				   <label class="w3-text-teal"><b>Hora Final Ata de Apuração Geral: </b></label>
					<input type="time" name="computo_horafim"id="computo_horafim" style=" width: 100px" value="<?=$dpovt['data_hora_fim']?>"> 
				   <br>  <br>
				   <label class="w3-text-teal"><b>Local da apuração (Município/UF): </b></label>
					 <input type="text" name="computo_municipio"id="computo_municipio" style=" width: 100px" value="<?=$dpovt['municipio']?>"> 
					/ <input type="text" name="computo_uf"id="computo_uf" style=" width: 100px" value="<?=$dpovt['estado']?>"> 
				   <br>  <br>
				   <label class="w3-text-teal"><b>Vencedor: </b></label>
				   <select class="w3-select" name="idchapaeleita" id="idchapaeleita"> 
				   <option value="0" <? if($dpovt['id_chapaeleita']==0){ echo "selected"; } ?>>--------------------------------------------------</option>
   					<? $selc= "SELECT id, numero, descricao FROM chapas ORDER BY numero";
						$dmc=mysqli_query($conexao,$selc);
						while($lsc=mysqli_fetch_array($dmc)){
			 			?>
			   				<option value="<?=$lsc['id']?>" <? if($dpovt['id_chapaeleita']==$lsc['id']){ echo "selected"; } ?>>Chapa Nº <?=$lsc['numero']?> - <?=$lsc['descricao']?>  </option>
						<? 
						} ?>
 					</select>  
					 <br>  <br>
				 <input type="submit" name="Submit" value="Editar" class="w3-btn w3-blue-grey">
		 
		 </form><br>
	</div>
	<?

  
  }  if($_GET['acao']=='novocomputo') {
	  
 
	?>
	<div id="id11" class="w3-panel   w3-light-grey  w3-display-container" style="display:block;  width:  <?=$perc?>">
  
		 <br><br><br>
				<div class="w3-container w3-teal">
				 <h2>Novo Computo</h2><p>
				</p>
				</div>
				 <form name="formenvia" method="post" action="index.php?op=computo&acao=cadastrarcomputog_act" enctype="multipart/form-data" class="w3-container">   
				  <br> <input type="hidden" name="idc" id="idc" value="<?=$_GET['idc']?>">
					 <label class="w3-text-teal"><b>Eleições do Regional:</b></label>
					<input type="number" name="computo_crefito" id="computo_crefito" style=" width: 20%"> 
					<br>  <br>
					   <label class="w3-text-teal"><b>Qtd. de Mesas / Urnas:</b></label>
					<input type="number" name="computo_urnas" id="computo_urnas" style=" width: 10%" value="0"> 
					    <br>  <br>
					<label class="w3-text-teal"><b>Quadriênio: </b></label>
					De <input type="text" name="computo_quadrienio_n1"id="computo_quadrienio_n1" style=" width: 80px" > 
					a <input type="text" name="computo_quadrienio_n2"id="computo_quadrienio_n2" style=" width: 80px" > 
				   <br>  <br>
				   <label class="w3-text-teal"><b>Data / Hora da Ata de Apuração Geral: </b></label>
					 <input type="date" name="computo_data"id="computo_data" style=" width: 100px" > 
					/ <input type="time" name="computo_hora"id="computo_hora" style=" width: 100px"> 
				   <br>  <br>
				   <label class="w3-text-teal"><b>Local da apuração (Município/UF): </b></label>
					 <input type="text" name="computo_municipio"id="computo_municipio" style=" width: 100px" > 
					/ <input type="text" name="computo_uf"id="computo_uf" style=" width: 100px" > 
				   <br>  <br>
				   
				 <input type="submit" name="Submit" value="Gravar" class="w3-btn w3-blue-grey">
		 
		 </form>
	</div>
	<?

  } 

 if($_GET['acao']=='') {
	?>
	<div id="id11" class="w3-panel   w3-light-grey  w3-display-container" style="display:block;  width:  <?=$perc?>">
  
		 <br>
				<div class="w3-container w3-teal">
					<h2>Computo Geral</h2>
				</div>
				
				 <div class="w3-card-4">
					 <header class="w3-container w3-light-grey">
					 <p> 
					  <a class="w3-button  w3-white w3-border w3-border-green w3-round-large" href="index.php?op=computo&acao=novocomputo">Criar Computo Geral</a> 
					 </p>
					 </header>  
				</div>
				
				 <? 
				    $epovt= "SELECT * FROM ata_computo_geral ORDER BY municipio";
					$povt=mysqli_query($conexao,$epovt);
					
					while($dpovt=mysqli_fetch_array($povt)){
				 ?>
				 <br>
				 <div class="w3-card-4">
				 
					<header class="w3-container w3-light-green">
					
					<h3>Regional <?=$dpovt['crefito']?> em <?=$dpovt['municipio']?>/<?=$dpovt['estado']?> em <?  $datam =$dpovt['data']; 
					  echo date('d/m/Y H:i:s', strtotime($datam));  ?></h3>
					<p>  <a class="w3-button  w3-white w3-border w3-border-green w3-round-large" 
							href="gerar_ata_computo.php?idc=<?=$dpovt['id']?>">Gerar Arquivo Ata</a>
							 <a class="w3-button  w3-white w3-border w3-border-green w3-round-large" 
							href="index.php?op=computo&acao=editarcomputo&idc=<?=$dpovt['id']?>">Editar</a>
							<a class="w3-button  w3-white w3-border w3-border-green w3-round-large" 
							href="index.php?op=computo&acao=apagarcomputo&idc=<?=$dpovt['id']?>" onClick="return confirm('Deseja realmente apagar?')">Apagar</a>
					</p>	
					
					
					
				</header>
					</div><br><br>
					<? } ?>
	</div>
	<?

 

  } 
?>
	
</div>