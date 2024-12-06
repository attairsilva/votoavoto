<?php
header("Content-type: image/jpeg");
session_start();
  
$codigoCaptcha = substr(md5( time() ) ,0,6);
  
$_SESSION["captcha"] = $codigoCaptcha;

 
$imagemCaptcha = imagecreatefrompng("../fundocaptch.png");
  
$fonteCaptcha = imageloadfont("../verdana.ttf");
  
$corCaptcha = imagecolorallocate($imagemCaptcha,255,0,0);
  
imagestring($imagemCaptcha,50,25,15,$codigoCaptcha,$corCaptcha);

  
header("Content-type: image/png");
  
imagepng($imagemCaptcha);
  
imagedestroy($imagemCaptcha);

 

?>