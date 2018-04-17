<?php

ini_set("soap.wsdl_cache_enabled", "0");

try {
	$options = array();
	$params	 = array(
		'nombre'=>"Richard Serrano.",
		'correo_remitente' => "no-responder@opsu.gob.ve",
		'correo_destinatario' => "rserrano@opsu.gob.ve,abelisario@opsu.gob.ve,eramirez@opsu.gob.ve",
		'asunto' => "El asunto áéíóúñ",
		'mensaje' => "El mensaje del correo áéíóúñ ññ °!#$%&/()",
		'mensaje_html' => ""
	);

	$client = new SoapClient("http://webservices.opsu.gob.ve/correo/correo.wsdl",$options);
	$soapstruct = new SoapVar($params, SOAP_ENC_OBJECT, "params", "http://webservices.opsu.gob.ve/correo/schema.xsd");
	$result = $client->enviarCorreo(new SoapParam($soapstruct, "message"));
	
  	print_r($result);

} catch (SoapFault $e) {
	print_r($e);
	print_r($e->getMessage());
}
?>