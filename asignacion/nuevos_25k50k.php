<?php
//Código modificado por: Anderson Capriles
//Fecha de modificación: 28-mar-2015
//Hora de modificación: 2:27 pm
 
// Conectando, seleccionando la base de datos
$servidor='';
$usuario='';
$clave='';
$bd = '';


$link = mysql_connect($servidor, $usuario, $clave) or die('No se pudo conectar: ' . mysql_error());
mysql_select_db($bd) or die('No se pudo seleccionar la base de datos');

// Realizar una consulta MySQL
$query = "SELECT DISTINCT a.cod_institucion,a.nombre_institucion,a.nombre_nucleo,a.cod_parroquia_ine_final AS cod_parroquia FROM instituciones a 
INNER JOIN carreras_instituciones c ON a.cod_institucion = c.cod_institucion
INNER JOIN cupo_todos_10_c d ON  c.id_carrera_institucion = d.codcarrera
WHERE a.cod_institucion NOT IN (SELECT DISTINCT b.cod_institucion FROM cp_ai_50k b WHERE NOT ISNULL(cod_institucion))
AND a.id_dependencia_administrativa = 1";


echo "INICIO DE LA CARGA \n";
$time = time();
echo "Tiempo de Inicio: " . date("d-m-Y (H:i:s)", $time) . "\n\n";

$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
mysql_select_db($bd) or die('No se pudo seleccionar la base de datos');

$instituciones_sin_25k_50k = array();
$n=0;
if(mysql_num_rows($result)>0){
	while($rs = mysql_fetch_array($result)){

		$query = "SELECT b.cod_institucion
					FROM instituciones a 
					INNER JOIN cp_ai_25k b ON a.cod_institucion = b.cod_institucion 
					INNER JOIN cp_ai_50k c ON a.cod_institucion = c.cod_institucion 
					WHERE cod_parroquia_ine_final = '".$rs["cod_parroquia"]."' LIMIT 1";


		$result2 = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
		mysql_select_db($bd) or die('No se pudo seleccionar la base de datos');

		if(mysql_num_rows($result2)>0){
			
			$rs2 = mysql_fetch_array($result2);
			
			$query = "INSERT INTO cp_ai_25k SELECT '',ubigeo,codent,entidad,codmun,municipio,codparrq,parroquia,codcpob,cpob,cpindigena,'".$rs["nombre_institucion"]."','".$rs["nombre_nucleo"]."','".$rs["cod_institucion"]."',cod_parr
						 FROM instituciones a INNER JOIN cp_ai_25k b ON a.cod_institucion = b.cod_institucion where cod_parroquia_ine_final = '".$rs["cod_parroquia"]."' AND b.cod_institucion = '".$rs2["cod_institucion"]."'";

			$link2 = mysql_connect($servidor, $usuario, $clave) or die('No se pudo conectar: ' . mysql_error());
			mysql_select_db($bd) or die('No se pudo seleccionar la base de datos');

			if (mysql_query($query) or die("\n\nINSERT FALLIDO 25K: ".$query."\n\n". mysql_error())){
				$query = "INSERT INTO cp_ai_50k SELECT '',ubigeo,codent,entidad,codmun,municipio,codparrq,parroquia,codcpob,cpob,cpindigena,'".$rs["nombre_institucion"]."','".$rs["nombre_nucleo"]."','".$rs["cod_institucion"]."',cod_parr
						 FROM instituciones a INNER JOIN cp_ai_50k b ON a.cod_institucion = b.cod_institucion where cod_parroquia_ine_final = '".$rs["cod_parroquia"]."' AND b.cod_institucion = '".$rs2["cod_institucion"]."'";

				$link2 = mysql_connect($servidor, $usuario, $clave) or die('No se pudo conectar: ' . mysql_error());
				mysql_select_db($bd) or die('No se pudo seleccionar la base de datos');
				if (mysql_query($query) or die("\n\nINSERT FALLIDO 25K: ".$query."\n\n". mysql_error())){
					
				}else{
					echo "\n\nOcurrio un error en el insert 50k de la institución ".$rs["cod_institucion"].". Verificar como quedo ingresado en 25k";
					exit;
				}//end if
				
			}else{
				echo "\n\nOcurrio un error en el insert 25k de la institución ".$rs["cod_institucion"];
				exit;
			}//end if
			
			
		}else{
			$instituciones_sin_25k_50k[$n] = $rs["cod_institucion"].";".$rs["nombre_institucion"].";".$rs["nombre_nucleo"];
			$n++;
		}//end if

	}//end while
	if (count($instituciones_sin_25k_50k)>0){
		echo "\n\nLas siguientes instituciones no poseen otra institución dentro de su parroquia reportar al PNI para que envie las inserciones correspondientes\n";
		for($i=0;$i<count($instituciones_sin_25k_50k);$i++) echo "\n".$instituciones_sin_25k_50k[$i];
	}

}

echo "\n\nFIN DE LA CARGA\n";
	
// Liberar resultados
mysql_free_result($result);
mysql_free_result($result2);

// Cerrar la conexión
mysql_close($link);
$time = time();
echo "\n\nTiempo de Fin: " . date("d-m-Y (H:i:s)", $time) . "\n\n";
?>
