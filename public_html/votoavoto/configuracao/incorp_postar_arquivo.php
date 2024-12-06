 
<?php 
include("functions.php");
$tipo=$_POST['tipo'];
$fdesc=$_POST['fdesc'];
$acao=$_GET["acao"];
$acaom=$_GET["acaom"];

			
					     
if($acao=="escrever") {
	if($_POST['tipo']=="profissionais") { 
		include("incorp_escreve_pf.php"); 	
	}	
}elseif($acao=="usuarioact") {
	include("usuario_act.php"); 

}elseif($acao=="postado") { 


	
	if ($_FILES['arquivo']['sizes'] > 1024 * 1024) {
		$tamanho = round(($_FILES['arquivo']['size'] / 1024 / 1024), 2);
		$med = "MB";
   	} else if ($_FILES['arquivos']['size'] > 1024) {
		$tamanho = round(($_FILES['arquivo']['size'] / 1024), 2);
		$med = "KB";
  	} else {
		$tamanho = $_FILES['arquivo']['size'];
		$med = "Bytes";
	}											   
													   
	if (is_file($_FILES['arquivo']['tmp_name'])) {
			
		$arquivo = $_FILES['arquivo']['tmp_name'];
		$pasta="../configuracao/csv/";
		$achap = ".";
		$temporar=strstr($_FILES['arquivo']['name'],$achap);
		$nomeant=$pastadefotos.$arquivos_name;
		$newdsata=strtolower(date('YmdHis'));
		
		if ($extensaodoarquiv=="") {$extensaodoarquiv="csv";}
		
		$nomenov=($caminho.$prefixodaimagem . $newdsata . $indice . "." . $extensaodoarquiv );
		
		$caminho=$pasta.$nomenov;
		$copia=copy($arquivo,$caminho);
		if(!$copia) {
			$deuerr="SIM";			
			$msg=$msg."<p>Erro durante a manipulção do arquivo no servidor. Contate o desenvolvedor.
			'$arquivo'</p>".'<p><a href="'.$_SERVER["PHP_SELF"].'">Voltar</a></p>'; 
		}else {					   
			 $data=date('Y-m-d');
			 $gravar= "INSERT INTO arquivos_csv (tipo,link,data,descricao) VALUES ('$tipo','$caminho','$data','$fdesc')";
			 $executando = mysqli_query($conexao,$gravar);
			 if (!$executando) { 
						$msg=$msg.'Erro na instrução SQL: ' . mysqli_error().$gravar; 
						$deuerr="SIM"; 		
			}else{
									
					 $datalog=date('Y-m-d H:i:s');
					 $gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
					 VALUES('$idu','Novo arquivo CSV inserido na tabela arquivos_csv: $tipo,$caminho,$data,$fdesc','$datalog')");
			 	
		   }
	    }
													   
	} else {
		$msg=$msg."<br>Arquivo não foi enviado!";
		$msg=$msg."<br>Isso pode ter ocorrido porque o caminho é inválido.";
	}

	//$msg=$msg."De: ".$arquivo."<br>\nPara: ".$caminho." [<a href='".$caminho."'>download</a>]<br><br>";
			 
	if ($deuerr=="SIM") {
				$msg=$msg."<h4><font color='red'>O arquivo não foi enviado. Contate o desenvolvedor!</font></h4>\n";
				$msg=$msg."Arq: ".$_FILES['arquivos']['tmp']['name'];
	}else { 
			$msg=$msg."<h4>Arquivo encaminhado com sucesso!</h4><br>'<i>".$fdesc."</i>'<br>";
																
	}  
	

    
}elseif($acao=="restaurarbackup"){
	
	$cod=$_GET['id'];
	$querys = mysqli_query($conexao,"SELECT id, arquivo, data FROM backups WHERE id='$cod'");
	if (!$querys) { $msg=$msg."<br>Arquivo não deleteda da pasta!"; }
	$dados = mysqli_fetch_array($querys); 
	$file_name = "configuracao/db_bkp/".$dados['arquivo'];
	$buffer_size = 4096; // read 4kb at a time
	$out_file_name = str_replace('.gz', '', $file_name); 
	$file = gzopen($file_name, 'rb');
	$out_file = fopen($out_file_name, 'wb'); 
	while (!gzeof($file)) {
		fwrite($out_file, gzread($file, $buffer_size));
	}
	fclose($out_file);
	gzclose($file);

}elseif($acao=="apagarbackup") {

	$cod=$_GET['id'];

	$querys = mysqli_query($conexao,"SELECT id, arquivo, data FROM backups WHERE id='$cod'");
	if (!$querys) { $msg=$msg."<br>Arquivo não deleteda da pasta!"; }
	$dados = mysqli_fetch_array($querys); 
	$cambck="configuracao/db_bkp/".$dados['arquivo'];
	if (file_exists($cambck)) {
		$aparq=unlink($cambck); 
		if($aparq) { 
			$msg=$msg."<br>Arquivo Apagado: ".$dados['arquivo']; 
			$query_apaga=mysqli_query($conexao,"delete from backups where id='$cod'");
			if (!$query_apaga) { $msg=$msg."<br>Arquivo não foi deletada do banco."; }  
			else { 
					$msg=$msg."<br>Backup apgado";
					
					//iniciolog
					$datalog=date('Y-m-d H:i:s');
					$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
					VALUES('$idu','Apagou arquivo de Backup: $msg -  ID $cod','$datalog')");
					//fimlog	 
			}
		}else{
			$msg=$msg."<br>Erro ao apagar backup!!<br>";
		}
	}else{
			$query_apaga=mysqli_query($conexao,"delete from backups where id='$cod'");
			if (!$query_apaga) { $msg=$msg."<br>Erro ao deletar registro no banco."; }  
			else { 
					$msg=$msg."<br>Backup apagado";
					
					//iniciolog
					$datalog=date('Y-m-d H:i:s');
					$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
					VALUES('$idu','Apagou arquivo de Backup: $msg -  ID $cod','$datalog')");
					//fimlog	 
			}
	}
	
	
}elseif($acao=="apagar") {

	$cod=$_GET['id'];

	$query_seleciona = mysqli_query($conexao,"SELECT * FROM arquivos_csv WHERE id='$cod'");
	if (!$query_seleciona) { 
		$msg=$msg."<br>Erro ao procurar registro no banco. Contate o Desenvolvimento"; 
	}

	while($dados = mysqli_fetch_array($query_seleciona)) { 
		  unlink($dados['link']); 
		  //$msg=$msg."<br>".utf8_decode($dados['descricao'])."<br>Arquivo: ".$dados['link']; 
	}
	$query_apaga=mysqli_query($conexao,"delete from arquivos_csv where id='$cod'");

	if (!$query_apaga) { $msg=$msg."<br>O arquivo CSV não foi deletada do banco, contate o desenvolvedor."; }  
	else { 
			$msg=$msg."<br>Arquivo CSV deletado com sucesso!";
			
			//iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','Apagou arquivo CSV da tabela arquivos_csv: $msg -  ID $cod','$datalog')");
			//fimlog
				
				 
	}

	
}elseif($acao=="apagarsql") {
	
	$tipo=$_GET['tipo'];
	
	$query_del = mysqli_query($conexao,"DELETE FROM profissionais");
	
	if ($query_del) { 
		$msg=$msg."<br>Registros de profissionais foram apagados!";
		$query_del = mysqli_query($conexao,"DELETE FROM profissionais_enderecos");
		//iniciolog
		$datalog=date('Y-m-d H:i:s');
		$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
		VALUES('$idu','Apagou a tabela profissionais: $msg','$datalog')");
		//fimlog		
	}else{
		$msg=$msg."<br>Não foi possível o registro de profissionais.<br>";	
	}

}
?>
</div>

