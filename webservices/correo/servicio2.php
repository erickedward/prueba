<?php

class Servicios{
	
	var $SMTPAuth   = false;								#Habilitar la autenticacion de SMTP
	var $SMTPHost   = "correo.opsu.gob.ve";					#Dominio del servidor SMTP
	var $Port       = "";									#Configuracion del puerto SMTP
	var $SMTPSecure = "";									#Seguridad de la conexion
	var $username   = "no-responder";							#Usuario de la cuenta SMTP
	var $password   = "CorreoNoResponder4874@";							#Contraseña de la cuenta sSMTP
	var $IsSMTP = false;									#Llamar a la clase SMTP
	var $CharSet = "UTF-8";									#Codificacion de caracteres
	var $nombre_remitente = "";	
	var $ErrorInfo = "";

	function enviarCorreo($arr){
		
		//arr
		//[0]Nombre de remitente
		//[1]remitente
		//[3]destinatario
		//[4]asunto
		//[5]mensaje
		//[6]html

		$i = 0;
		foreach($arr as $key => $value){
			$vec[$i] = $value;
			$i++;
		}

		$this->nombre_remitente = $vec[0]; 
		$remitente = $vec[1];
		$destinatario = $vec[2];
		$asunto = $vec[3];
		$mensaje = $vec[4];
		$html = $vec[5];

		include ('../lib/nomad_mimemail/nomad_mimemail.inc.php');
		$mimemail = new nomad_mimemail();

		$mimemail->set_from($remitente,$this->nombre_remitente);
		$mimemail->set_to($destinatario);
		$mimemail->set_subject($asunto);
		$mimemail->set_text($mensaje);
		$mimemail->set_html($html);

		$mimemail->set_smtp_log(true); // If you need debug SMTP connection
		
		$mimemail->set_smtp_host($this->SMTPHost);
		
		if(!empty($this->username) and !empty($this->password)){
			$mimemail->set_smtp_auth($this->username, $this->password);
		}

		if ($mimemail->send()){
		   	$m = 0;
		   	$salida["mensaje"] = "Correo enviado satisfactoriamente";
		}
		else {
			$m = 1;
		   	$salida["mensaje"] = "Ocurrió un error al enviar el mensaje";
		   	$salida["debug"] = $mimemail->get_smtp_log();
		}
		$salida["error"] = $m;
		return $salida;
	}

	function enviarCorreo2($arr){
		
		require_once('../lib/PHPMailer/class.phpmailer.php');

		//arr
		//[0]Nombre de remitente
		//[1]remitente
		//[3]destinatario
		//[4]asunto
		//[5]mensaje
		//[6]html

		$i = 0;
		foreach($arr as $key => $value){
			$vec[$i] = $value;
			$i++;
		}

		$this->nombre_remitente = $vec[0]; 
		$remitente = $vec[1];
		$destinatario = $vec[2];
		$asunto = $vec[3];
		$mensaje = $vec[4];
		$html = $vec[5];

		$mail = new PHPMailer();

		if($this->IsSMTP){
			$mail->IsSMTP();	
		}

		echo $mail->SMTPAuth   = $this->SMTPAuth;
		echo $mail->Host       = $this->SMTPHost;
		$mail->Port       = $this->Port;
		$mail->SMTPSecure = $this->SMTPSecure;
		echo $mail->Username   = $this->username;
		echo $mail->Password   = $this->password;

		$mail->SetFrom($remitente, $this->nombre_remitente);
		
		$mail->AddReplyTo($remitente,$this->nombre_remitente);

		$mail->Subject    = $asunto;
		if(!empty($html)){
			$mail->MsgHTML($html);
		}

		$mail->Body	= $mensaje;
		$mail->CharSet = $this->CharSet;
		$mail->AddAddress($destinatario, $this->nombre_remitente);

		if(!$mail->Send()) {
		    //echo "Error en el mensaje: " . $mail->ErrorInfo;
			$m = "0"; // ERROR
		} else {
			$m = "1"; //CORRECTO
		}
		return $m.$mail->ErrorInfo;
	}

}# end class

ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache

$server = new SoapServer('http://webservices.opsu.gob.ve/correo/correo.wsdl');
$server->setClass('Servicios');
$server->handle();

?>