
<html  xml:lang="pt-br" xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>Voto a Voto</title>
<?php error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
 ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://w3.p2hp.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
* {box-sizing: border-box;}

/* Style the input container */
.input-container {
  display: flex;
  width: 100%;
  margin-bottom: 15px;
}

/* Style the form icons */
.icon {
  padding: 10px;
  background: teal;
  color: white;
  min-width: 50px;
  text-align: center;
}

/* Style the input fields */
.input-field {
  width: 100%;
  padding: 10px;
  outline: none;
}

.input-field:focus {
  border: 2px solid teal;
}

/* Set a style for the submit button */
.btn {
  background-color: teal;
  color: white;
  padding: 15px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.btn:hover {
  opacity: 1;
}
</style>

</head>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
<body>
<div class="w3-container  w3-mobile w3-center"  style="width:500px;margin:auto;">
  <p align="center"><b><?php 
    $msg=$_GET['status'];
    if($msg!=NULL) { 
    ?>
      <div class="w3-panel w3-card w3-yellow">
        <?=utf8_decode("<h3>".$msg."</h3>");?>
      </div>
    <?		
    } ?>
      <div class="w3-panel w3-border" >
    <p align="center">  <img src="img/icologo2.png" class="w3-circle" alt="Alps" style="width:100%;max-width:100px"></p>
  </div>
  <form  action="adm.valida.usuario.php" method="POST" name="frm01" id="frm01" class="w3-container w3-align-center" enctype="multipart/form-data">
  
    <div class="input-container">
      <i class="fa fa-user icon"></i>
      <input class="input-field" type="text" placeholder="Usuário" name="FormUsuario" id="FormUsuario">
    </div>
  

    <div class="input-container">
      <i class="fa fa-key icon"></i>
      <input class="input-field" type="password" placeholder="Senha" name="FormSenha" id="FormSenha">
    </div>

    <!--<div class="input-container">
     
      <img src="captcha.php"/>  <input class="input-field" placeholder="Confirme o código da imagem"  id="captcha" name="captcha" type="text" />
    </div>-->
  <button type="submit" class="btn">Entrar</button>
  </form>
</div>

<?php include("rodapeb.php"); ?>
</body>
</html>

