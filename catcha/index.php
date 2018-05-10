<?php
session_start();
function campo_capcha(){

	$ima = imagen_catcha();

	$pag = '<div id="id_img_codseg" title="Actualizar Código" style="cursor:pointer;" align="center"><img id="id_5106" alt="codigo_18524" src="'.$ima.'" align="top"></div>';
    return $pag;
}//end function

function imagen_catcha(){
		generar_codigo();
		$img1 = "";
		if($_SESSION["imag"]=="" || $_SESSION["imag"]=="0"){ 
			$img1 = "includes/imagen.php?".date('hms');
			$_SESSION["imag"]="1";
		}else{
			$_SESSION["imag"]="0";
			$img1 = "includes/imagen2.php?".date('hms');
		}//end if
		return $img1;
	}//end function

function generar_codigo(){
	$_SESSION["codigo_autenticar"] = "";
	$alfanumerico = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
	for ($x=1;$x<=7;$x++){
		$numero_aleatorio = $numero_aleatorio.substr($alfanumerico, rand(0, strlen($alfanumerico)-1),1);
	}#end if
	$_SESSION["codigo_autenticar"] = $numero_aleatorio;	
}#end function

echo campo_capcha();
?>