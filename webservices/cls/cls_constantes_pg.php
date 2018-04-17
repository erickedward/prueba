<?php
$usuario="pg_consulta";
/*$bdatos="OPSU".date(Y);*/
		#==========Modificado por Rosaura Mireles 14/01/14========#
		if(date(Y)<2014)
			$bdatos = "OPSU".date(Y);
		else 
			$bdatos = "CNU".date(Y);
		//echo "---------------->".$bdatos;
		#=====================Fin Modificación=====================#
switch ($_SERVER["SERVER_ADDR"]) {	
	case '127.0.0.1':
		$hostname = "172.17.1.13";		
		$usuario="pg_consulta";	
		define ("C_PASSWORD_PG","pg_consulta");		
		break;		
	case '172.17.1.42':
		$hostname = "172.17.1.13";		
		define ("C_PASSWORD_PG","pgconsulta");
		break;
	case '172.17.2.185':	
		//$hostname = "172.17.2.108";
		$hostname = "172.17.1.13";		
		$usuario="pg_consulta";	
		define ("C_PASSWORD_PG","pg_consulta");	
		#si en prueba se define la constante para la contraseña da error en la conexión e intenta conectarse www-data		
		break;
}//end sw
define ("C_SERVIDOR_PG",$hostname);
define ("C_USUARIO_PG",$usuario);
define ("C_BDATOS_PG",$bdatos);
?>