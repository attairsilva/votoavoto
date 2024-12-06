<?php 
 error_reporting(E_ERROR | E_PARSE);
?> 
<div class="w3-container">
  <p>Sessão destinada a leitura de etiquetas.</p>

     <?


if($view=="content") { 
			
?>
<div id="content">
 					<div>
						Profissionais no sistema						 
					</div>
					<div class="table">
						<table width="100%"   cellspacing="0" cellpadding="0" >
    					<? 
			$sqlp=" SELECT p.id_inscricao, p.nome, p.crefito, p.votou ,p.forma, 
					p.id_usuario, p.data_horario	FROM enviados  AS e LEFT JOIN 
					profissionais AS p ON e.crefito = p.crefito WHERE p.nome<>''  ORDER by p.nome";
					
			$qprocessos=mysqli_query($conexao,$sqlp);				
			if(!$qprocessos) { echo 'Erro'; }
			while($dadosp=mysqli_fetch_array($qprocessos)){
				$x=$x+1;
				if($x%2==0) { 
					$cor="#FFFFFF"; 
				}else{
					$cor="#FFFFCC";
				}	
				
				if($dadosp[votou]=="sim") { $cor="#B1E2FC"; }
							?>
							
							<tr>
							  <td width="1%" height="1" style="background:<?=$cor?>;  
                               border-bottom:#900 2px;">&nbsp;</td>
						      <td width="66%" height="1" style="background:<?=$cor?>;   
                              border-bottom:#900 2px;"><?=$dadosp["nome"]." - CREFITO ".$dadosp["crefito"]." - 
							  ID da inscrição: ".$dadosp["id_inscricao"]?></td>
						      <td width="33%" height="1" style="background:<?=$cor?>;   border-bottom:#900 2px;"> 				
							  <?
                              $sqlusr=mysqli_fetch_array(mysqli_query($conexao,"select id,usuario,tipo 
							  from admin where id='".$dadosp['id_usuario']."'"));
							  if($dadosp['forma']!=NULL) { 
							   $datetime = $dadosp['data_horario'];
								$orgdate = date("d/n/Y H:i ", strtotime($datetime ));
							
								  print("Voto ".$dadosp["forma"]." <br><id> Registrado 
								  por [".$sqlusr["usuario"]."] <br>".$orgdate."
								  </i>"); 
							  }else{ print("----------------------");} 
							  ?></td>
						  </tr>
							
							<? } ?>
						</table>
					</div>

<? 
}
?> 
</div>


</div>


<div>