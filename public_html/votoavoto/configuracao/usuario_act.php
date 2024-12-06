<?php
if($_GET['op']=="cadastrar") { 

	//Lança novo usuario no banco
	$fsen=$_POST['fsen'];
	$fsen2=$_POST['fsen2'];
	$fusuario=$_POST['fusuario'];
	$fmesa=$_POST['fmesa'];
	$ftipo=$_POST['ftipo'];
	

	$bmsql=mysqli_fetch_array(mysqli_query($conexao,"select id, usuario from admin where usuario='$fusuario' OR mesa='$fmesa'"));
	if($bmsql['id']!=NULL) { $errof=$errof."Já existe um usuario [<b>$fusuario</b>] ou mesa [<b>$fmesa</b>]  informado, escolha outro.<br>"; }
	if($fsen!=$fsen2) { $errof=$errof."Erro ao repetir a senha, confira se digitou corretamente.<br>"; }
	
	if($errof==NULL) {
		

		$sql = "INSERT INTO admin (usuario, chave, tipo, mesa, nivel) VALUES (?, ?, ?, ?, ?)";
		$stmt = $conexao->prepare($sql);
		if ($stmt === false) {
			die("Erro na preparação da query: " . $conexao->error);
		}
		$stmt->bind_param("sssss", $fusuario, $fsen, $ftipo, $fmesa, $nivel);
		$nivel = 11;  // Definindo o valor de nível
		$stmt->execute();
		

		if($stmt->affected_rows > 0) { 
			$msg="<font color=green>Usuario cadastrado com sucesso!</font><br>
			Redirecionando... "; 
			//iniciolog
				$datalog=date('Y-m-d H:i:s');
				$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
				VALUES('$idu','Criou um novo usuario no sistema: $fusuario - $ftipo - $msg','$datalog')");
			//fimlog	
			
		}else{ 
			$msg="<font color=red>Ocorreu um erro ao cadastrar usuario:</font> ".mysqli_error($conexao)."
			<br>Redirecionando.. . "; 
		}
		
	}else{
		$msg="<font color=red>".$errof."</font><br>Redirecionando.. . 
		";
	}
}
elseif($_GET['op']=="excluir") {
	
	$codusr=$_GET['codusr'];
	$bmsqlu=mysqli_fetch_array(mysqli_query($conexao,"select id, usuario, tipo from admin where id=$codusr"));
	$nmusu=$bmsqlu['usuario'];
	$tpusu=$bmsqlu['tipo'];
	
	if($_GET['cnf']!="excluirsim") {
		$bmsql=mysqli_fetch_array(mysqli_query($conexao,"select id, id_usuario from log where id_usuario=$codusr"));
		if($bmsql['id']>0) { 
			$msg=$msg."<br><font color=red>Existe LOG para este usuário, ao apagar perdera o relacionamento com estes LOGs!</font>"; 
		}
		$cbmsql=mysqli_fetch_array(mysqli_query($conexao,"select id, id_admin from computo_mesas where id_admin=$codusr"));
		if($cbmsql['id']>0) { 
			$msg=$msg."<br><font color=red>Existem registros lançados na apuração para esta mesa, ao apagar estes registros também serão deletados!</font>"; 
		}
		$msg=$msg."<br><br><a href='?acao=usuarioact&op=excluir&cnf=excluirsim&codusr=$codusr'><b>Clique aqui para confirmar a exclusão mesmo assim</b></a>";
	}else{
		    $excuser=mysqli_query($conexao,"delete from admin where id=$codusr");
			$excuser2=mysqli_query($conexao,"delete from computo_mesas where id_admin=$codusr");
	}
	if($excuser!=NULL){ 
			if(!$excuser) { 
				$msg="<font color=red>Erro ao apagar o usuario no banco: </font>".mysqli_error($conexao)."<br>
				Redirecionando... ";
			}else{
				$msg="<font color=green>Usuario foi apagado!</font><br>
				Redirecionando...  "; 
				//iniciolog
				$datalog=date('Y-m-d H:i:s');
				$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
				VALUES('$idu','Apagou usuario do sistema: $nmusu - $tpusu - $msg','$datalog')");
				//fimlog	
			}
	}
}


?>

<meta http-equiv="refresh" content="5; URL=index.php"/>
 


