<div align="center">
<?php

include("config.ini.php");

function sanitizeString($string) {

    // matriz de entrada
    $what = array( '�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�',' ','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','�','�' );

    // matriz de sa�da
    $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','A','A','E','E','E','I','I','O','O','O','O','U','U','n','N','c','C',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ' );

    // devolver a string
    return str_replace($what, $by, $string);
}

function fgetss_custom($file) {
    $line = fgets($file); // Lê uma linha do arquivo
    if ($line === false) {
        return false; // Retorna false se não houver mais linhas
    }
    
    // Remove as tags HTML e PHP e escapa caracteres especiais
    return htmlspecialchars(strip_tags($line));
}

function limpar_string($string) {
        if($string !== mb_convert_encoding(mb_convert_encoding($string, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32'))
            $string = mb_convert_encoding($string, 'UTF-8', mb_detect_encoding($string));
        $string = htmlentities($string, ENT_NOQUOTES, 'UTF-8');
        $string = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\1', $string);
        $string = html_entity_decode($string, ENT_NOQUOTES, 'UTF-8');
        $string = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), ' ', $string);
        $string = preg_replace('/( ){2,}/', '$1', $string);
        $string = strtoupper(trim($string));
        return $string;
}

$id=$_POST["id"];
$msg="<br><br>ID A SER PROCESSADO: ".$id."<br>";
$sql="select id,link from  arquivos_csv where id='$id'";
$rs=mysqli_query($conexao,$sql);
$dados=mysqli_fetch_array($rs);
$arquivocsv=$dados['link'];
$meuArray = file("$arquivocsv");
for($n=0; $n < count($meuArray); $n++)
{}
$c=$n-1;
$qtdo=$_POST["etapas"];
$nn=$c/$qtdo;
$nn=ceil($nn);
$msg=$msg."<br>Diretorio [".$arquivocsv."] com cerca de [".$n."] linhas.<br><br>Em  processamento ".$qtdo." etapas com ".$nn." registros cada, conforme abaixo:<br><br>";
@$abre = fopen("$arquivocsv","r");

if (!$abre) { 
	$msg=$msg.'<p align=\"center\">Não encontrado o arquivo<br><br> <br>'; 
	exit; 
}

//$apaganow=mysql_query("delete from  incorp_dados");

$grava = 'insert into profissionais (crefito, nome, votou) values ';
$grave = 'insert into profissionais_enderecos (crefito, logradouro, numero, complemento, bairro, municipio, estado, CEP) values ';

$crg=0;

for ($i=0; $i < $n; $i++)
{
	$crg=$crg+1;
	$crgt=$crgt+1;
	$le = fgetss_custom($abre,1024); // Le o arquivo e retorna linha por linhechoddddd

	$le = explode(";",$le);
	$lido1="";$lido2="";$lido3="";$lido4="";$lido5="";$lido6="";$lido7="";$lido8="";$lido9="";
	$lido1 = strtoupper(trim($le[0])); // Numero Inscricao
	$lido2 = sanitizeString(strtoupper(trim($le[1]))); // Nome
	$lido3 = sanitizeString(strtoupper(trim($le[2]))); // Logradouro
	$lido4 = sanitizeString(strtoupper(trim($le[3]))); // Numero
	$lido5 = sanitizeString(strtoupper(trim($le[4]))); // Complemento
	$lido6 = sanitizeString(strtoupper(trim($le[5]))); // Bairro
	$lido7 = sanitizeString(strtoupper(trim($le[6]))); // Municipio
	$lido8 = sanitizeString(strtoupper(trim($le[7]))); // Estado
	$lido9 = sanitizeString(strtoupper(trim($le[8]))); // CEP
	//echo  stripslashes($lido1).'","'.stripslashes($lido2)."<br>";

	
	$gravab = $gravab.'  ("'.stripslashes($lido1).'","'.stripslashes($lido2).'","nao"),';
	$gravae = $gravae.'  ("'.stripslashes($lido1).'","'.stripslashes($lido3).'","'.stripslashes($lido4).'","'.stripslashes($lido5).'","'.stripslashes($lido6).'","'.stripslashes($lido7).'","'.stripslashes($lido8).'","'.stripslashes($lido9).'"),';

	/*if(stripslashes($lido1)!=NULL) {
		if($crg<$nn) { $gravab=$gravab.", ";  }
	}*/
	
	if($crg>=$nn) {
	
		$gravab=substr($gravab, 0, -1);
		$gravab=$gravab."; ";
	 	$cgt=$cgt+1;
		$gr=$grava.$gravab;
		$result = mysqli_query($conexao,$gr);
		$text=$text."<br><br>".$gr;	
		
		if (!$result)
		{
			$msg=$msg."<br><font color='red'>Nenhum dado gravado na <b>Etapa $cgt</b></font>:<br></center>".$text."";
			//iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','<font color=red>Não ocorreu o processamento da Etapa $cgt do Arquivo CSV ID $id - Erro!</font>','$datalog')");
			//fimlog	
		}
		else
		{
		

		
			
			$gravae=substr($gravae, 0, -1);
			$gravae=$gravae."; ";  
			//echo $gravae;
			//$cgt=$cgt+1;
			$resulte = mysqli_query($conexao,$grave.$gravae);
			if (!$resulte) {	
			  $texte=$texte."<br>".$grave.$gravae;
			}			
			
			$msg=$msg."<br>Dados gravados com sucesso na <b>Etapa $cgt</b>".$texte."";
			
			//iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','Processou Etapa $cgt do Arquivo CSV ID $id com sucesso!','$datalog')");
			//fimlog


			
		}
		
		$gravab="";
		$gravae="";
		$crg=1;
		
		sleep(1);
		
	}

}


if($crg<$nn) {
	
		$cgt="Final";
		$gravab=substr($gravab, 0, -1);
		//$gravab=substr($gravab, 0, -2).";";
		$gravab=$gravab."; ";
		$result = mysqli_query($conexao,$grava.$gravab);
		$text=$text."<br><br>".$grava.$gravab;	
		
		if (!$result)
		{
			$msg=$msg."<br><font color='red'>Nenhum dado gravado na etapa <b>Etapa $cgt</b></font>:<br></center>".$text."
			<br>______________________<br>";
			//iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','<font color=red>Não ocorreu o processamento da Etapa Final do Arquivo CSV ID $id - Erro!</font>','$datalog')");
			//fimlog
		}
		else
		{
			
			$cgt="Final";
			$gravae=substr($gravae, 0, -1);
			//$gravae=substr($gravae, 0, -2).";";
			$gravae=$gravae."; ";
			$resulte = mysqli_query($conexao,$grave.$gravae);
				if (!$resulte) {
						$texte=$texte."<br><br>".$grave.$gravae;
				}
			$msg=$msg."<br>Dados gravados com sucesso na <b>Etapa $cgt</b><br>".$texte."";
			
			//iniciolog
			$datalog=date('Y-m-d H:i:s');
			$gravalog= mysqli_query($conexao,"INSERT INTO log (id_usuario, acao, data) 
			VALUES('$idu','Processou Etapa Final do Arquivo CSV ID $id com sucesso!','$datalog')");
			//fimlog	;
		}
		$gravab="";
}
	


?>
</div>
