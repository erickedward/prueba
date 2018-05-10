<?php
session_start();
header ("Content-type: image/png");
//header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
//header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache");

$im = @ImageCreate (95, 25);
$color_fondo = ImageColorAllocate ($im, 255, 220, 240);
$color_texto = ImageColorAllocate ($im, 233, 14, 91);
imagefill($im,0,0,$white);

$bg = imagecolorallocate($im, mt_rand(175,255), mt_rand(175,255), mt_rand(175,255));
imagefilledrectangle($im, 0, 0, 199, 49, $bg);

$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);
$gris = imagecolorallocate($im, 192, 192, 192);
$rojo = imagecolorallocate($im, 128, 0, 0);
$azul = imagecolorallocate($im, 0, 0, 128);

$ale = imagecolorallocate($im, 55, 255, 255);
$ale2 = imagecolorallocate($im, 255, 255, 255);

ImageLine($im, 20, -3, 75, 7,$gris);
ImageLine($im, 20, 5, 75, 15,$gris);
ImageLine($im, 20, 14, 75, 23,$gris);

ImageLine($im, 20, 13, 75, 2,$gris);
ImageLine($im, 20, 22, 75, 11,$gris);
ImageLine($im, 20, 30, 75, 20,$gris);

ImageLine($im, 1, 12, 5, 15,$gris);
ImageLine($im, 1, 1, 5, 15,$gris);

ImageLine($im, 80, 12, 5, 15,$gris);
ImageLine($im, 80, 1, 5, 15,$gris);

ImageLine($im, rand(50,90), 10, 5, 20,$ale);
ImageLine($im, rand(50,80), 1, 5, 15,$ale2);

imagechar($im, 5, 10, 3, substr($_SESSION["codigo_autenticar"],0,1), $black);
imagechar($im, 5, 22, 8, substr($_SESSION["codigo_autenticar"],1,1), $color_texto);
imagechar($im, 5, 34, 3, substr($_SESSION["codigo_autenticar"],2,1), $black);
imagechar($im, 5, 46, 8, substr($_SESSION["codigo_autenticar"],3,1), $color_texto);
imagechar($im, 5, 58, 3, substr($_SESSION["codigo_autenticar"],4,1), $black);
imagechar($im, 5, 70, 8, substr($_SESSION["codigo_autenticar"],5,1), $color_texto);
imagechar($im, 5, 82, 3, substr($_SESSION["codigo_autenticar"],6,1), $azul);
imagechar($im, 5, 82, 3, substr($_SESSION["codigo_autenticar"],6,1), $black);
ImagePng ($im);
imagedestroy($im);
//$_SESSION["codigo_autenticar"] = "";
?>