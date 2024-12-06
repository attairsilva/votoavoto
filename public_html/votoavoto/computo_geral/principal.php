<?php 
include("functions.php");
$ssum= "SELECT id, mesa FROM admin WHERE id='$idu'";
$dssum=mysqli_fetch_array(mysqli_query($conexao,$ssum));
?>
<div class="w3-container">
 <?
 if($_GET['acao']=="apagarchapa"){
	  $idc=$_GET['idc'];
	  $epovt= "DELETE FROM chapas WHERE id='$idc'";
	  $povt=mysqli_query($conexao,$epovt);
			if(!$povt) {
				 $msg=$msg."<br><font color=red>Erro ao apagar Chapa: ".mysqli_error($querys)."</font><br><br>"; 
				$lognot="Erro ao apagar Chapa";
			}else{
				$msg=$msg."<br>Chapa apagada com sucesso!</font><br><br>"; 
				$lognot="Chapa apagada com sucesso!";
					$epovtt= "DELETE FROM chapas_membros WHERE id_chapa='$idc'";
					$povrt=mysqli_query($conexao,$epovtt);
					if(!$povrt) {
						 $msg=$msg."<br><font color=red>Erro ao apagar membros da Chapa: ".mysqli_error($querys)."</font><br><br>"; 
						 $lognot="Erro ao apagar membos da Chapa";
					}else{
						$msg=$msg."<br>Membros da Chapa apagados com sucesso!</font><br><br>"; 
					}
			}
		//iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','$lognot','$datalog')");
			//fimlog
  }  if($_GET['acao']=="apagarcomissao"){
	  $membro=$_GET['membro'];
	  $epovt= "DELETE FROM comissao_eleitoral WHERE id='$membro'";
	  $povt=mysqli_query($conexao,$epovt);
			if(!$povt) {
				 $msg=$msg."<br><font color=red>Erro ao apagar registro de membro da comissao: ".mysqli_error($querys)."</font><br><br>"; 
				$lognot="Erro ao apagar membro da comissão";
			}else{
				$msg=$msg."<br>Membro da comissão apagado!</font><br><br>"; 
				$lognot="Membro da comissão apagado";
			}
	
		//iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','$lognot','$datalog')");
			//fimlog
  } 
  if($_GET['acao']=="editarcomissao_act"){
	  $cnome=$_POST['membro_nome'];
	  $ctipo=$_POST['membro_tipo'];
	  $idc=$_POST['idc'];

	  $inq= mysqli_query($conexao,"UPDATE comissao_eleitoral set
				nome='$cnome',
				funcao='$ctipo'
			    WHERE id='$idc'");
	   if(!$inq) {
				 $msg=$msg."<br><font color=red>Erro ao editar comissao: ".mysqli_error($inq)."</font><br><br>"; 
				$lognot="Erro ao editar comissao";
			}else{
				$msg=$msg."<br>Comissao editada!</font><br><br>"; 
				$lognot="Comissao editada!";
			}
	
		//iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','$lognot','$datalog')");
			//fimlog
  } if($_GET['acao']=="editarchapa_act"){
	  $chapa_nome=$_POST['chapa_nome'];
	  $chapa_numero=$_POST['chapa_numero'];
	  $chapa_adv=$_POST['chapa_adv'];
	  $chapa_adv_i=$_POST['chapa_adv_i'];
	  $idc=$_GET['idc'];

	  $inq= mysqli_query($conexao,"UPDATE chapas set
				descricao='$chapa_nome', 
				numero='$chapa_numero',
				adv_nome='$chapa_adv',
				adv_inscricao='$chapa_adv_i'
				WHERE id='$idc'");
	   if(!$inq) {
				 $msg=$msg."<br><font color=red>Erro ao editar Chapa: ".mysqli_error($inq)."</font><br><br>"; 
				$lognot="Erro ao editar Chapa";
			}else{
				$msg=$msg."<br>Chapa editada!</font><br><br>"; 
				$lognot="Chapa editada!";
			}
	
		//iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','$lognot','$datalog')");
			//fimlog
  }
 
   if($_GET['acao']=="apagarcandidato"){
	  $membro=$_GET['membro'];
	  $epovt= "DELETE FROM chapas_membros WHERE id='$membro'";
	  $povt=mysqli_query($conexao,$epovt);
			if(!$povt) {
				 $msg=$msg."<br><font color=red>Erro ao apagar registro: ".mysqli_error($querys)."</font><br><br>"; 
				$lognot="Erro ao apagar Candidato";
			}else{
				$msg=$msg."<br>Candidato apagado!</font><br><br>"; 
				$lognot="Candidato apagado";
			}
	
		//iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','$lognot','$datalog')");
			//fimlog
  } 
  if($_GET['acao']=="editarcandidato_act"){
			$cinscricao=$_POST['candidato_inscricao'];
			$cnome=$_POST['candidato_nome'];
			$ctipo=$_POST['candidato_tipo'];
			$cord=$_POST['candidato_ord'];
			$idc=$_POST['idc'];
			$inq= mysqli_query($conexao,"UPDATE chapas_membros set
						nome='$cnome',
						crefito='$cinscricao',
						rep='$ctipo',
						ord='$cord' WHERE id='$idc'");
	  		 if(!$inq) {
				 $msg=$msg."<br><font color=red>Erro ao editar candidato: ".mysqli_error($inq)."</font><br><br>"; 
				$lognot="Erro ao editar Candidato";
			}else{
				$msg=$msg."<br>Candidato editado!</font><br><br>"; 
				$lognot="Candidato editado!";
			}
	
		   //iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','$lognot','$datalog')");
			//fimlog

			echo '<meta http-equiv="refresh" content="0; url=http://'.$_SERVER['HTTP_HOST'].'/votoavoto/computo_geral/index.php?acao=chapa&msg='.$msg.'" />';

  }
  if($_GET['acao']=="cadastrarcandidato_act"){
	  $cinscricao=$_POST['candidato_inscricao'];
	  $cnome=$_POST['candidato_nome'];
	  $ctipo=$_POST['candidato_tipo'];
	  $cord=$_POST['candidato_ord'];
	  $idc=$_POST['idc'];
	  $inq= mysqli_query($conexao,"INSERT INTO chapas_membros set
				nome='$cnome',
				crefito='$cinscricao',
				rep='$ctipo',
				id_chapa='$idc',
				ord='$cord'");
	   if(!$inq) {
				 $msg=$msg."<br><font color=red>Erro ao cadastrar candidato: ".mysqli_error($inq)."</font><br><br>"; 
				$lognot="Erro a cadasdtrar Candidato";
			}else{
				$msg=$msg."<br>Candidato cadastrado!</font><br><br>"; 
				$lognot="Candidato cadastrado!";
			}
	
		//iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','$lognot','$datalog')");
			//fimlog

			echo '<meta http-equiv="refresh" content="0; url=http://'.$_SERVER[HTTP_HOST].'/computo_geral/index.php?acao=chapa&idc='.$idc.'&msg='.$msg.'" />';
  }
  if($_GET['acao']=="cadastrarcomissao_act"){
 
	  $cnome=$_POST['membro_nome'];
	  $ctipo=$_POST['membro_tipo'];
 
	  $inq= mysqli_query($conexao,"INSERT INTO comissao_eleitoral set
				nome='$cnome',
				funcao='$ctipo' ");
	   if(!$inq) {
				 $msg=$msg."<br><font color=red>Erro ao cadastrar novo membro da comissao: ".mysqli_error($inq)."</font><br><br>"; 
				$lognot="Erro ao cadastrar novo membro comissao";
			}else{
				$msg=$msg."<br>Membro  cadastrado!</font><br><br>"; 
				$lognot="Membro cadastrado!";
			}
	
		//iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','$lognot','$datalog')");
			//fimlog
  }
  
  if($_GET['acao']=="etapafim"){
	    $chapa_qtd=$_POST['chapa_qtd'];
	    $chapa_nome=$_POST['chapa_nome'];
	    $chapa_numero=$_POST['chapa_numero'];
		$adv_nome=$_POST['chapa_adv'];
		$adv_nome_i=$_POST['chapa_adv_i'];
	  
	  
 
	  $inq= mysqli_query($conexao,"INSERT INTO chapas set
				numero='$chapa_numero',
				descricao='$chapa_nome',
				adv_nome='$adv_nome',
				adv_inscricao='$adv_nome_i'");
	   if(!$inq) {
				 $msg=$msg."<br><font color=red>Erro ao cadastrar Chapa: ".mysqli_error($inq)."</font><br><br>"; 
				$lognot=$lognot."Erro ao cadastrar Chapa";
			}else{
				$idc=mysqli_insert_id($conexao);
				$msg=$msg."<br>Chapa cadastrada!</font><br><br>"; 
				$lognot=$lognot."Chapa cadastrada!";
				for($i=0;$i<=$chapa_qtd;$i++) { 
					if( $_POST['membro_nome'][$i] != NULL) { 
  
						$rp=$_POST['membro_rep'][$i];
						if($rp<1) { $rp=0; }
						$sqlins=$sqlins."('$idc','".$_POST['membro_nome'][$i]."','".$_POST['membro_crefito'][$i]."','".$rp."', '0'),";
				    }
				}
				if($i>0) { 
						$sqlins=substr($sqlins, 0, -1);
						$sqlins= "INSERT INTO chapas_membros (id_chapa, nome, crefito, rep, ord) VALUES $sqlins ;";
						$inqq= mysqli_query($conexao,$sqlins);
						//$msg=$msg.$sqlins;
						if(!$inq) {
							$msg=$msg."<br><font color=red>Erro ao cadastrar novos membros na Chapa criada: ".mysqli_error($inq)."</font><br><br>"; 
							$lognot=$lognot."Erro ao cadastrar novos membros na Chapa criada!";
						}else{
							$msg=$msg."<br>Membros da comissão cadastrados!</font><br><br>"; 
							$lognot=$lognot."Membros da comissão cadastrados!";
						}
				}
			}
	
		//iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','$lognot','$datalog')");
			//fimlog
  }
  

 if($msg!=NULL) { ?>
	<div  id="id00" class="w3-panel   w3-light-grey  w3-display-container" style="display:block;  width:  <?=$perc?>">
	  <p>
	  <?php print(utf8_encode($msg)); ?>
	  </p>
	</div>
<? 
}  

    if($_GET['acao']=='editarcandidato') {
	  
	    $epovt= "SELECT * FROM chapas_membros WHERE id='".$_GET['membro']."'";
		$dpovt=mysqli_fetch_array(mysqli_query($conexao,$epovt));
	?>
	<div id="id11" class="w3-panel   w3-light-grey  w3-display-container" style="display:block;  width:  <?=$perc?>">
  
		 <br><br><br>
				<div class="w3-container w3-teal">
				 <h2>Editar Candidato</h2><p>
				</p>
				</div>
				 <form name="formenvia" method="post" action="index.php?acao=editarcandidato_act" enctype="multipart/form-data" class="w3-container">   
				  <br> <input type="hidden" name="idc" id="idc" value="<?=$dpovt['id']?>">
					 <label class="w3-text-teal"><b>Nome completo  </b></label>
					<input type="text" name="candidato_nome" id="candidato_nome" style=" width: 50%" value="<?=$dpovt['nome']?>"> 
					   <br>  <br>
					<label class="w3-text-teal"><b>Registro </b></label>
					<input type="text" name="candidato_inscricao"id="candidato_inscricao" style=" width: 200px" value="<?=$dpovt['crefito']?>"> 
					<br>  <br>
					<label class="w3-text-teal"><b>Ordem</b></label>
					<input type="number" name="candidato_ord"id="candidato_ord" style=" width: 50px" value="<?=$dpovt['ord']?>" > 
				   <br>  <br><label class="w3-text-teal"><b>Assina a Ata de Computo Geral? </b></label>
					<input type="checkbox" name="candidato_tipo"id="candidato_tipo" style=" width: 200px" value="1" <? if($dpovt['rep']==1) { echo "checked"; } ?>> 
				   <br>  <br>
				 <input type="submit" name="Submit" value="Alterar" class="w3-btn w3-blue-grey">
		 
		 </form>
	</div>
	<?

  } if($_GET['acao']=='editarcomissao') {
	  
	    $epovt= "SELECT * FROM comissao_eleitoral WHERE id='".$_GET['membro']."'";
		$dpovt=mysqli_fetch_array(mysqli_query($conexao,$epovt));
	?>
	<div id="id11" class="w3-panel   w3-light-grey  w3-display-container" style="display:block;  width:  <?=$perc?>">
  
		 <br><br><br>
				<div class="w3-container w3-teal">
				 <h2>Editar Membro da Comissão</h2><p>
				</p>
				</div>
				 <form name="formenvia" method="post" action="index.php?acao=editarcomissao_act" enctype="multipart/form-data" class="w3-container">   
				  <br> <input type="hidden" name="idc" id="idc" value="<?=$dpovt['id']?>">
					 <label class="w3-text-teal"><b>Nome completo  </b></label>
					<input type="text" name="membro_nome" id="membro_nome" style=" width: 50%" value="<?=$dpovt['nome']?>"> 
					   <br>  <br>
					<label class="w3-text-teal"><b>Tipo </b></label> 
					<SELECT id='membro_tipo' name='membro_tipo'>
						<option value="">---------------</option>
						<option value="Presidente" <? if($dpovt['funcao']=='Presidente') { echo "selected"; } ?>>Presidente</option>
						<option value="Vogal"<? if($dpovt['funcao']=='Vogal') { echo "selected"; } ?>>Vogal </option>
						<option value="Secretário(a)" <? if($dpovt['funcao']=='Secretário(a)') { echo "selected"; } ?>>Secretário(a)</option>
					</select>
				   <br>  <br>
				 
				 <input type="submit" name="Submit" value="Alterar" class="w3-btn w3-blue-grey">
		 
		 </form>
	</div>
	<?

  } if($_GET['acao']=='editarchapa') {
	  $idc=$_GET['idc'];
	    $epovt= "SELECT * FROM chapas WHERE id='".$idc."'";
		$dpovt=mysqli_fetch_array(mysqli_query($conexao,$epovt));
	?>
	<div id="id11" class="w3-panel   w3-light-grey  w3-display-container" style="display:block;  width:  <?=$perc?>">
  
		 <br><br> 
					<div class="w3-container w3-teal">
				 <h2>Editar Chapa nº  <?=$dpovt['numero']?> - <?=$dpovt['descricao']?></h2><p>
				</p>
				</div>
				 <form name="formenvia" method="post" action="index.php?acao=editarchapa_act&idc=<?=$idc?>" enctype="multipart/form-data" class="w3-container">   
				  <br> 
					 <label class="w3-text-teal"><b>Nº da Chapa </b></label>
					<input type="text" name="chapa_numero" id="chapa_numero" value="<?=$dpovt['numero']?>" style=" width: 50px"> 
					   <br>  <br><label class="w3-text-teal"><b>Nome da Chapa </b></label>
					<input type="text" name="chapa_nome" id="chapa_nome" value="<?=$dpovt['descricao']?>" style=" width: 50%"> 
					   <br>  <br> <label class="w3-text-teal"><b>Advogado</b></label>
					<input type="text" name="chapa_adv" id="chapa_adv" style=" width: 50%" value="<?=$dpovt['adv_nome']?>">  - INSCRICAO <input type="text" name="chapa_adv_i" id="chapa_adv_i" style=" width: 70px"  value="<?=$dpovt['adv_inscricao']?>"> 
					   <br>  <br>
		
				 <input type="submit" name="Submit" value="Alterar" class="w3-btn w3-blue-grey">
		 
		 </form><br>
	</div>
	<?

  }if($_GET['acao']=='novomembrocomissao') {
	  
	   
	?>
	<div id="id11" class="w3-panel   w3-light-grey  w3-display-container" style="display:block;  width:  <?=$perc?>">
  
		 <br><br><br>
				<div class="w3-container w3-teal">
				 <h2>Novo Membro da Comissão</h2><p>
				</p>
				</div>
				 <form name="formenvia" method="post" action="index.php?acao=cadastrarcomissao_act" enctype="multipart/form-data" class="w3-container">   
				  <br>  
					 <label class="w3-text-teal"><b>Nome completo  </b></label>
					<input type="text" name="membro_nome" id="membro_nome" style=" width: 50%" value="<?=$dpovt['nome']?>"> 
					   <br>  <br>
					<label class="w3-text-teal"><b>Tipo </b></label> 
					<SELECT id='membro_tipo' name='membro_tipo'>
						<option value="">---------------</option>
						<option value="Presidente" >Presidente</option>
						<option value="Vogal" >Vogal </option>
						<option value="Secretário(a)" >Secretária(a)</option>
					</select>
				   <br>  <br>
				 
				 <input type="submit" name="Submit" value="Gravar" class="w3-btn w3-blue-grey">
		 
		 </form>
	</div>
	<?

  }  if($_GET['acao']=='novocandidato') {
	  
	$idc=$_GET['idc'];
	$epovt= "SELECT * FROM chapas WHERE id='".$idc."'";
	$dpovt=mysqli_fetch_array(mysqli_query($conexao,$epovt));
	?>
	<div id="id11" class="w3-panel   w3-light-grey  w3-display-container" style="display:block;  width: <?=$perc?>">
  
		 <br><br><br>
				<div class="w3-container w3-teal">
				 <h2>Novo Candidato - Chapa <?=$dpovt['numero']?> - <?=$dpovt[descricao]?></h2><p>
				</p>
				</div>
				 <form name="formenvia" method="post" action="index.php?acao=cadastrarcandidato_act" enctype="multipart/form-data" class="w3-container">   
				  <br> <input type="hidden" name="idc" id="idc" value="<?=$_GET['idc']?>">
					 <label class="w3-text-teal"><b>Nome completo  </b></label>
					<input type="text" name="candidato_nome" id="candidato_nome" style=" width: 50%" > 
					<br>  <br>
					<label class="w3-text-teal"><b>Registro </b></label>
					<input type="text" name="candidato_inscricao"id="candidato_inscricao" style=" width: 200px"> 
					<br>  <br>
					<label class="w3-text-teal"><b>Ordem</b></label>
					<input type="number" name="candidato_ord"id="candidato_ord" style=" width: 30px" > 
				   <br>  <br>
				   <label class="w3-text-teal"><b>Assina a Ata de Computo Geral? </b></label>
					<input type="checkbox" name="candidato_tipo"id="candidato_tipo" style=" width: 200px" value="1"> 
				   <br>  <br>
				 <input type="submit" name="Submit" value="Gravar" class="w3-btn w3-blue-grey">
		 
		 </form>
	</div>
	<?

  } 

 if($_GET['acao']=='chapa') {
	?>
	<div id="id11" class="w3-panel   w3-light-grey  w3-display-container" style="display:block;  width:  <?=$perc?>">
  
		 <br>
				<div class="w3-container w3-teal">
					<h2>Chapas Registradas</h2>
				</div>
				
				 <div class="w3-card-4">
					 <header class="w3-container w3-light-grey">
					 <p> 
					  <a class="w3-button  w3-white w3-border w3-border-green w3-round-large" href="index.php?acao=novachapa">Nova Chapa</a> 
					 
					 </p>
					 </header>  
				</div>
				<? if($_GET['msg']!=NULL) { ?>
<br>
				<div class="w3-card-4">
				 
				 <header class="w3-container w3-light-white"><?=$_GET['msg']?>
				 </header></div><? } ?>
				
				 <? 
				    $epovt= "SELECT * FROM chapas ORDER BY numero";
					$povt=mysqli_query($conexao,$epovt);
					
					while($dpovt=mysqli_fetch_array($povt)){
				 ?>
				 <br>
				 <div class="w3-card-4">
				 
					<header class="w3-container w3-light-green">
					
					<h3>Chapa No. <?=$dpovt['numero']?> - <?=$dpovt['descricao']?></h3>
					  
					<p>  <a class="w3-button  w3-white w3-border w3-border-green w3-round-large" 
							href="index.php?acao=gerenciarcandidatos&idc=<?=$dpovt['id']?>">Candidatos</a>
							 <a class="w3-button  w3-white w3-border w3-border-green w3-round-large" 
							href="index.php?acao=editarchapa&idc=<?=$dpovt['id']?>">Editar</a>
							<a class="w3-button  w3-white w3-border w3-border-green w3-round-large" 
							href="index.php?acao=apagarchapa&idc=<?=$dpovt['id']?>" onClick="return confirm('Deseja realmente apagar?')">Apagar</a>
					</p>	
					
					
				</header>
					</div><br><br>
					<? } ?>
	</div>
	<?

 

  } 
 if($_GET['acao']=='gerenciarcandidatos') {
	 $idc=$_GET['idc'];
	?>
	<div id="id11" class="w3-panel   w3-light-grey  w3-display-container" style="display:block;  width:  <?=$perc?>">
  
		 <br>
				<div class="w3-container w3-teal">
					<h2>Chapas Registradas</h2>
				</div>
				
				 <div class="w3-card-4">
					 <header class="w3-container w3-light-grey">
					 <p> 
					  <a class="w3-button  w3-white w3-border w3-border-green w3-round-large" href="index.php?acao=novocandidato&idc=<?=$idc?>">Novo candidato</a>

					  <a class="w3-button  w3-white w3-border w3-border-green w3-round-large" href="index.php?acao=chapa">Listar Chapas</a> 					  
					 </p>
					 </header>  
				</div>
				
				 <? 
				    $epovt= "SELECT * FROM chapas WHERE id='$idc' ORDER BY numero";
					$povt=mysqli_query($conexao,$epovt);
					
					while($dpovt=mysqli_fetch_array($povt)){
				 ?>
				 <br>
				 <div class="w3-card-4">
				 
					<header class="w3-container w3-light-green">
					
					<h3>Chapa No. <?=$dpovt['numero']?> - <?=$dpovt['descricao']?></h3>
					  
			
					
					<table class="w3-table-all w3-card-4">
				 <? 
						$epovtt="SELECT * FROM chapas_membros WHERE id_chapa='".$idc."' ORDER BY ord";
						$povtt=mysqli_query($conexao,$epovtt);
						
						while($dpovtt=mysqli_fetch_array($povtt)){ 
							$cnt=$cnt+1;				 ?>
						
						<tr>
								<td>  
									<a class="w3-button  w3-white w3-border w3-border-green w3-round-large" href="index.php?acao=editarcandidato&membro=<?=$dpovtt['id']?>">EDITAR</a> 
									<a class="w3-button  w3-white w3-border w3-border-green w3-round-large" href="index.php?acao=apagarcandidato&membro=<?=$dpovtt['id']?>"  onClick="return confirm('Deseja realmente apagar?')">APAGAR</a> 
									<? if($dpovtt['rep']>0) { echo "<b>"; } echo $dpovtt['nome']." - ".$dpovtt['crefito'];
									   if($dpovtt['rep']>0) { echo "</b>"; } 
									 ?>
								
									</td>
								</tr>
							
					<? }  ?> 
				</table>	
				<br>Qtd. Candidatos: <?=$cnt?><br><br>
				</header>
					</div><br><br>
					<? } ?>
	</div>
	<?

  }        
if($_GET['acao']=='novachapa') {
?>
	
	<div id="id01" class="w3-panel   w3-light-grey  w3-display-container" style="display:block;  width:  <?=$perc?>">
	   <br><br>
					<div class="w3-container w3-teal">
					<h2>CHAPAS</h2>
				</div>
				<div class="w3-card-4">
					 <header class="w3-container w3-light-grey">
					 <p> 
					  <a class="w3-button  w3-white w3-border w3-border-green w3-round-large" href="index.php?acao=novocandidato&idc=<?=$idc?>">Novo candidato</a>

					  <a class="w3-button  w3-white w3-border w3-border-green w3-round-large" href="index.php?acao=chapa">Listar Chapas</a> 					  
					 </p>
					 </header>  
				</div>
				<div class="w3-container w3-teal">
				 <h2>NOVA CHAPA</h2><p>
				</p>
				</div>
				 <form name="formenvia" method="post" action="index.php?acao=etapa1" enctype="multipart/form-data" class="w3-container">   
				  <br>
					  <br>
					<label class="w3-text-teal"><b>Quantidade de Candidatos </b></label>
					<input type="number" name="chapa_qtd" id="chapa_qtd" style=" width: 50px"> 
				   <br>  <br>
				 <input type="submit" name="Submit" value="Registrar" class="w3-btn w3-blue-grey">
		 
		 </form>
	</div>
  <? }
  
 if($_GET['acao']=='etapa1') {
	 
	 $chapa_qtd=$_POST['chapa_qtd'];
	?>	
	<div id="id02" class="w3-panel   w3-light-grey  w3-display-container" style="display:block;  width: <?=$perc?>">
   <br>
				<div class="w3-container w3-teal">
				 <h2>Criar Chapa</h2><p>
				</p>
				</div>
				 <form name="formenvia" method="post" action="index.php?acao=etapafim" enctype="multipart/form-data" class="w3-container">   
				  <br><input type="hidden" name="chapa_qtd" id="chapa_qtd" value="<?=$chapa_qtd?>"> 
					 <label class="w3-text-teal"><b>Nº da Chapa </b></label>
					<input type="text" name="chapa_numero" id="chapa_numero" style=" width: 50px"> 
					   <br>  <br><label class="w3-text-teal"><b>Nome da Chapa </b></label>
					<input type="text" name="chapa_nome" id="chapa_nome" style=" width: 50%"> 
					   <br>  <br> <label class="w3-text-teal"><b>Advogado</b></label>
					<input type="text" name="chapa_adv" id="chapa_adv" style=" width: 50%">  - INSCRICAO <input type="text" name="chapa_adv_i" id="chapa_adv_i" style=" width: 70px"> 
					   <br>  <br>
					   <? for($i=0;$i<$chapa_qtd;$i++) { ?>
					 <label class="w3-text-teal"><b>Membro <?=$i+1?> </b></label>
					<input type="text" name="membro_nome[<?=$i?>]" id="membro_nome[<?=$i?>]" style=" width: 50%"> -  <input type="text" name="membro_crefito[<?=$i?>]" id="membro_crefito[<?=$i?>]" style=" width: 80px"> - Assina Ata? <input type="checkbox" name="membro_rep[<?=$i?>]" id="membro_rep[<?=$i?>]" value="1"> 
					   <br>  <br>
					   <? } ?>
				   <br>  <br>
				 <input type="submit" name="Submit" value="Registrar" class="w3-btn w3-blue-grey">
		 
		 </form><br>
	</div>
 <? } 
 
 
 if($_GET['acao']=='comissao') {
 
	?>
	<div id="id11" class="w3-panel   w3-light-grey  w3-display-container" style="display:block;  width:  <?=$perc?>">
  
		 <br>
				<div class="w3-container w3-teal">
					<h2>Comissão Eleitoral</h2>
				</div>
				
				 <div class="w3-card-4">
					 <header class="w3-container w3-light-grey">
					 <p> 
					  <a class="w3-button  w3-white w3-border w3-border-green w3-round-large" href="index.php?acao=novomembrocomissao">Novo membro da comissão</a> 
					 </p>
					 </header>  
				</div>
				
				 <? 
				    $epovt= "SELECT * FROM comissao_eleitoral ORDER BY nome";
					$povt=mysqli_query($conexao,$epovt);
					
					while($dpovt=mysqli_fetch_array($povt)){
				 ?>
				 <br>
				 <div class="w3-card-4">
				 
					<header class="w3-container w3-light-green">
					
					<h3><?=$dpovt['nome']?> - <?=$dpovt['funcao']?>
					<br><a class="w3-button  w3-white w3-border w3-border-green w3-round-large" href="index.php?acao=editarcomissao&membro=<?=$dpovt['id']?>">EDITAR</a> 
									<a class="w3-button  w3-white w3-border w3-border-green w3-round-large" href="index.php?acao=apagarcomissao&membro=<?=$dpovt['id']?>"  onClick="return confirm('Deseja realmente apagar?')">APAGAR</a> 
									</h3>
			
					
				</header>
					</div><br><br>
					<? } ?>
	</div>
	<?

  }        
  ?>
	
</div>