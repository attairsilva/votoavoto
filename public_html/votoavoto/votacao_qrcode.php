<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
include("sec.php");
include("config.ini.php");
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
     <meta http-equiv="X-UA-Compatible" content="chrome=1">
	<title>Votações 2018 - SysVOTO - V.01.beta</title>
	<script type="text/javascript" src="instascan.min.js"></script>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<style type="text/css">
<!--
.style3 {font-size: 14px; color:#000000}
-->
#preview{
   width:500px;
   height: 500px;
   margin:0px auto;
}
</style>  
<script>
function limpa() {
if(document.getElementById('busca').value!="") {
document.getElementById('busca').value="";
document.getElementById('busca').focus();
}
}
</script>
</head>
<body>
<?php 
$busca=$_POST["busca"];
if($busca==NULL) { 
	$busca=$_GET["busca"];
}
?>
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
		  <h1><a href="#">CONTROLE DE VOTOS</a></h1>
		  <div id="top-navigation">Bem vindo(a) <strong>
			   <?  
echo $adm_usuario."(<a href='alterarpass.php'>alterar senha</a>)";
?>
			</strong>
				 
				<span>|</span>
			<a href="logout.php">Sair</a></div>
		</div>
		<!-- End Logo + Top Nav -->
		
		<!-- Main Nav -->
		<?php include("barramenu.php"); ?>
		<!-- End Main Nav -->
	</div>
</div>
<!-- End Header -->

