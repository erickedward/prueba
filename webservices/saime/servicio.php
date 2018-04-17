<?php

require_once("../cls/cls_conexion.php");
require_once("../cls/cls_funciones.php");

class Servicios{
	
	private $_SOAPSERVER = NULL;
	private $_HEADERVARS = "";
	private $_params     = array();
	private $_USER         = "";
	private $_PASSWORD     = "";

	#Propiedades de Conexion
	var $conexion_parametro = true;
	var $servidor = "172.17.1.45";
	var $bdatos = "global";
	var $usuario = "user_webservices";
	var $password = "8A0BA4064896E708705686622F3CB4DC";
	var $arr_conexion = Array();

	#============================================================================================================================

	/*public function __construct($soapServer_resource){
		$this->_SOAPSERVER     = $soapServer_resource;
		$this->_USER        = $_SERVER['PHP_AUTH_USER'];
		$this->_PASSWORD    = $_SERVER['PHP_AUTH_PW'];
	}*/

	#============================================================================================================================	

	function crear_conexion_mysql($bd){

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
		    case '127.0.0.1':
		    case '172.17.1.42':
		    case '172.17.2.86':
		        $hostname = "172.17.1.45";
		    break;    
		    /*case '127.0.0.1':
		        $hostname = "172.17.2.185";
		    break;*/
		}
		$cn = new cls_conexion();
		$cn->modo = 1;
		$cn->auditoria = false;
		$cn->servidor = $hostname;
		$cn->usuario = "user_webservices";
		//$cn->usuario = "user_2";
		//$cn->password="DD2088F615E541791C6897382C79FA";
		$cn->password = "BFAD593251B95A4240F52AD528B6D5E3";
		$cn->bdatos = $bd;
		$cn->conectar();
		return $cn;
	}

	function consultarSaime($cedula){
		$i = 0;
		$sep = "";
		foreach($cedula as $key=>$value){
			//echo "<br>->".$cedula." ".$key." ".$value;
			$vec .= $sep."'".$value."'";
			$sep = ",";
			$i++;
		}
		if($i>1){
			$condicion = " numcedula IN(".$vec.")";
		}else{
			$condicion = " numcedula=".$vec;
		}
		$cn = $this->crear_conexion_mysql("global");
		$cn->query = "SELECT numcedula,primernombre,segundonombre,primerapellido,segundoapellido,sexo,fechanac,nacionalidad,paisorigen,letra FROM SAIME_cedulas where ".$condicion;
		if($cn->ejecutar()){
			if($cn->reg_total>0){
				$i = 0;
				while($rs = $cn->consultar()){
					$arr[$rs["numcedula"]] = array("numcedula" => $rs["numcedula"],"primernombre" => $rs["primernombre"],"segundonombre" => $rs["segundonombre"],"primerapellido" => $rs["primerapellido"],"segundoapellido" => $rs["segundoapellido"],"sexo" => $rs["sexo"],"fechanac" => $rs["fechanac"],"nacionalidad" => $rs["nacionalidad"],"paisorigen" => $rs["paisorigen"],"letra" => $rs["letra"]);					
				}
			}else{
				return 0;
				//throw new SoapFault("Error ", 'No encontrado');
			}#end if
		}#end if
		return $arr;
	}#end function
}

ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache

#Incluir Clases
function __autoload($class_name){
    require_once "../cls/".$class_name.'.php';
}//end function

ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache
$url_wsdl = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME'])."/";
$wsdl = "saime.wsdl";
$soap_server  = new SoapServer($url_wsdl.$wsdl);
$soap_server->setClass("Servicios", $soap_server);
$soap_server->handle();
/*
$ser = new Servicios();
//array("cedula" => "15843746","c2" => "15842786");
$ar = $ser->consultarSaime(array("cedula" => "15843746"));
print_r($ar);*/
?>