<div class="w3-bar  w3-light-grey w3-mobile ">
<div class="w3-bar-item"></div>
	<div class="w3-bar-item">
	<a href="?acaom=postarcsv"  style="border-radius:2px; margin-right: 15px;"      class="w3-bar-item w3-button w3-mobile  w3-blue-grey w3-border w3-border-black w3-round-large">CSV</a>
	<a href="?acaom=postarcsvp"   style="border-radius:2px; margin-right: 15px;"     class="w3-bar-item w3-button w3-mobile  w3-blue-grey w3-border w3-border-black w3-round-large">PROCESSAR</a>
	<a href="?acaom=backup"     style="border-radius:2px; margin-right: 15px;"   class="w3-bar-item w3-button w3-mobile  w3-blue-grey w3-border w3-border-black w3-round-large">BACKUP</a>
	<a href="?acaom=usuarios"   style="border-radius:2px; margin-right: 15px;"    class="w3-bar-item w3-button w3-mobile  w3-blue-grey w3-border w3-border-black w3-round-large">USUARIOS</a>
	<a href="?acaom=log"   style="border-radius:2px; margin-right: 15px;"   class="w3-bar-item w3-button w3-mobile  w3-blue-grey w3-border w3-border-black w3-round-large">LOG SISTEMA</a>
	</div>