<!-- Container -->
<div id="container">
	<div class="shell">
		
		<!-- Small Nav -->
		<div class="small-nav">
        <?php
		////
		//// se busca diferente de vazio
		//// entra na busa
		if($busca!=NULL) {
			
				/// se ainda não confirmou busca, procura
				if($_GET["confirma"]!="ok") {
				
					$sqlq="SELECT p.id_inscricao, p.nome, p.crefito, p.votou 
						FROM enviados AS e LEFT JOIN profissionais AS p ON e.crefito = p.crefito
						WHERE (p.id_inscricao like '$busca%' OR p.nome like '%$busca%' 
					    OR p.crefito like'$busca%') AND p.votou='sim'";
					
					$sqldver=mysql_fetch_array(mysql_query($sqlq));
					$total=mysql_num_rows(mysql_query($sqlq));
						
					
					// verifica se o codigo, nome ou inscricao ja encontra-se registrado
					// se o total é menor que um, é porque não foi registrado o recebimento do votou
					if($total<1) {
						
						$sqlq="SELECT p.id_inscricao, p.nome, p.crefito, p.votou
						FROM enviados AS e
						LEFT JOIN profissionais AS p ON e.crefito = p.crefito
						WHERE (p.id_inscricao like '$busca%' OR p.nome like '%$busca%' OR p.crefito like'$busca%')";
						
						$sqldv=mysql_fetch_array(mysql_query($sqlq));
						$total=mysql_num_rows(mysql_query($sqlq));
						
						 
						// se o codigo, nome o inscricao não se encontra na relação de votantes
						// veririfica se foi encontrado apenas um registro  
						if($total==1) {	
						
							if ($sqldv["id_inscricao"]==NULL) {
								
									 $bgc="msg-error";
									 $msg="<b>Profissional não foi localizado no banco 
									 de dados!</b>";
									 
							}else{
									 $bgc="msg-ok";
									 $msg="<font  size=4><b>".$sqldv[nome]." - Crefito-9/".$sqldv[crefito]."</b></font><br><br>Você confirma o recebimento do 
									 VOTO?<br><br><a href='votacao.php?busca=".$sqldv[crefito]."&confirma=ok'><font color='blue' size=3 accesskey='S'>SIM </font></a> 
									 (Teclado de atalho: Alt + S) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='votacao.php'>
									 <font color='red' size=3 accesskey='N'>NÃO</font></a> (Teclado de atalho: Alt + N)
									<br><br>";
							}
						
						// se foi encontrado mais de um registro	
						}elseif($total>1){
							
								 $bgc="msg-error";
								 $msg="<b>Refine um pouco mais a busca, foram encontrados mais de ".$sqldv[total]." registros com esta informação!</b>";
						
						//se ninguem foi encontrado	 
						}elseif($total==NULL){
							
								 $bgc="msg-error";
								 $msg="<b>Código de Barras, Nome ou Inscrição [".$busca."] não foi localizado!</b><br>
								 Obs: <i>O profissional não consta na relação de envio de envelopes!</i><br>";
								 
						}
						
					// se o total é 1 ou mais é porque ja foi registrado o recebimento do voto
					}else{
								 $bgc="msg-error";
								 $msg="<b>".$sqldver[nome]." - Crefito-9/".$sqldver[crefito]."</b><br><br>
								 Este profissional já teve o seu voto computado!
								<br><br>";
					}
				
				/// se é uma confirmação, confirma o recebimento	
				}else{
					
					$tipo="correspondencia";
					$didu=mysql_fetch_array(mysql_query("SELECT  id,usuario 
					FROM admin WHERE usuario='".$adm_usuario."'"));
					$idu=$didu["id"];
					// hora do servidor
					$datahora=date('Y-m-d H:i:s');
					// altera  alvo da busca para sim
					$sqlaq="
					UPDATE 
						profissionais 
					SET 
					 votou='sim', 
					 forma='$tipo', 
					 id_usuario='$idu', 
					 data_horario='$datahora' 
					WHERE 
					 crefito like '$busca'";
					$sqla=mysql_query($sqlaq);
					
					// pega o numero do crefito					
					$dsqls=mysql_fetch_array(mysql_query("SELECT  id_inscricao, 
					crefito FROM profissionais WHERE id_inscricao like '$busca'"));
					$ncrefito=$dsqls["crefito"];
					
					// se a query foi executada com sucesso, 
					// seta o voto como sim na tabela enviados
					// se não, informa que ocorreu um erro ao confirmar
					if($sqla) {	
						$msg="<b>Voto computado com sucesso!</b>"; 
						$bgc="msg-ok"; 
						$sqla=mysql_query("UPDATE enviados SET votou='sim'
						WHERE crefito='$ncrefito'");
					}else { 
						$bgc="msg-error"; 
						$msg="<b>O voto não foi  computado, erro ao
						 confirmar!</b><br><br>".$sqlaq.mysql_error(); 
					} 
					
				
				}
	
?>
        <div class="msg <?php print($bgc); ?>">
          <p><strong><?php print($msg); ?></strong></p>
          <a href="votacao.php" class="close">close</a> </div>
<?php } ?>       
      </div>
		<!-- End Small Nav -->
<?php if($sqldv["id_inscricao"]=="") { ?>	
		
<div class="box">



		      <!-- Box Head -->
		      <div class="box-head">
		      <h2>LOCALIZAR PROFISSIONAL</h2>
	          </div>
		      <!-- End Box Head-->
               <div class="box-content">
               

 
    <video id="preview"></video>
    <script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        console.log(content);
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    </script>
 
             
<br />
[<a href="?view=content">Ver log registro</a>] [<a href="dashboard.php" target="_blank">Ver Grafico da Votação</a>]<br />
<br />


</div>
             
	  </div>
      
      <?php 
} ?>
        
            
		
        
		<!-- Main -->
		<div id="main">
		  <!-- Content -->
		  <?php if($view=="content") { 
			
			?>
	  <div id="content">
				
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						Profissionais no sistema
						  <div class="right">
							<form id="form2" name="form2" method="post" action="">
							</form>
						</div>
					</div>
	        <!-- End Box Head -->	

					<!-- Table -->
					<h2>&nbsp;</h2>
				  <p> <br /></p>
					<div class="table">
						<table width="100%"   cellspacing="0" cellpadding="0" >
                        
	
							<?php
							
	$sqlp=" SELECT p.id_inscricao, p.nome, p.crefito, p.votou ,p.forma, p.id_usuario, p.data_horario	FROM enviados  AS e LEFT JOIN profissionais AS p ON e.crefito = p.crefito WHERE p.nome<>''  ORDER by p.nome";
	
	//echo '<br>SQL: '.$sql.'<br>Ano: '.$fano;
					
			$qprocessos=mysql_query($sqlp);				
			if(!$qprocessos) { echo 'Erro: '.mysql_error(); }
			while($dadosp=mysql_fetch_array($qprocessos)){
				$x=$x+1;
				
				
				
				if($x%2==0) { $cor="#FFFFFF"; }
				else{
								$cor="#FFFFCC";
				}	
				
				if($dadosp["votou"]=="sim") { $cor="#B1E2FC"; }
							?>
							
							<tr>
							  <td width="1%" height="1" style="background:<?=$cor?>;   border-bottom:#900 2px;">&nbsp;</td>
						      <td width="66%" height="1" style="background:<?=$cor?>;   border-bottom:#900 2px;"><?php print($dadosp["nome"]." - CREFITO ".$dadosp[crefito]." - ID da inscrição: ".$dadosp["id_inscricao"]);?></td>
						      <td width="33%" height="1" style="background:<?=$cor?>;   border-bottom:#900 2px;"> <?php
                              $sqlusr=mysql_fetch_array(mysql_query("select id,usuario,tipo from admin where id='".$dadosp["id_usuario"]."'"));
							  if($dadosp[forma]!=NULL) { 
							   $datetime = $dadosp["data_horario"];
								$orgdate = date("d/n/Y H:i ", strtotime($datetime ));
							
							  print ("Voto ".$dadosp["forma"]." <br><id> Registrado por [".$sqlusr[usuario]."] <br>".$orgdate."</i>"); }else{ print("----------------------");;} 
							  ?></td>
						  </tr>
							
							<?php } ?>
						</table>
						
						
					  <!-- Pagging -->
					  <div class="pagging"></div>
						<!-- End Pagging -->
						
					</div>
					<!-- Table -->
					
				</div>
<!-- End Box -->
				
				<!-- Box --><!-- End Box -->

			</div>
	    <!-- End Content -->
            <?php } ?>
			
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