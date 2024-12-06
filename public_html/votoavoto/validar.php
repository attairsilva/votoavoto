<?php
session_start();
if( $_SESSION['captcha'] == $_POST['captcha']){
    echo "<h1>Ok - Código Correto</h1>";
    $_SESSION['captcha'] = " ";
}else{
    echo "<h1>Erro - Código digitado errado</h1>";
    $_SESSION=array();
    unset($_SESSION);
    session_destroy();
    header("location:error.php?status=Ambiente restrito!");	
}
