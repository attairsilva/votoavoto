<?php 
include("functions.php");
$ssum= "SELECT id, mesa FROM admin WHERE id='$idu'";
$dssum=mysqli_fetch_array(mysqli_query($conexao,$ssum));
?>
<div class="w3-container" style="80%">
 <?
 
  if($_GET['acao']=="apagar"){
      $mesaid=$_GET['mesaid'];
	  if($mesaid=="todas"){  
	    $epovt= "DELETE FROM computo_mesas";
	   }else{
		$epovt= "DELETE FROM computo_mesas WHERE id_admin='$mesaid'";
	   }
	  $povt=mysqli_query($conexao,$epovt);
			if(!$povt) {
				 $msg=$msg."<br><font color=red>Erro ao apagar registro de computo: ".mysqli_error($querys)."</font><br><br>"; 
				 $lognot="Erro ao apagar registro de computo da mesa";
			}else{
				if($mesaid=="todas"){  
					$epovt= "DELETE FROM computo_mesas_chapas";
				}else{
					$epovt= "DELETE FROM computo_mesas_chapas WHERE id_admin='$mesaid'";
				}
				$povts=mysqli_query($conexao,$epovt);
				if(!$povts) {
					$msg=$msg."<br><font color=red>Erro ao apagar registro de computo: ".mysqli_error($querys)."</font><br><br>"; 
				    $lognot="Erro ao apagar registro de computo da mesa";
			    }else{
					$msg=$msg."<br>Os registros foram apagados!</font><br><br>"; 
					$lognot="Os registro de computo foram apagados";
				}
				
			}
	
		//iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','$lognot','$datalog')");
			//fimlog
  }
 if($_GET['acao']=="postado"){


			$selctpovt= mysqli_query($conexao,"SELECT * FROM `admin` WHERE mesa>0 ORDER BY mesa");
			if(!$selctpovt) { echo "Erro: ".mysqli_error($conexao); }
			while($dqstpovt=mysqli_fetch_array($selctpovt)){
				
				$idmsa=$dqstpovt['id'];
				$idmsac=$_POST['id_mesa'][$idmsa];
				$idc=$_POST['chk'][$idmsac];
				//echo $idmsac."=>".$idc."<br>";
				$grave_tpoc="";
				$grave_tpo="";
				$vchapa=0;
				$tcampo=0;
				$vcampoc=0;
				//echo $idmsac."=>".$idc."<br>";
				if($idc!=NULL) { 
				
					// computo mesas inicio
					//verifica se mesa foi lançada anteriormente
						$sqqvt="select id, id_admin, id_voto_tipo, qtd_voto from computo_mesas where id_admin='".$idmsa."'"; 
						$dsqqvt=mysqli_fetch_array(mysqli_query($conexao,$sqqvt)); 
					//
					if($dsqqvt['id']==NULL) {  
						$grave_tpo = "insert into  computo_mesas (id_admin, id_voto_tipo, qtd_voto) values ";
						//echo $idmsac."=>".$idc."<br>";
					}else{
						$grave_tpou = "UPDATE  computo_mesas SET qtd_voto = CASE   ";
					}
					$selctpov= "SELECT * FROM voto_tipo ORDER BY id";
					$dqstpov=mysqli_query($conexao,$selctpov);
					while($dtpov=mysqli_fetch_array($dqstpov)){		
							$id_tpo=$dtpov['id'];
							$tcampo=$_POST['fqtd'][$idmsa][$id_tpo];
							if($tcampo>0){
								if($dsqqvt['id']==NULL){
									$grave_tpo  = $grave_tpo."('$idmsa','".$_POST['voto_tipo'][$idmsa][$id_tpo]."','".$tcampo."'),";
								}else{
									 $grave_tpo  = $grave_tpo." when (id_admin='".$idmsa."' AND id_voto_tipo='".$_POST['voto_tipo'][$idmsa][$id_tpo]."') then '".$tcampo."' 
									";
							
								}
							}
					}
					if($dsqqvt['id']==NULL) {  
						$grave_tpo =substr($grave_tpo , 0, -1);
						$grave_tpo =$grave_tpo ."; ";
					}else{
						$grave_tpo=$grave_tpou.$grave_tpo."     
						END
						;";
					}
					//echo "<br>->".$grave_tpo."<br>";
					$querys = mysqli_query($conexao,$grave_tpo );
					if (!$querys) { 
						$msg=$msg."<br><font color=red>Erro ao lançar registros brancos e nulos: ".mysqli_error($querys)."<br>".$grave_tpo ."</font><br><br>"; 
						$lognot="Erro ao registrar valores brancos e nulo ";
					}else{
						$msg=$msg."<br>Quantidades de brancos e nulos lançados com sucesso! "; 
						$lognot="Registrado valores para brancos e nulos manualmente apurados";
					}
					// computo mesas fim

					// computo mesas chapa inicio
					//verifica se mesa foi lançada anteriormente
						$sqqvc="select id, id_admin, id_chapa, qtd_voto from computo_mesas_chapas where id_admin='".$idmsa."'"; 
						$dsqqvc=mysqli_fetch_array(mysqli_query($conexao,$sqqvc)); 
					//
					if($dsqqvc['id']==NULL) {  
						$grave_tpoc = "insert into  computo_mesas_chapas (id_admin, id_chapa, qtd_voto) values ";	
					}else{
						$grave_tpouc = "UPDATE computo_mesas_chapas SET qtd_voto = CASE  ";
					}
					$selctpovc= "SELECT id FROM `chapas` ORDER BY id";
					$dqstpovc=mysqli_query($conexao,$selctpovc);
					while($dtpovc=mysqli_fetch_array($dqstpovc)){
							$id_tpoc=$dtpovc['id'];
							$vcampoc=$_POST['fqtd_chapa'][$idmsa][$id_tpoc];
							$vchapa=$_POST['voto_chapa'][$idmsa][$id_tpoc];
							if($vchapa>0){
								if($dsqqvc['id']==NULL){
									$grave_tpoc  = $grave_tpoc."('$idmsa','".$vchapa."','".$vcampoc."'),";
								}else{
									$grave_tpoc  = $grave_tpoc." when (id_admin='".$idmsa."' AND id_chapa='".$id_tpoc."') then '".$vcampoc."' 
									";
								}
							}
					}
					if($dsqqvc['id']==NULL) { 
						$grave_tpoc =substr($grave_tpoc , 0, -1);
						$grave_tpoc =$grave_tpoc ."; ";	
					}else{
						$grave_tpoc=$grave_tpouc.$grave_tpoc."    
						END
						;";
					}
					//echo "<br>->".$grave_tpoc."<br>";
					$querysc = mysqli_query($conexao, $grave_tpoc );
					if (!$querysc) { 
						$msg=$msg."<br><font color=red>Erro ao lançar registros nas chapas: ".mysqli_error($conexao)."<br>".$grave_tpoc ."</font><br><br>"; 
						$lognot=$lognot."Erro ao registrar valores em chapas";
					}else{
						$msg=$msg."<br>Dados em chapas lançados com sucesso!"; 
						$lognot=$lognot."Registrado valores em chapas manualmente apurados";
					}
					// computo mesas chapa fim

					$nmse= "SELECT id,mesa FROM admin WHERE id='$idmsa'";
                	$dse=mysqli_fetch_array(mysqli_query($conexao,$nmse));
                	$msg=$msg."<br><font color=blue> Lançamento Mesa Nº ".$dse['mesa']."</font> "; 	
					
					//iniciolog
					$datalog=date('Y-m-d H:i:s');
					$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
 					VALUES('$idu','$lognot','$datalog')");
					//fimlog

				}	

                

			}
			
		
			
 }

 if($msg!=NULL) { ?>
	<div  id="id00" class="w3-card-4   w3-light-grey  w3-display-container" style="display:block;  width:  <?=$perc?>">
            <header class="w3-container w3-teal">
            <h1>Processamento</h1>
            </header>
            <div class="w3-container"> <p>
	         <?php print($msg); ?>
	        </p>
        </div>
	</div>

<? 
} ?>
	
    <div class="w3-container w3-teal" style="display:block;  width:  <?=$perc?>">
					<h2>MESA DE APURAÇÃO</h2>
	</div>
				
				 <div class="w3-card-4" style="display:block;  width:  <?=$perc?>">
					 <header class="w3-container w3-light-grey">
					 <p> 
				      <button class="w3-button  w3-white w3-border w3-border-green w3-round-large"  onclick="document.getElementById('id01').style.display='block'; document.getElementById('id02').style.display='none'; document.getElementById('id00').style.display='none' ">Lançar Apuração</button>
                      <button class="w3-button  w3-white w3-border w3-border-green w3-round-large"  onclick="document.getElementById('id02').style.display='block'; document.getElementById('id01').style.display='none'; document.getElementById('id00').style.display='none'  ">Visualisar</button>
					</p></header>  
            
					 
				</div>
 <!-- inicio lancaçemtno -->
	<div id="id01" class="w3-panel   w3-light-grey  w3-display-container" style="display:none;  width:  <?=$perc?>">
	   <span onclick="this.parentElement.style.display='none'"
	     class="w3-button w3-display-topright">X</span>
 <br><br><br>
		<div class="w3-container w3-teal">
		 <h2>Registrar Computo da Mesa </h2><p>Cadastre o computo dos votos neste sistema somente apos conclusao e assinatura da Ata de Apuracao da respectiva mesa. </p>
		</div>
		 <form name="formenvia" method="post" action="?op=mesa&acao=postado" enctype="multipart/form-data" class="w3-container">   
          <br> Marque o checkbox da Mesa que deseja inserir dados ou editar.<br> <table   style="font-size: 12px; width:100%; border-style: none;  padding-top: 10px;
  padding-bottom: 20px;
  padding-left: 30px;
  padding-right: 40px; "> 
    		<? $selmes= "SELECT id, mesa FROM admin WHERE nivel<>10 ORDER BY mesa";
			$dmesa=mysqli_query($conexao,$selmes);
			while($lsmesa=mysqli_fetch_array($dmesa)){ 
				$c=$c+1;
				if($c % 2 == 0){
					$bgc="#00ffbf";
			    } else {
					$bgc="#76dbdc";
			    }
				
			  ?>

			  <tr bgcolor=<?=$bgc?>>
			    <td> <input type="checkbox" id="chk[<?=$lsmesa['id']?>]" name="chk[<?=$lsmesa['id']?>]" value="ok" />
			    </td>
				<td> Mesa nº <?=$lsmesa['mesa']?></td> 
				<td> <input type="hidden" name="id_mesa[<?=$lsmesa['id']?>]" id="id_mesa[<?=$lsmesa['id']?>]" value="<?=$lsmesa['id']?>"></td> 
					
		
			 <?    
			   $selctpo= "SELECT * FROM voto_tipo ORDER BY id";
			   $dqstpo=mysqli_query($conexao,$selctpo);
			   while($dtpo=mysqli_fetch_array($dqstpo)){
				
						//verifica se existe voto
							$sqq="select id_admin, id_voto_tipo, qtd_voto from computo_mesas where id_admin='".$lsmesa['id']."' AND id_voto_tipo='".$dtpo['id']."'"; 
							$dsqq=mysqli_fetch_array(mysqli_query($conexao,$sqq)); 
						//
			 ?>  <td><?=$dtpo['descricao']?></td> 
			     <td> <input type="hidden" name="voto_tipo[<?=$lsmesa['id']?>][<?=$dtpo['id']?>]" id="voto_tipo[<?=$lsmesa['id']?>][<?=$dtpo['id']?>]" value="<?=$dtpo['id']?>" ></td> 
                 <td> <input type="number" name="fqtd[<?=$lsmesa['id']?>][<?=$dtpo['id']?>]" id="fqt[<?=$lsmesa['id']?>][<?=$dtpo['id']?>]" minlength="1" maxlength="5"  class="w3-input w3-round w3-light-grey  w3-border-0" style="font-size: 12px;   width: 65px" value="<?=$dsqq['qtd_voto']?>"  /></td> 
			<? 
			   	} 

			  $selctpoc= "SELECT id, numero, descricao FROM `chapas` ORDER BY numero";
			  $dqstpoc=mysqli_query($conexao,$selctpoc);
			  while($dtpoc=mysqli_fetch_array($dqstpoc)){
						//verifica se existe voto
							$sqqc="select id_admin, id_chapa, qtd_voto from computo_mesas_chapas where id_admin='".$lsmesa['id']."' AND id_chapa='".$dtpoc['id']."'"; 
							$dsqqc=mysqli_fetch_array(mysqli_query($conexao,$sqqc)); 
						//
            	?>
			    <td>Chapa <?  
				$number=$dtpoc['numero'];
				$number = str_pad($number, 2, '0', STR_PAD_LEFT); 
				echo $number;   ?></td>  
               <td>  <input type="hidden" name="voto_chapa[<?=$lsmesa['id']?>][<?=$dtpoc['id']?>]" id="voto_chapa[<?=$lsmesa['id']?>][<?=$dtpoc['id']?>]" value="<?=$dtpoc['id']?>" ></td> 
               <td>  <input type="number" name="fqtd_chapa[<?=$lsmesa['id']?>][<?=$dtpoc['id']?>]" id="fqtd_chapa[<?=$lsmesa['id']?>][<?=$dtpoc['id']?>]" minlength="1" maxlength="5"  class="w3-input  w3-round w3-light-grey  w3-border-0" style="font-size: 12px;  width: 65px" value="<?=$dsqqc['qtd_voto']?>"  /></td> 
           
			<? 
			   }  

			   ?>
			   </tr>
			   <? 
			} ?> 
			</table> 
	 <br>
		 <label class="w3-text-teal"><b>
		 <input type="submit" name="Submit" value="Registrar" class="w3-btn w3-blue-grey"> </b>
		 </form>
	</div>
 <!-- fim lancaçemtno -->


  <!-- visualizar inicio  -->
	<div id="id02" class="w3-panel   w3-light-grey  w3-display-container" style="display:none;  width:  <?=$perc?>">
	   <span onclick="this.parentElement.style.display='none'"
	     class="w3-button w3-display-topright">X</span>
  <br><br><br>

		<div class="w3-container w3-teal" style=" width: 100%">
		 <h2>Apuração por Mesa  <a href="?op=mesa&acao=apagar&mesaid=todas" class="w3-button  w3-white w3-border w3-border-green "
		 onclick="document.getElementById('id02').style.display='block'; document.getElementById('id01').style.display='none'; document.getElementById('id00').style.display='none';  return confirm('Deseja realmente apagar?')" >Zerar todas as mesas</a></h2>
         </div>
       <br>

       <?
        $mqq="select id, mesa from admin where mesa>0 order by mesa"; 
        $dlmqq=mysqli_query($conexao,$mqq);
        while($dmqq=mysqli_fetch_array($dlmqq)){ 
			$cnm=$cnm+1;
			if($cnm==1){ 
			?>
			   <div class="w3-cell-row" style=" width: 100%">
            <? }
        ?>
           <div class="w3-container w3-light-grey w3-cell" >
               <ul class="w3-ul w3-border">
                     <li><h2>Mesa Nº <?=$dmqq['mesa']?></h2><a href="?op=mesa&acao=apagar&mesaid=<?=$dmqq['id']?>" class="w3-button  w3-white w3-border w3-border-green " onclick="document.getElementById('id02').style.display='block'; document.getElementById('id01').style.display='none'; document.getElementById('id00').style.display='none';  return confirm('Deseja realmente apagar?')" >Zerar</a></li>
		
                <?
                $selctppo= "SELECT * FROM voto_tipo ORDER BY id";
                $dqstppo=mysqli_query($conexao,$selctppo);
                while($dtppo=mysqli_fetch_array($dqstppo)){
					$iddp=$dtppo['id'];

                ?>
                        
                        <li><?=$dtppo['descricao']?>: <? 
                        $sqq="select id_admin, id_voto_tipo, qtd_voto from computo_mesas where id_admin='".$dmqq['id']."' AND id_voto_tipo='".$dtppo['id']."'"; 
                        $dsqq=mysqli_fetch_array(mysqli_query($conexao,$sqq)); 
                        $sma=$sma + (int)$dsqq['qtd_voto'];
						$smg=$smg + (int)$dsqq['qtd_voto'];
						$$tipo[$iddp]=$$tipo[$iddp] + (int)$dsqq['qtd_voto'];
                        echo "<b>".$dsqq['qtd_voto']."</b>";
                        ?></li>
              
                <? }
                ?>

				<?
                $selctppoc= "SELECT * FROM chapas ORDER BY id";
                $dqstppoc=mysqli_query($conexao,$selctppoc);
                while($dtppoc=mysqli_fetch_array($dqstppoc)){
					$iddpc=$dtppoc['id'];

                ?>
                        
                        <li><?=$dtppoc['descricao']?>: <? 
                        $sqqc="select id_admin, id_chapa, qtd_voto from computo_mesas_chapas where id_admin='".$dmqq['id']."' AND id_chapa='".$dtppoc['id']."'"; 
                        $dsqqc=mysqli_fetch_array(mysqli_query($conexao,$sqqc)); 
                        $sma=$sma + (int)$dsqqc['qtd_voto'];
						$smg=$smg + (int)$dsqqc['qtd_voto'];
						$$tipoc[$iddpc]=$$tipoc[$iddpc] + (int)$dsqqc['qtd_voto'];
                        echo "<b>".$dsqqc['qtd_voto']."</b>";
                        ?></li>
              
                <? }
                ?>


                     <li>TOTAL DA MESA: <? echo "<b>".$sma."</b>"; ?></li>
                    <? $sma=0;
            ?> </ul>
            </div>
			<? if($cnm==3){ 
				$cnm=0;
			?>
			   </div>
            <? }
 
        }

		?>
		<div class="w3-panel w3-teal w3-round-xlarge" style=" width: 100%"><h3><b>TOTAL DE VOTOS</b></h3>
  <p> <?
		$selbtppo= "SELECT * FROM voto_tipo ORDER BY id";
		$dqsbtppo=mysqli_query($conexao,$selbtppo);
		while($dtbppo=mysqli_fetch_array($dqsbtppo)){
			$iddp=$dtbppo['id'];
			echo "<h2>".$dtbppo['descricao'].": <b>".$$tipo[$iddp]."</b></h2>";
		}
		$selbtppob= "SELECT * FROM chapas ORDER BY id";
		$dqsbtppob=mysqli_query($conexao,$selbtppob);
		while($dtbppob=mysqli_fetch_array($dqsbtppob)){
			$iddpb=$dtbppob['id'];
			echo "<h2>Chapa Nº ".$dtbppob['numero'].": <b>".$$tipoc[$iddpb]."</b></h2>";
		}
		 ?><h2>TOTAL GERAL: <? echo "<b>".$smg."</b>"; ?></h2>  </p>
	   </div>
       <br>  
	</div>
	 <!-- fim   -->
	