</div>
<? if($msg!=NULL) { 
	?>
<div class="w3-panel w3-blue-grey">
  <p>
  <?php print($msg); ?>
  </p>
</div>
<? } ?>


	
<? if($acaom=="postarcsv") { 
	?>
	<div class="w3-card-4">
		<header class="w3-container w3-teal">
		<h1 class="w3-text-white" style="text-shadow:1px 1px 0 #444" >Enviar Arquivo CSV</h1>
		</header>
		<div class="w3-container">  
			
			<h3>Selecione um arquivo Excel, nas extensão "CSV" Ele deve conter as seguintes colunas na respectiva ordem: Nome do Profissional, Logradouro, Numero, Complemento, Bairro, Municipio, Estado  e CEP.</h3>
			<h3>penas as duas primeiras colunas sao obrigatorias, porém não será possível localizar um profissional pelo endereço durante os trabalhos</h3>
			<h3><a href="?acao=apagarsql&tipo=profissionais" class="w3-btn   w3-teal" onClick="return confirm('Deseja realmente apagar?')">Apagar ultima relação processada!</a></h3>
</h3>
				
			<table class="w3-table w3-striped w3-bordered">
			<form name="formenvia" method="post" action="?acao=postado" enctype="multipart/form-data"> 
				<tr>
						<th><h3>Categoria:</h3></th>
						<td>
							<select name="tipo" id="tipo" style="font-size: 16px; ">
							<option value="profissionais">Profissionais</option> 
							<option>Selecione a op&ccedil;&atilde;o</option>
						</select>
						</td>
			</tr>	
			<tr>
						<th><h3>Descrição:</h3></th>
						<td><input type="text" name="fdesc" id="fdesc"  style="font-size: 16px; width:90%; " /></td>
			</tr>	
			<tr>
						<th><h3>Arquivo:</h3></th>
						<td>
							<input type="file" name="arquivo" id="arquivo"> 
							<input type="hidden" name="acao" value="postado">
						</td>
			</tr>
			<tr>		
						<td></td>
						<td><input type="submit" name="Submit" value="Enviar">
						</td>
			</tr>
			</form>
			</table>

</div><? }
if($acaom=="postarcsvp") { 
	?>
<div class="w3-card-4">
		<header class="w3-container w3-teal">
		<h1 class="w3-text-white" style="text-shadow:1px 1px 0 #444" > Relação CSV de Profissionais</h1>
		</header>
		<div class="w3-container"> 
		<p></p> 
		<h3>Após o envio do arquivo CSV, realize o processamento selecionando o arquivo abaixo, informando em quantas etapas deseja executar a tarefa.
				Dependendo do número de registros em um CSV o recomendável é selecionar um número maior de etapas.<h3>
			
			<h3><a href="?acao=apagarsql&tipo=profissionais" class="w3-btn   w3-teal" onClick="return confirm('Deseja realmente apagar?')">Apagar ultima relação processada!</a></p>
			 <h3>
		<table class="w3-table w3-striped w3-bordered">
		 <tr>
			<th><h4>ID</h4></th>
			<th><h4>DESCRIÇÃO</h4></th>
			<th></th>
			<th></th>
		</tr>

					<?php
					// Consulta segura com prepared statements
					$sql = "select * from arquivos_csv order by id";
					$stmt = $conexao->prepare($sql);
					$stmt->execute();
					$result = $stmt->get_result();

					// Verifica o resultado
					
					while($dmsql = $result->fetch_assoc()){
					?>
					<tr>
						<td><h4><?=$dmsql['id']?></h4></td>
						<td><h4><a href='<?=$dmsql['link']?>'><?php echo  $dmsql["descricao"]; ?></a> (<? echo date_format(date_create($dmsql['data']),"d/m/Y"); 
						$dmsql['data']?>)</h4></td>
						<td><a href="?acao=apagar&id=<?=$dmsql['id']?>"   
						class="w3-button w3-teal w3-border w3-border-light-grey w3-round-large" onClick="return confirm('Deseja realmente apagar? Este processo nao permite recuperacao.')" title="Apagar">
										<i class="material-icons  w3-xlarge">delete</i></a>
					    </td>
						<form name="formprocessa" method="post" action="?acao=escrever" enctype="multipart/form-data">
						<td>
									<input type="hidden" name="id" id="id" value="<?=$dmsql['id']?>"> 
									<input type="hidden" name="tipo" id="tipo" value="<?=$dmsql['tipo']?>">
									
									<input type="submit" name="Submit" value="Processar"  class="w3-button w3-teal w3-border w3-border-light-grey w3-round-large">
					em <select id="etapas" name="etapas">
									<option value="4" <?php if($_POST['etapas']==4) { print("selected"); } ?>>4</option>
									<option value="6" <?php if($_POST['etapas']==6) { print("selected"); } ?>>6</option>
									<option value="8" <?php if($_POST['etapas']==8) { print("selected"); } ?>>8</option>
									<option value="10" <?php if($_POST['etapas']==10) { print("selected"); } ?>>10</option>
									</select> etapas
						 
										</td>
						</form>
					</tr>
					<? 
					} ?>
		</table>
				</p></div>
</div>
<? }


