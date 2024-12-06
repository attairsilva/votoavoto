<?php
// Configuração de erro
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();

// Inclui a configuração do banco
include("config.ini.php");

// Validação inicial de entrada
$var_usuario = isset($_POST['FormUsuario']) ? trim($_POST['FormUsuario']) : null;
$var_senha = isset($_POST['FormSenha']) ? trim($_POST['FormSenha']) : null;

// Verifica se os campos estão preenchidos
if (empty($var_usuario) || empty($var_senha)) {
    $errm = "Informe os dados da credencial!";
    header("Location: error.php?status=" . urlencode($errm));
    exit;
}

try {
    // Consulta segura com prepared statements
    $sql = "SELECT id, usuario, chave, nivel, tipo FROM admin WHERE usuario = ? AND chave = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $var_usuario, $var_senha);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica o resultado
    if ($result->num_rows > 0) {
        $dados = $result->fetch_assoc();
        
        // Regenera ID de sessão
        session_regenerate_id();
        
        // Define as variáveis de sessão
        $_SESSION["login"] = $dados["usuario"];
        $_SESSION["nv"] = $dados["nivel"];
        $_SESSION["tp"] = $dados["tipo"];
        $_SESSION["idu"] = $dados["id"];
        $_SESSION["id"] = session_id();
        
        // Redireciona para a página inicial
        header("Location: index.php");
        exit;
    } else {
        $errm = "Credenciais inválidas!";
        header("Location: error.php?status=" . urlencode($errm));
        exit;
    }
} catch (Exception $e) {
    // Log de erro (opcional)
    error_log("Erro ao validar usuário: " . $e->getMessage());
    $errm = "Erro ao processar a solicitação.";
    header("Location: error.php?status=" . urlencode($errm));
    exit;
}
 
// error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
// session_start();
 

 

// 	$var_usuario=$_POST['FormUsuario'];
// 	$var_senha=$_POST['FormSenha'];


// 			$_SESSION['captcha'] = " ";
			
// 			include("config.ini.php");
		 	
// 			$sql="select id,usuario,chave,nivel,tipo from admin where usuario='$var_usuario' and chave='$var_senha'";
			
// 			$rs=mysqli_query($conexao,$sql);

// 			$contador=0;

// 			if(!$rs) { 	
// 				$errm="Erro logando! ".mysqli_connect_error(); 
// 				echo $errm;
// 			}else{

// 				while($dados=mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
// 					$contador=$contador+1;
// 					$print_usuario=$dados["usuario"];
// 					$nv=$dados["nivel"]; 
// 					$tp=$dados["tipo"];
// 					$idu=$dados["id"]; 
					
// 				}
// 			}

			

// 			if ($contador > 0) {
			
// 						$r=session_id();
// 						$_SESSION["login"] = $print_usuario;
// 						setcookie("loginn","$print_usuario",0);
// 						$_SESSION["nv"] = $nv;
// 						$_SESSION["tp"] = $tp;
// 						$_SESSION["idu"] = $idu;
// 						$_SESSION["id"] = $r;		
						
// 						echo "<script>document.location='index.php'</script>";
					 
						
// 			}else {

// 					if($var_usuario==NULL){
// 						$errm="Informe os dados da credencial! ";
// 					}else{
// 						$errm="Erro logando! ";
// 					 }
					
				 
// 					 echo "<script>document.location='error.php?status=".$errm."'</script>";
						
// 			}

// 			//echo $errm;


?>

