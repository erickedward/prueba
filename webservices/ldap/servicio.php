<?php
class Servicios{

	private $conexion;
	private $servidor = "ldap.opsu.gob.ve";
	private $puerto = "389";


	function conectar($servidor="",$puerto=""){
		//Establecer la conexion con el servidor LDAP
		if ($servidor=""){
			$this->servidor = $servidor;
		}//end if
		if ($puerto=""){
			$this->puerto = $servidor;
		}//end if
		$this->conexion = ldap_connect($this->servidor,$this->puerto) or die("No ha sido posible conectarse al servidor $this->servidor");
		$this->conexion." ".$this->servidor." ".$this->puerto;
		ldap_set_option($this->conexion, LDAP_OPT_PROTOCOL_VERSION,3);
		ldap_set_option($this->conexion, LDAP_OPT_REFERRALS,0);
		$this->estado = true;
		return $this->conexion;
	}//end function

	function consultarDatosPersonalesLdap($arr){
		$i = 0;
		foreach($arr as $key => $value){
			$vec[$i] = $value;
			$i++;
		}

		$ds = $this->conectar();

		if(!is_numeric($vec[0])){
			$filtro = "(&(uid=".$vec[0]."))";
		}else{
			$filtro = "(&(cedula=V".$vec[0]."))";
		}
		
		$base = "dc=opsu,dc=gob,dc=ve,o=opsuldap";
		
		//$filtro = "cn=*";
		
		$sr = ldap_search($ds, $base, $filtro);
		$info = ldap_get_entries($ds, $sr);

		if($info["count"]>0){

			$dn = $info[0]['dn'];
			$unid = explode("ou=",$dn);
			$unid2 = explode(",",$unid[2]);
			//echo $unid2[0];
			$cedula = $info[0]['cedula'];
			//$info[0]['cedula'] = array(substr($cedula[0],1,strlen($cedula[0])));
			$reemplazar = array("V", " ", "-", "v");
			$info[0]['cedula'] = str_replace($reemplazar, "",$cedula);
			//$info[0]['cedula'] = $cedula;
			$datos_empleados = array($info[0]['uid'],$info[0]['mail'],$info[0]['cedula'],$info[0]['displayname'],$info[0]['employeetype'],$info[0]['l'],$unid2);

			$arreglo = array(
							"usuario" => $info[0]['uid'][0],
							"cedula" => $info[0]['cedula'][0],
							"nombre" => $info[0]['displayname'][0],
							"correo" => $info[0]['mail'][0],
							"cargo" => $info[0]['employeetype'][0],
							"unidad" => $unid2[0],
							"oficina" => $info[0]['l'][0]
						);
			ldap_close($ds);
			return $arreglo;
		}else{
			ldap_close($ds);
			return array('error'=>1, 'respuesta'=>'Usuario no encontrado');
		}
	}

	function autenticarLdap($arr) {

		$i = 0;
		foreach($arr as $key => $value){
			$vec[$i] = $value;
			$i++;
		}

		$ds = $this->conectar();

		$filtro = "(&(uid=".$vec[0]."))";
		$base = "dc=opsu,dc=gob,dc=ve,o=opsuldap";

		$sr = ldap_search($ds, $base, $filtro);
		$info = ldap_get_entries($ds, $sr);

		//print_r($info);
		$dn = $info[0]['dn'];
		$unid = explode("ou=",$dn);
		$unid2 = explode(",",$unid[2]);
		//echo $unid2[0];
		$cedula = $info[0]['cedula'];
		//$info[0]['cedula'] = array(substr($cedula[0],1,strlen($cedula[0])));
		$reemplazar = array("V", " ", "-", "v");
		$info[0]['cedula'] = str_replace($reemplazar, "",$cedula);

		$datos_empleados = array($info[0]['uid'],$info[0]['mail'],$info[0]['cedula'],$info[0]['displayname'],$info[0]['employeetype'],$info[0]['l'],$unid2);

		$arreglo = array(
						"usuario" => $info[0]['uid'][0],
						"cedula" => $info[0]['cedula'][0],
						"nombre" => $info[0]['displayname'][0],
						"correo" => $info[0]['mail'][0],
						"cargo" => $info[0]['employeetype'][0],
						"unidad" => $unid2[0],
						"oficina" => $info[0]['l'][0]
					);

		//Conexion ldap con el usuario
		if(ldap_bind($this->conexion,$dn,$vec[1])){
			return $arreglo;
		}else{
			return array('error'=>1, 'respuesta'=>'Usuario o Clave inválidos');
		}
		ldap_close($ds);
		return $aut_usuario;
	}
}#end class

$server = new SoapServer('http://webservices.opsu.gob.ve/ldap/ldap.wsdl');
$server->setClass('Servicios');
$server->handle();
?>