if($acaom=="backup") { 
	?>
<div class="w3-card-4">
		<header class="w3-container w3-teal">
		<h1 class="w3-text-white" style="text-shadow:1px 1px 0 #444" > Backup do Banco</h1>
		</header>
			<div class="w3-container"><p></p> 
			<h3>A funcionalidade de backup está em fase de testes, para sua segurança solicite ao desenvolvedor um backup manualmente.
</h3>
			
	
        	<h3><a href="phpbackup.php"  class="w3-btn  w3-teal"  >Realizar Backup</a></p>
</h3>
					<table class="w3-table w3-striped w3-bordered">
					<tr>
						<th><h4> ID</h4> </th>
						<th><h4> DESCRIÇÃO</h4> </th>
						<th></th>
					</tr> <?php
						$msqlbk=mysqli_query($conexao,"select * from backups order by id desc");
						while($dmsqlbk=mysqli_fetch_array($msqlbk)){
						?>
					<tr>
						<td><h4> <?php echo $dmsqlbk['id']?></h4>  </td>
						<td><h4> <a href="<?php echo "db_bkp/".$dmsqlbk['arquivo_sql']; ?>"><?php echo  $dmsqlbk['arquivo_sql']; ?></a>
						(<?php echo $dmsqlbk['data']?>)</h4>  </td>
						<td><a href="?acao=apagarbackup&id=<?=$dmsqlbk['id']?>" class="w3-button w3-teal w3-border w3-border-light-grey w3-round-large"  onClick="return confirm('Deseja realmente apagar este arquivo de backup? Este processo nao permite recuperacao.')" title="Apagar"><i class="material-icons w3-xlarge">delete</i></a> 
						&nbsp &nbsp <a href="phpbackuprestaura.php?id=<?=$dmsqlbk['id']?>" class="w3-button w3-teal w3-border w3-border-light-grey w3-round-large" target="_blank" onClick="return confirm('Deseja realmente restaurar o banco para este estado? Este processo nao pemite recuperacao. Prossiga se tiver certeza de ter feito o dowload do ultimo backup.')"><i class="material-icons w3-xlarge">settings_backup_restore</i></a>
					</tr> 
					 <? } ?>
					</table>
			</p>	  				
		</div>  				
</div>
		
<? }


