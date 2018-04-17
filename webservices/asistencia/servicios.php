<?php

require_once('../cls/cls_fecha.php');

class Servicios{

	private $_SOAPSERVER = NULL;
	private $_HEADERVARS = "";
	private $_params     = array();
	private $_USER         = "";
	private $_PASSWORD     = "";

	public function __construct($soapServer_resource){
		$this->_SOAPSERVER  = $soapServer_resource;
		$this->_USER        = $_SERVER['PHP_AUTH_USER'];
		$this->_PASSWORD    = $_SERVER['PHP_AUTH_PW'];
	}

	function crear_conexion(){
		$cn = new cls_conexion_pg();
		$cn->servidor = "172.17.2.13";
		$cn->usuario="pg_consulta";
		$cn->bdatos = "CNU".date(Y);
		$cn->conectar();
		return $cn;
	}

	function crear_conexion_mysql($bd){

		$cn = new cls_conexion();
		$cn->modo = 1;
		$cn->auditoria = false;
		$cn->usuario = "user_33";
		$cn->password="DDD2088F615E541791C6897382C79F";

		switch ($_SERVER["SERVER_ADDR"]) {
		    case '150.188.27.20':
		    case '150.188.27.21':
		    case '150.188.27.22':
		    case '150.188.27.23':
		    case '150.188.8.204':
		    	$hostname = "150.188.27.30";	      
		    break;
			case '172.17.2.9':
		    case '172.17.2.185':
		    /*case '127.0.0.1':*/
		    case '172.17.1.42':
		    case '172.17.2.86':
		        $hostname = "172.17.1.45";
		    break;    
		    case '127.0.0.1':
		        //$cn->usuario = "user_33";
				//$cn->password="DDD2088F615E541791C6897382C79F";
		        //$hostname = "127.0.0.1";
		        $hostname = "172.17.2.185";
		    break;
		}

		$cn->servidor = $hostname;

		/*$cn->usuario = "user_webservices";*/
		/*$cn->password = "BFAD593251B95A4240F52AD528B6D5E3";*/

		//$cn->usuario = "user_2";
		//$cn->password="DD2088F615E541791C6897382C79FA";
		
		$cn->bdatos = $bd;
		$cn->conectar();
		return $cn;
	}

	function consultarPermisos($arr=""){
		$cn = $this->crear_conexion_mysql("rrhh");
		$i = 0;

		foreach($arr as $key=>$value){
			switch ($i) {
				case 0:
					$cedula = $value;
				break;
				case 1:
					$mes = $value;
				break;
				case 2:
					$anio = $value;
				break;
				case 3:
					$nomina = $value;
				break;
			}
			$i++;
		}

		if($nomina!='0006' and $nomina!='0007'){
			#No obrero
			$tipo_empleado = 1;
		}else{
			#Obrero
			$tipo_empleado = 2;
		}

		if(empty($cedula) or empty($mes) or empty($anio) or  !is_numeric($cedula) or !is_numeric($mes) or !is_numeric($anio)){
			return array('error' => '1', 'mensaje' => "Su búsqueda no produjo resultados");
		}
		/*$cn->query = "SELECT dias_solicitados, fecha_inicio, fecha_reintegro 
						from solicitud_dias_pendientes 
						where ced_funcionario_solicita=".$cedula." 
						AND MONTH(fecha_inicio)='".$mes."' 
						AND YEAR(fecha_inicio)='".$anio."' 
						AND id_estatus='5'";*/

		$cn->query = "SELECT c.dias_disfrute, 
							c.fecha_inicio, 
							c.fecha_reintegro,
							t.descripcion
						FROM certificacion_vacaciones c
						INNER JOIN solicitud_dias_pendientes s on c.id_solicitud_vacaciones = s.id_solicitud_pendientes
						INNER JOIN tipo_solicitud t on s.id_tipo_solicitud = t.id_tipo_solicitud
						WHERE s.ced_funcionario_solicita='".$cedula."' 
						AND MONTH(c.fecha_inicio)='".$mes."' 
						
						
						AND YEAR(c.fecha_inicio)='".$anio."'
						ORDER BY c.fecha_inicio ASC";
		$cn->ejecutar();
		$i = 0;
		
		//return array("error" => $cn->query);

		if($cn->reg_total>0){
			
			while($rs = $cn->consultar()){
				//echo "<br> ".$rs[0]." ".$rs[1]." ".$rs[2]." ".$rs["3"]." ".$rs["4"];
				list($anio_inicio,$mes_inicio,$dia_inicio) = explode("-",$rs["fecha_inicio"]);
				list($anio_fin,$mes_fin,$dia_fin) = explode("-",$rs["fecha_reintegro"]);
				//echo "<br>Ultimo dia".$ultimo_dia = date("d",mktime(0,0,0,$mes+1,0,$anio));
				$total_habiles_restantes = 0;
				$dia_actual = $dia_inicio;
				$ultimo_dia = $dia_fin;
				for($x=$dia_actual;$x<$ultimo_dia;$x++){
					$dia = date("w", mktime(0, 0, 0, $mes, $x, $anio));
					$dia_vac = date("d", mktime(0, 0, 0, $mes, $x, $anio));
					if($tipo_empleado==1){
						#administrativo, técnicos y profesionales
						if(($dia!=0 and $dia!=6)){
							//echo "<br>-->> hábil";
							//echo "<br>Vac ".$anio_inicio."-".$mes_inicio."-".$dia_vac;
							$total_habiles_restantes++;
							$arreglo[$i] = array("fecha" => $anio_inicio."-".$mes_inicio."-".$dia_vac,"motivo" => $rs["3"]);
							$i++;
						}
					}else{
						#Obrero
						$arreglo[$i] = array("fecha" => $anio_inicio."-".$mes_inicio."-".$dia_vac,"motivo" => $rs["3"]);
						//$arreglo[$i] = $anio_inicio."-".$mes_inicio."-".$dia_vac;
						$i++;
					}
				}
			}#end while

			$arreglo["total"] = $i;
			$arreglo["error"] = '0';
			return $arreglo;
		}else{
			return array('error'>0, 'total' => '0', 'Mensaje' => "Su búsqueda no produjo resultados");
		}
		//$arreglo = $this->consultarUbicacion($vec);
		$cn->close();
		return $arreglo;
	}#end function

