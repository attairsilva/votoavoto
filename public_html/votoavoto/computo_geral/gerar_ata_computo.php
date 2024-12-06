<? 
header("Content-Type: application/vnd.ms-Word");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
$dthr=date('YmdHis');
header("content-disposition: attachment;filename=Relatorio_".$dthr.".doc");

set_time_limit(1000);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
setlocale(LC_TIME, 'portuguese'); 
date_default_timezone_set('America/Sao_Paulo');

include("sec.php");

include("functions.php");
 
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>

<head>
</head>

<body>
<? 
   
   Setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
   date_default_timezone_set('America/Sao_Paulo');

	$idc=$_GET['idc'];
 
	$dtp="SELECT * FROM ata_computo_geral  WHERE id='$idc'";
	$ddtp=mysqli_fetch_array(mysqli_query($conexao,$dtp));
	$municipio=$ddtp['municipio'];
	$estado=$ddtp['estado'];
	$qtd_urnas=$ddtp['qtd_urnas'];
	$data=$ddtp['data'];	
	$dta=explode(' ',$data);
	$hora=$dta[1];
	$ndata=$dta[0];
	$dateformated= strftime('%A, %d de %B de %Y',strtotime($ndata));
	$hr=explode(':',$hora);
	$hora=$hr[0]."h".$hr[1];
	$regional=$ddtp['crefito'];	
	$regionald=$ddtp['crefitod'];	
	$quadrienio_n1=$ddtp['quadrienio_n1'];	
	$quadrienio_n2=$ddtp['quadrienio_n2'];	
	$idchapaeleita=$ddtp['id_chapaeleita'];	
    $dhf=$ddtp['data_hora_fim'];
	$rdhf=explode(':',$dhf);
	$computo_horafim=$rdhf[0].'h'.$rdhf[1];	
	
	$tabinfra=$tabinfra."<table style='text-align: justify; line-height: 130%; display:block; font-size:13.0pt; font-family:\"Times\",\"serif\"' ><tr align='justify'>
	  <td>
	      <b> 
		  ATA DOS TRABALHOS DE CÔMPUTO GERAL E PROCLAMAÇÃO DOS RESULTADOS FINAIS DA ELEIÇÃO DO XXXXX – ".$regional." PARA O QUADRIÊNIO ".$quadrienio_n1."-
		  ".$quadrienio_n2."
		  </b>	  
	  </td>
	 </tr>
	 <tr><td>
	 Às <b>".$hora."</b> horas de <b>".$dateformated."</b>, no local de votação, nesta cidade de <b>".$municipio."/".$estado."</b>, a Comissão Eleitoral, 
	 declarou aberto os trabalhos de cômputo geral e proclamação do resultado final da eleição realizada neste mesmo dia. 
	 Foram apuradas <b>".$qtd_urnas." urnas</b>. Cada uma das urnas apresentaram os seguintes resultados: 
	</td></tr>";
	 
  
	  /// mostra
	  
	   $dtcmp="SELECT * FROM admin WHERE tipo<>'admin' ORDER BY id";
	   $dcmp=mysqli_query($conexao,$dtcmp);
	   while($ddcmp=mysqli_fetch_array($dcmp)){
		   
			  $idmesa=$ddcmp['id'];
			  $nmr=$ddcmp['mesa'];
			  $nmr = str_pad($nmr, 2, '0', STR_PAD_LEFT); 

		      $tabinfra=$tabinfra."<tr><td style='padding: 5px;'>
			  	<p style='margin-left: 5%;' >
				
				<i> Mesa nº ".$nmr." de votos por <i>".$ddcmp['tipo']."</i>, sendo ";
			  // voto tipo
			  $dtvv="SELECT * FROM voto_tipo ORDER BY id,id_chapa";
			  $dtv=mysqli_query($conexao,$dtvv);
			  while($ddtv=mysqli_fetch_array($dtv)){
				$idtpvotob=$ddtv['id'];
				$dstpvotob=$ddtv['descricao'];
				/// soma
				$dtcmpp="SELECT * FROM  computo_mesas WHERE id_admin='".$idmesa."'";
				$dcmpp=mysqli_query($conexao,$dtcmpp);
				while($ddcmpp=mysqli_fetch_array($dcmpp)){
					$idvtp=$ddcmpp['id_voto_tipo'];
					if($ddcmpp['id_voto_tipo']==$idtpvotob) {
						$somatpo=$somatpo+$ddcmpp['qtd_voto'];						
						$totalmesa=$totalmesa+$ddcmpp['qtd_voto'];
						$totalgeral=$totalgeral+$ddcmpp['qtd_voto'];
						if($ddcmpp['id_voto_tipo']==1) { 
							$totalbranco=$totalbranco+$ddcmpp['qtd_voto'];
						}elseif($ddcmpp['id_voto_tipo']==2) { 
							$totalnulo=$totalnulo+$ddcmpp['qtd_voto'];
						}
						
					}
				}
				$tabinfrav=$tabinfrav."<b>".$somatpo."</b> voto(s) ". $dstpvotob.", ";
				$somatpo=0;
				
			 }	
			 //// fim voto tipo

			 //// inicio voto chapa
			 $dtvvc="SELECT * FROM chapas ORDER BY id";
			 $dtvc=mysqli_query($conexao,$dtvvc);
			 while($ddtvc=mysqli_fetch_array($dtvc)){
			    $idtpvotobc=$ddtvc['id'];
				$number=$ddtvc['numero'];
				$number = str_pad($number, 2, '0', STR_PAD_LEFT); 
			    $dstpvotobc="Chapa nº ".$number;
			    $idchapa=$ddtvc['id'];
				/// soma
				$dtcmppc="SELECT * FROM  computo_mesas_chapas WHERE id_admin='".$idmesa."' AND id_chapa='".$idchapa."'";
				$ddcmppc=mysqli_fetch_array(mysqli_query($conexao,$dtcmppc));
				$idvtpc=$ddcmppc['id_chapa'];
				if($idvtpc>0) {
						$somatpoc=$somatpoc+$ddcmppc['qtd_voto'];						
						$totalmesa=$totalmesa+$ddcmppc['qtd_voto'];
						$totalgeral=$totalgeral+$ddcmppc['qtd_voto'];
						$$total_chapa[$idvtpc]=$$total_chapa[$idvtpc]+$ddcmppc['qtd_voto'];			
				}
				$tabinfrav=$tabinfrav."<b>".$somatpoc."</b> voto(s) ". $dstpvotobc.", ";
				$somatpoc=0;
			 }
			 //// fim voto chapa

			 $tabinfra=$tabinfra.$tabinfrav.' totalizando <b> '.$totalmesa.'</b>  votos. </i>
			 
			 </p></td></tr>';
			 $totalmesa=0;
			 $tabinfrav="";
			
			 
	  	}
	
	  

	
	$tabinfra=$tabinfra."<tr><td>
	A soma das parciais de cada uma das urnas totalizou <b>".$totalgeral." votos</b>, configurando o seguinte resultado:  ";

	$qtch=mysqli_query($conexao,"SELECT * FROM  chapas ORDER BY id");
    while($dtch=mysqli_fetch_array($qtch)){
		$idccp=$dtch['id'];
		$ddccp=$dtch['descricao'];
		$nnccp=$dtch['numero'];
		$tabinfra=$tabinfra.' <b>'.$$total_chapa[$idccp].'</b> voto(s) para <b>Chapa  '.$nnccp.'</b>; ';
	}
	$tabinfra=$tabinfra.' <b>'.$totalbranco.'</b> voto(s)  branco(s) e <b>'.$totalnulo.'</b> voto(s) nulo(s). </td></tr>';
	
	
	if($idchapaeleita>0){
		$dtce="SELECT * FROM chapas  WHERE id='$idchapaeleita'";
		$ddctp=mysqli_fetch_array(mysqli_query($conexao,$dtce));
		$tabinfra=$tabinfra."<tr><td>
		Em consequência, foi proclamada eleita a <b>Chapa nº ".$ddctp['numero']." - \"".$ddctp['descricao']."\"</b>, composta pelos seguintes profissionais: ";
		$qMch=mysqli_query($conexao,"SELECT * FROM  chapas_membros WHERE id_chapa=".$ddctp['id']." ORDER BY ord");
		while($dMch=mysqli_fetch_array($qMch)){
			$tabinfra=$tabinfra.$dMch['nome'].'- '.$regionald.'/'.$dMch['crefito'].', ';
		}
		$tabinfra=substr($tabinfra, 0, -2);
		$tabinfra=$tabinfra.". </td></tr>";
	}
	

		$tabinfra=$tabinfra."<tr><td>Concluídos os trabalhos às ".$computo_horafim." 
		horas e nada mais havendo neste momento, o(a) Presidente determinou a lavratura desta ata, a qual assinam todos os presentes.</td></tr>";
 		
		$tabinfra=$tabinfra."<tr><td><br><br>";

		$qMech=mysqli_query($conexao,"SELECT * FROM comissao_eleitoral ORDER BY id");
		while($dMech=mysqli_fetch_array($qMech)){
			$tabinfra=$tabinfra."<p align='center'>_________________________________________________<br><b>".$dMech['nome']."</b><br>
				".$dMech['funcao']." da Comissão Eleitoral -".$regional."<br><br><br><br></p>";
		}

	
		$dtcer="SELECT * FROM chapas ";
		$relchp=mysqli_query($conexao,$dtcer);
		while($ddctpr=mysqli_fetch_array($relchp)){
			$qMchr=mysqli_query($conexao,"SELECT * FROM  chapas_membros WHERE id_chapa=".$ddctpr['id']." AND rep>0 ORDER BY id");
			while($dMchr=mysqli_fetch_array($qMchr)){
				$tabinfra=$tabinfra."<p align='center'>_________________________________________________<br>
				<b>".$dMchr['nome']." -".$regionald."/".$dMchr['crefito']."</b><br>
				Representante da Chapa Nº ".$ddctpr['numero']."<br><br><br><br></p>";

				
				if($ddctpr['adv_nome']!=NULL){
					$tabinfra=$tabinfra."<p align='center'>_________________________________________________<br>
					<b>".$ddctpr['adv_nome']." - ".$ddctpr['adv_inscricao']."</b><br>
						Advogado da Chapa Nº ".$ddctpr['numero']."<br><br><br><br></p>";
				}
			}
		}

	$tabinfra=$tabinfra.'</td></tr></table>';

	echo $tabinfra;

?>
	
</body>

</html>
