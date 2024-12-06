<?php include("sec.php");

ini_set('display_errors',1); ini_set('display_startup_erros',1); error_reporting(E_ALL);
//force php to show any error message

function backup_tables($host,$user,$pass,$name)
{
	
    $link = mysqli_connect($host,$user,$pass);
    mysqli_select_db($link, $name);
        $tables = array();
        $result = mysqli_query($link, 'SHOW TABLES');
        $i=0;
        while($row = mysqli_fetch_row($result))
        {
            $tables[$i] = $row[0];
            $i++;
        }
    $return = "";

    foreach($tables as $table)
    {
        $result = mysqli_query($link, 'SELECT * FROM '.$table);
        $num_fields = mysqli_num_fields($result);
        $return .= 'DROP TABLE IF EXISTS '.$table.';';
        $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";
        for ($i = 0; $i < $num_fields; $i++)
        {
            while($row = mysqli_fetch_row($result))
            {
                $return.= 'INSERT INTO '.$table.' VALUES(';
                for($j=0; $j < $num_fields; $j++)
                {
                    $row[$j] = addslashes($row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j < ($num_fields-1)) { $return.= ','; }
                }
                $return.= ");\n";
            }
        }
        $return.="\n\n\n";
    }
    //save file
    $tmpf=time();
	$nomarq='db-backup-'.$tmpf.'-'.(md5(implode(',',$tables))).'.sql';
    $handle = fopen($nomarq,'w+');//Don' forget to create a folder to be saved, "db_bkp" in this case
    fwrite($handle, $return);
    fclose($handle);
	//
	$backupfile=$nomarq;
	$backupzip = $nomarq .'.gz';
	$backupzipcam = 'db_bkp/'.$backupzip;
	system("tar -czvf $backupzipcam $backupfile");
	$databack=date('Y-m-d H:i:s');
	$sexec="INSERT INTO backups (arquivo, arquivo_sql, data) VALUES('$backupzip','$nomarq', '$databack')";
	$gravaback= mysqli_query($link,$sexec);
	if(!$gravaback) { echo "Erro: ". mysqli_error($link);}
	//unlink($nomarq);
	rename($nomarq,'db_bkp/'.$nomarq);
	
	//
   // echo "[backup efetuado com sucesso].. Redirecionando!  <meta http-equiv=\"refresh\" content=\"5; URL='../configuracao/index.php'\"/>";
	//Sucessfuly message
	
}

 
backup_tables($nomehost,$usuario,$senha,$basedados);
//don't forget to fill with your own database access informations

// inicio log

        $sql = "INSERT INTO log (id_usuario, acao, data) VALUES(?,?,?)";
		$stmt = $conexao->prepare($sql);
        $datalog=date('Y-m-d H:i:s');
		if ($stmt === false) {
			die("Erro na preparação da query: " . $conexao->error);
		}
		$stmt->bind_param("sss", $iddu,$msglog,$datalog);
        $iddu=$_SESSION['idu'];
        $msglog="Usuario [".$adm_usuario."] fez um backup";
		$stmt->execute();
        if($stmt->affected_rows > 0) { 
            echo "<script>document.location='../configuracao'</script>";
        }
	
	// fim log
?>