	function consultarTotalPermisos($arr=""){
		$cn = $this->crear_conexion_mysql("rrhh");
		$i = 0;

		foreach($arr as $key=>$value){
			switch ($i) {
				case 0:
					$mes = $value;
				break;
				case 1:
					$anio = $value;
				break;
				case 2:
					$nomina = $value;
				break;
			}
			$i++;
		}

		if($nomina!='0006' and $nomina!='0007'){
			#No obrero
			$tipo_empleado = 1;
		}else{
			#Obrero
			$tipo_empleado = 2;
		}

		if(empty($mes) or empty($anio)){
			return array('error' => '1', 'mensaje' => "Su búsqueda no produjo resultados");
		}

		$cn->query = "SELECT s.ced_funcionario_solicita,
						sum(c.dias_disfrute)
						FROM certificacion_vacaciones c
						INNER JOIN solicitud_dias_pendientes s on c.id_solicitud_vacaciones = s.id_solicitud_pendientes
						WHERE MONTH(c.fecha_inicio)='".$mes."' 
						AND YEAR(c.fecha_inicio)='".$anio."'
						GROUP BY s.ced_funcionario_solicita
						ORDER BY s.ced_funcionario_solicita ASC";
		$cn->ejecutar();
		$i = 0;
		
		//return array("error" => $cn->query);

		if($cn->reg_total>0){
			
			while($rs = $cn->consultar()){
				$arreglo[$rs["0"]] = $rs[1];
				$i++;
			}#end while

			$arreglo["total"] = $i;
			$arreglo["error"] = '0';

			return $arreglo;
		}else{
			return array('error' => 0, 'total' => '0', 'Mensaje' => "Su búsqueda no produjo resultados");
		}
		//$arreglo = $this->consultarUbicacion($vec);
		$cn->close();
		return $arreglo;
	}#end function

	function consultarTipoSolicitud($arr){
		$cn = $this->crear_conexion_mysql("rrhh");
		$i = 0;

		foreach($arr as $key=>$value){
			echo $key." = ".$value;
			if(!empty($value)){

				$vec = $value;
			}
		}

		if(!empty($vec)){
			$condicion = " where tipo_permiso='".$vec."'";
		}

		$cn->query = "SELECT id_tipo_solicitud, descripcion FROM tipo_solicitud".$condicion;
		$cn->ejecutar();
		$i = 0;
		
		//return array("error" => $cn->query);

		if($cn->reg_total>0){
			$i = 0;
			while($rs = $cn->consultar()){
				$arreglo[$rs["0"]] = $rs["1"];
				$i++;
			}
			$arreglo["total"] = $i;
			$arreglo["error"] = 0;
			return $arreglo;
		}else{
			return array('error' => 0, 'total' => '0', 'Mensaje' => "Su búsqueda no produjo resultados");
		}
		//$arreglo = $this->consultarUbicacion($vec);
		$cn->close();
		return $arreglo;
	}#end function

}#end class

ini_set('display_errors', '1');

#Incluir Clases
function __autoload($class_name){
    require_once "../cls/".$class_name.'.php';
}//end function

ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache
$url_wsdl = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME'])."/";
$wsdl = "asistencia.wsdl";
$soap_server  = new SoapServer($url_wsdl.$wsdl);
$soap_server->setClass("Servicios", $soap_server);
$soap_server->handle();


//$emp = new Servicios();
//$arr = $emp->consultarVacaciones(array('10825894','05','2016','0001'));
/*
$arr = $emp->consultarPermisos(array(
					'cedula' => '12138786',
					'mes' => '10', 
					'anio' => '2016', 
					'nomina' => '0001'
				));
*/
///print_r($arr);
//$arr = $emp->consultarPermisos(array('cedula' => '12138786','mes' => '10', 'anio' => '2016', 'nomina' => '0001'));

//$arr = $emp->consultarTipoSolicitud(array('tipo' => '1'));
/*
$arr = $emp->consultarTotalPermisos(array('mes' => '10', 'anio' => '2016'));
print_r($arr);
*/
//echo "A";
?>