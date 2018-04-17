<?php
 set_time_limit(0);
// Conectando, seleccionando la base de datos
/*$link = mysql_connect('172.17.12.66', 'root', 'MySQLr00t') or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('asignacion2017') or die('No se pudo seleccionar la base de datos');*/

$link = mysql_connect('ctsi-tecn-sv004', 'user_rusnies', '81FC5EAD18890D42406DEBCEC8981A') or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('rusnies') or die('No se pudo seleccionar la base de datos');

// Realizar una consulta MySQL
$query = "SELECT a.id_aspirante,concat('p',a.notas1,';','s',a.notas2,';','t',a.notas3,';','c',a.notas4) AS notas 
			FROM notas_modificadas a;";



echo "INICIO DE LA CARGA \n";
$time = time();
echo "Tiempo de Inicio: " . date("d-m-Y (H:i:s)", $time) . "\n\n";

$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
mysql_select_db('rusnies') or die('No se pudo seleccionar la base de datos');
	
if(mysql_num_rows($result)>0){
	$insert = "";
	$ano = "";
	$periodo = "";
	while($row = mysql_fetch_array($result)){
		$notas = explode(";",$row["notas"]);
		for($i=0;$i<count($notas);$i++){
			if ($notas[$i]!=''){
				$insert ='';
				$dat = explode(':',$notas[$i]);
				$periodo = substr($dat[0], 0, 1);
				//echo $ano;
				if ($periodo == 'p')
				{
					$ano = 'p';
					$dat[0] = str_replace('p','', $dat[0]);
				}
				if ($periodo == 's')
				{
					$ano = 's';
					$dat[0] = str_replace('s','', $dat[0]);
				}
				if ($periodo == 't')				
				{
					$ano = 't';
					$dat[0] = str_replace('t','', $dat[0]);
				}
				if ($periodo == 'c')				
				{
					$ano = 'c';
					$dat[0] = str_replace('c','', $dat[0]);
				}

				if(count($dat)==2){
					$insert = "(".$row["id_aspirante"].",".$dat[0].",'".$dat[1]."','0','".$dat[1]."','".$ano."')";
				}elseif(count($dat)==3){
					if(is_numeric($dat[1])==true and is_numeric($dat[2])==true){
						$insert = "(".$row["id_aspirante"].",".$dat[0].",'".intval($dat[1])."','".intval($dat[2])."','".(round((intval($dat[1])+intval($dat[2]))/2))."','".$ano."')";
					}else{
						$insert = "(".$row["id_aspirante"].",".$dat[0].",'".$dat[1]."','".$dat[2]."','0','".$ano."')";
					}//end if
				}//end if
				// Realizar una consulta MySQL
				if($insert!='')
				{
					//echo "\n".$insert;
					$query = "INSERT INTO notas_definitivas_depurar values ".$insert . ";";
					mysql_query($query) or die('Insert fallido: ' . mysql_error());
				}//end if

			}//end if
				

		}//end for
					
	}//end while
}

echo "FIN DE LA CARGA\n";
	
// Liberar resultados
mysql_free_result($result);

// Cerrar la conexión
mysql_close($link);
$time = time();
echo "Tiempo de Fin: " . date("d-m-Y (H:i:s)", $time) . "\n\n";
?>