if($acaom=="usuarios") { 
	?>	
<div class="w3-card-4">
	<header class="w3-container w3-teal">
		<h1 class="w3-text-white" style="text-shadow:1px 1px 0 #444" > Relação de Usuários</h1>
	</header>
		<div class="w3-container"> 
		<p></p><p>O sistema que cada usuário é uma Mesa Eleitoral, portanto, cada mesa possui uma senha para acesso ao sistema. Ao criar um usuário ele constará na sessão de computo geral e precisará ser alimentado no encerramento dos trabalhos.</h3>
		<h3><button class="w3-btn w3-teal" onclick="document.getElementById('id01').style.display='block'">Novo Usuários</button></p>
				<div id="id01" class="w3-panel w3-pale-green w3-display-container" style="display:none">
 					<span onclick="this.parentElement.style.display='none'"class="w3-button w3-display-topright">X</span>
					<form name="formenvia" method="post" action="?acao=usuarioact&op=cadastrar" enctype="multipart/form-data" class="w3-container">   
						<label class="w3-text-teal"><b>Categoria</b></label> 
						<select class="w3-input w3-border w3-light-grey" name="ftipo" id="ftipo">
							<option value="correspondencia">Correspondencia</option>
							<option value="presencial">Presencial</option>
						</select> 
						<label class="w3-text-teal"><b>Mesa Nº: </b></label><input class="w3-input w3-border w3-light-grey" type="number" name="fmesa" id="fmesa" />
						<label class="w3-text-teal"><b>Usuario: </b></label><input class="w3-input w3-border w3-light-grey" type="text" name="fusuario" id="fusuario"  />
						<label class="w3-text-teal"><b>Senha:</b></label> <input class="w3-input w3-border w3-light-grey" type="password" name="fsen" id="fsen">
						<label class="w3-text-teal"><b>Repita a Senha:</b></label> <input class="w3-input w3-border w3-light-grey" type="password" name="fsen2" id="fsen2">	
						<input type="submit" name="Submit" value="Cadastrar" class="w3-btn w3-blue-grey"> 
					</form>
				</div>

				<table class="w3-table-all">
					<tr>
						<th><h4> ID</h4> </th>
						<th><h4> USUARIO/TIPO</h4> </th>
						<th><h4> OPÇÃO</h4> </th>
					</tr>
					<?php
						$msqusr=mysqli_query($conexao,"select id,usuario,tipo,nivel from admin where nivel>10 order by id desc");
						while($dmsqusr=mysqli_fetch_array($msqusr)){
					?>
					<tr>
						<td><h4> <?php echo $dmsqusr['id']?><h/4> </td>
						<td><h4> <?php echo $dmsqusr['usuario']?> (<?php echo $dmsqusr['tipo']?>)</h4> </td>
						<td><a title="Apagar"  class="w3-button w3-teal w3-border w3-border-light-grey w3-round-large"   href="?acao=usuarioact&op=excluir&codusr=<?=$dmsqusr['id']?>" onClick="return confirm('Deseja realmente apagar o usuario? Podem existir logs referente a este usuario.')"><i class="material-icons  w3-xlarge">delete</i></a></td>
					</tr>
    				<? } ?>
				</table>
	</div>
</div>
			<? 
}


if($acaom=="log") { 
	?>			
<div class="w3-card-4">
		<header class="w3-container w3-teal">
		<h1 class="w3-text-white" style="text-shadow:1px 1px 0 #444" > LOG do Sistema</h1>
		</header>
		<div class="w3-container">
		<h3>Alguns dados de operações do Sistema são armazenados em banco de dados para conferência e análise de problemas durante as operações caso ocorra.</h3>	
</h3><a href="log.php" target="_blank" class="w3-btn  w3-teal" >ABRIR LOG</a></strong></p>
				<h3> </h3>	
		</div> 
</div> 
<? } ?>