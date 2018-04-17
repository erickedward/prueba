<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php

ini_set("soap.wsdl_cache_enabled", "0");
/*
#Incluir Clases
function __autoload($class_name){
    require_once "../cls/".$class_name.'.php';
}//end function*/

try {
	$options = array();

	#(numero,mensaje,origen)
	$params	 = array('cedula'=>'13134133');
	$params	 = array('cedula'=>'13115104');
	$params	 = array('cedula'=>'14073917');
	
	$params	 = array('codigo'=>'0101040000');
	$params	 = array('codigo'=>'0101020200');

	//$params	 = array('cedula'=>'18404147');

	//$params	 = array('cedula'=>'13134133','cedula2'=>'10522627');
	//$params	 = array('ced_sup'=>'14073917');

	//Consultar descripcion de unidad
	//$params	 =  array("u" => "0101020200");
	//Consultar descripcion de ubicacion
	//$params	 =  array("u" => "0101040000", "u2" => "0101010000");
	$client = new SoapClient("http://webservices.opsu.gob.ve/empleados/empleados.wsdl",$options);
	$soapstruct = new SoapVar($params, SOAP_ENC_OBJECT, "params", "http://webservices.opsu.gob.ve/webservices/empleados/schema.xsd");
	//$result = $client->consultarEmpleado(new SoapParam($soapstruct, "message"));
	//$result = $client->consultarUbicacion(new SoapParam($soapstruct, "message"));
	//$result = $client->consultarEmpleadosSupervisor(new SoapParam($soapstruct, "message"));
	//$result = $client->consultarEmpleadosSupervisorAlt(new SoapParam($soapstruct, "message"));
	//$result = $client->consultarEmpleadosCodUbicacion(new SoapParam($soapstruct, "message"));
	$result = $client->consultarEmpleadosCodUnidad(new SoapParam($soapstruct, "message"));
	//$result = $client->consultarEmpleadosSupervisorSED(new SoapParam($soapstruct, "message"));
	//$result = $client->consultarDescripcionUnidad(new SoapParam($soapstruct, "message"));
	//$result = $client->consultarDescripcionUbicacion(new SoapParam($soapstruct, "message"));
	
	/*	Ejemplos
		$params	 = array('c1'=>'rserrano');
		$params2	 = array('c1'=>'15843746','c2 '=>'15842896');
		$params3	 = array('ced_sup'=>'14073917','c2'=>'13134133');
		$params33	 = array('ced_sup'=>'10522627');
		$params4	 = array('codigo'=>'0101040000');
		$params5	 = array('codigo'=>'0101040201');

		$x = new Servicios(array());
		//$arr = $x->consultarEmpleado($params);
		//$arr = $x->consultarUbicacion($params2);
		//$arr = $x->consultarEmpleadosSupervisor($params3);
		//$arr = $x->consultarEmpleadosSupervisorAlt($params33);
		//$arr = $x->consultarEmpleadosCodUbicacion($params4);
		//$arr = $x->consultarEmpleadosSupervisorSED($params3);
		//$arr = $x->consultarEmpleadosCodUnidad($params5);
		$arr = $x->consultarDescripcionUnidad(array("u" => "0101020200"));
		//Permite consultar varias simultaneamente
		$arr = $x->consultarDescripcionUbicacion(array("u" => "0101040000", "u2" => "0101010000"));
	*/

  	print_r($result);

} catch (SoapFault $e) {
	print_r($e);
	print_r($e->getMessage());
}
?>