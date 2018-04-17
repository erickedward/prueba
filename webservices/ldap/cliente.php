<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php

ini_set("soap.wsdl_cache_enabled", "0");

try {
	$options = array();

	#Autenticar usuario
	//$params	 = array('usuario'=>'rserrano','clave'=>'123456');

	#Consultar usuario
	//$params	 = array('usuario'=>'rserrano');
	
	#Consultar usuario por cedula
	$params	 = array('cedula'=>'26989498');
	$params	 = array('cedula'=>'15843746');
	$params	 = array('cedula'=>'15842896');
	$params	 = array('usuario'=>'asuarez');
	$params	 = array('usuario'=>'13159838');
	$params	 = array('usuario'=>'yleal');

	$params	 = array('usuario'=>'13159838');
	$params	 = array('usuario'=>'yyhernandez');

	$params	 = array('usuario'=>'oravello');
	//$params	 = array('usuario'=>'3660236');

	//$params	 = array('usuario'=>'6324079');
	$params	 = array('usuario'=>'scastillo');

	$params	 = array('usuario'=>'10318638');

	
	 
	

	$client = new SoapClient("http://webservices.opsu.gob.ve/ldap/ldap.wsdl",$options);
	$soapstruct = new SoapVar($params, SOAP_ENC_OBJECT, "params", "http://webservices.opsu.gob.ve/ldap/schema.xsd");

	#Autenticar usuario y clave
	//$result = $client->autenticarLdap(new SoapParam($soapstruct, "message"));
	
	#Consultar datos personales en ldap por usuario o cedula
	$result = $client->consultarDatosPersonalesLdap(new SoapParam($soapstruct, "message"));
	

  	print_r($result);

} catch (SoapFault $e) {
	print_r($e);
	print_r($e->getMessage());
}
?>