<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Votações 2018 - SysVOTO - V.01.beta</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <style type="text/css">
<!--
.style1 {
	font-size: 18px
}
.style2 {font-size: 24px}
-->
    </style>
</head>
<body>
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
			<h1><a href="#">SISTEMA DE VOTAÇÃO</a></h1>
			<div id="top-navigation">Bem vindo(a) <strong>
			   <?  

$adm_usuario=$_COOKIE[login];
$nivel=$_COOKIE[nivel];
$tp=$_COOKIE[tp];
include("config.ini.php");
include("sec.php");
echo $adm_usuario."(<a href='alterarpass.php'>alterar senha</a>)";
?>
			</strong>
				<span>|</span>
				<a href="#">Ajuda</a>
				<span>|</span>
				<a href="#">Configurações</a>
				<span>|</span>
			<a href="logout.php">Sair</a></div>
		</div>
		<!-- End Logo + Top Nav -->
		
		<!-- Main Nav -->
		<? include("barramenu.php"); ?>
		<!-- End Main Nav -->
	</div>
</div>
<!-- End Header -->

<!-- Container -->
<div id="container">
	<div class="shell">
		
		<!-- Small Nav -->
		<div class="small-nav"></div>
		<!-- End Small Nav --><!-- Main -->
		<div id="main"><!-- Content -->
			<div id="content">
				
				<!-- Box --><!-- End Box -->
				
				<!-- Box -->
				<div class="box">
					<!-- Box Head --><!-- End Box Head -->
					
			
						
						<!-- Form -->
					<div class="form">
					  <p class="inline-field">                      
					  <h2>&nbsp;</h2>
					  <p align="center" class="style2">TROCAR USUARIO ou SENHA</p>
					  <p>&nbsp;</p>
					  <div align="center">  <?
					   if($_GET[act]=="ok" && $_GET[tipo]==1) { 
					   
					  $f_senha_antiga=$_POST[f_senha_antiga];
					  $f_senha_nova=$_POST[f_senha_nova];
					  $f_senha_rnova=$_POST[f_senha_rnova];
					  
					  if($f_senha_nova=="") { $msg="- Informe uma senha.<br>"; }
					  if($f_senha_rnova=="") { $msg=$msg."- Repita a senha no campo solicitado.<br>"; }
					  if($f_senha_nova!=$f_senha_rnova) { $msg=$msg."As novas senhas criadas diferem, verifique se as digitou corretamente!"; }
					  
					  if($msg==NULL) {
						  $spass=mysql_fetch_array(mysql_query("select id, usuario, chave, tipo from admin where 
						  usuario='$adm_usuario' and chave='".$f_senha_antiga."'"));
						  if($spass[id]!="") {
						  
								$sqlup=mysql_query("UPDATE admin SET 
								chave='$f_senha_nova' 
								WHERE usuario='$adm_usuario'");
								
								if(!$sqlup) { $msg="Erro no MySQL ao realizar atualização de sua senha.<br>"; }
								else{ $msg="<b>A sua senha foi alterada com sucesso!<br />
											Em 5 segundos você será deslogado para acessar com o sua nova senha!</b><br>"; 
								
								     $sp="ok";
								 }
								
						  }
					   }
					  
					  echo $msg;
						  if($sp=="ok") {
									//////
									//sleep(5);
									unset($_COOKIE['login']);
									unset($_COOKIE['nivel']);
									unset($_COOKIE['cookielogado']);
									setcookie("cookielogado","nao",0);
									setcookie("login","0",0);
									setcookie("nivel","0",0);
									header("location:error.php");
									
									//////
						  }
					  ?><br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <? } 


?><table border="1" align="center">
                      <form action="alterarpass.php?act=ok&tipo=1" name="form1" method="post">
                        <tr>
                          <td height="0" colspan="2"><div align="center"><strong>MUDANDO SENHA</strong></div></td>
                        </tr>
                        <tr>
                          <td width="0" height="0"><div align="right">Senha antiga:</div></td>
                          <td width="0" height="0"><input name="f_senha_antiga" type="password" id="f_senha_antiga" size="12" maxlength="12" /> 
                          (no mímino 12 digitos)</td>
                        </tr>
                        <tr>
                          <td width="0" height="0"><div align="right">Nova senha:</div></td>
                          <td width="0" height="0"><input name="f_senha_nova" type="password" id="f_senha_nova" size="12" maxlength="12" />
                          (no mímino 12 digitos)</td>
                        </tr>
                        <tr>
                          <td width="0" height="0"><div align="right">Repita nova senha:</div></td>
                          <td width="0" height="0"><input name="f_senha_rnova" type="password" id="f_senha_rnova" size="12" maxlength="12" />
                          (no mímino 12 digitos)</td>
                        </tr>
                        <tr>
                          <td width="0" height="0">&nbsp;</td>
                          <td width="0" height="0"><input type="submit" name="button" id="button" value="Alterar" /></td>
                        </tr>
                        </form>
                      </table>
					  <p>
					  <?
					  
 if($_GET[act]=="ok" && $_GET[tipo]==2) { 
					 echo "<br />
<br /><br />
<br />";  
					  $f_usernovo=$_POST[f_usernovo];	
					  			  
					  if($f_usernovo=="") { $msg="- Informe um novo usuário.<br>"; }
					 					  
					  if($msg==NULL) {
						 
						  $spass=mysql_fetch_array(mysql_query("select id, usuario, chave, tipo from admin where usuario='$f_usernovo' "));
						  
						  if($spass[id]=="") {
						  
								$sqlup=mysql_query("UPDATE admin SET usuario='$f_usernovo' WHERE usuario='$adm_usuario'");
								
								if(!$sqlup) { $msg="Erro no MySQL ao realizar atualização do nome de usuário.<br>"; }
								
								else{ $msg="<b>O seu nome de usuário foi alterada com sucesso!<br />
											Em 5 segundos você será deslogado para acessar com o seu novo usuário!</b><br>"; 
								
											$sp="ok";
								
								
								}
								
						  }else{
						  	$msg=$msg."- Usuário já existe, escolha um outro.<br>";
						  }
					   }
					  
					  	
					  echo $msg;
					  				if($sp=="ok") {
									//////
									//sleep(5);
									unset($_COOKIE['login']);
									unset($_COOKIE['nivel']);
									unset($_COOKIE['cookielogado']);
									setcookie("cookielogado","nao",0);
									setcookie("login","0",0);
									setcookie("nivel","0",0);
									header("location:error.php");
									
									//////
						 			 }

					  ?>
<br />
<br />

<? } ?></p>
					  <table border="1" align="center">
                        <form action="alterarpass.php?act=ok&tipo=2" method="post" name="form1" id="form1">
                          <tr>
                            <td height="0" colspan="2"><div align="center"><strong>MUDANDO USUÁRIO</strong></div></td>
                          </tr>
                          <tr>
                            <td width="106" height="0"><div align="right">Usuário atual:</div></td>
                            <td width="218" height="0"><?=$adm_usuario?></td>
                          </tr>
                          <tr>
                            <td width="106" height="0"><div align="right">Novo usuário:</div></td>
                            <td width="218" height="0"><input name="f_usernovo" type="text" id="f_usernovo" size="30" /></td>
                          </tr>

                          <tr>
                            <td width="106" height="0">&nbsp;</td>
                            <td width="218" height="0"><input type="submit" name="button2" id="button2" value="Alterar" /></td>
                          </tr>
                        </form>
					    </table>
					  <p>&nbsp;</p>
					  <p>&nbsp;</p>
					  </div>
					
					  <p align="center" class="style1">&nbsp;</p>
					  <p>&nbsp;</p>
					  <p>&nbsp;</p>
					  <p>&nbsp;</p>
					  <p>&nbsp;</p>
					  <p>&nbsp;</p>
			     </p>
						   <p class="inline-field">&nbsp;</p>
				    </div>
<!-- End Form -->
						
					  <!-- Form Buttons --><!-- End Form Buttons -->
					
				</div>
				<!-- End Box -->

			</div>
			<!-- End Content -->
			
			<!-- Sidebar --><!-- End Sidebar -->
			
		  <div class="cl">&nbsp;</div>			
		</div>
		<!-- Main -->
	</div>
</div>
<!-- End Container -->

<!-- Footer -->
<div id="footer">
	<div class="shell">
		<span class="left">&copy; 2018 - Attair Silva -  Suporte (65) 928161-4053</span>
		<span class="right">
			Design by <a href="http://chocotemplates.com" target="_blank" title="The Sweetest CSS Templates WorldWide">Chocotemplates.com</a>
		</span>
	</div>
</div>
<!-- End Footer -->
	
</body>
</html>