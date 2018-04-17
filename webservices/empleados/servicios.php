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

	function consultarEmpleado($arr=""){	
		
		$i = 0;
		foreach($arr as $key=>$value){
			$vec[$i] = $value;
			$i++;
		}

		$expresion = "/^([0-9]+)$/i";

		$cedula = $vec[0];

		$condicion = (preg_match($expresion, $vec[0])) ? " a.cedper='".$cedula."'" : " a.codusu = '".$cedula."'";
		
		$f = new cls_fecha();	

		$cn = $this->crear_conexion();
			 	
 	 	$cn->query = "SELECT DISTINCT (a.cedper) as codemp,b.codnom,a.nomper, a.nomper2, a.apeper,a.apeper2, 
 	 	CASE WHEN b.codcar = '0000000000' 
		THEN (SELECT sno_asignacioncargo.denasicar from sno_asignacioncargo WHERE  sno_asignacioncargo.codasicar=b.codasicar and sno_asignacioncargo.codnom=b.codnom)
		ELSE (SELECT sno_cargo.descar from sno_cargo where sno_cargo.codcar=b.codcar and sno_cargo.codnom=b.codnom)
		END AS cargo,c.denger as ubicacion,a.fecingper,f.desnom,d.codasicar, a.sexper,a.codper,a.codusu,a.cedsup,a.codger,e.desuniadm as unidad, concat(trim(b.minorguniadm),trim(b.ofiuniadm),trim(b.uniuniadm),trim(b.prouniadm),trim(b.depuniadm)) as cod_unidad
		from sno_personal as a 
		inner join sno_personalnomina as b on (a.codper=b.codper)
		inner join sno_unidadadmin as e on (e.minorguniadm=b.minorguniadm and e.ofiuniadm=b.ofiuniadm and b.uniuniadm=e.uniuniadm and e.prouniadm=b.prouniadm and b.depuniadm=e.depuniadm)
		inner join srh_gerencia as c on a.codger=c.codger
		join sno_asignacioncargo as d on (b.codasicar = d.codasicar)		
		join sno_nomina as f on (b.codnom=f.codnom) 
		where ".$condicion." and b.staper in ('1','2') order by b.codnom";	
		$cn->ejecutar();
		$result = $cn->consultar();		

		$sql3 = $cn->query = "SELECT DISTINCT (a.cedper) as codemp,b.codnom,a.nomper, a.nomper2, a.apeper,a.apeper2, 
 	 	CASE WHEN b.codcar = '0000000000' 
		THEN (SELECT sno_asignacioncargo.denasicar from sno_asignacioncargo WHERE  sno_asignacioncargo.codasicar=b.codasicar and sno_asignacioncargo.codnom=b.codnom)
		ELSE (SELECT sno_cargo.descar from sno_cargo where sno_cargo.codcar=b.codcar and sno_cargo.codnom=b.codnom)
		END AS cargo, d.codasicar, a.sexper,a.codper,a.codusu,a.cedsup,a.codger
		from sno_personal as a 
		inner join sno_personalnomina as b on (a.codper=b.codper)
		join sno_asignacioncargo as d on (b.codasicar = d.codasicar)		
		where a.cedper='".$result["cedsup"]."' and b.staper in ('1','2') order by b.codnom";	
		$cn->query = $sql3;
		$cn->ejecutar();
		$rs1 = $cn->consultar();	
		$this->nombre_supervisor = ucfirst(trim(utf8_encode($rs1[2]." ".$rs1[3]." ".$rs1[4]." ".$rs1[5])));
		$this->cargo_supervisor = utf8_encode($rs1[6]);		
		$this->correo_supervisor =$rs1["codusu"];

		$arreglo = array(
						"codigo_empleado" => $result["codemp"],
						"codigo_personal" => $result["codper"],
						"codigo_nomina" => $result["codnom"],
						"nombre" => utf8_encode($result["nomper"]." ".$result["nomper2"]." ".$result["apeper"]." ".$result["apeper2"]),
						"cargo" => utf8_encode($result["cargo"]),
						"fecha_ingreso" => $f->bd_fecha($result["fecingper"]),
						"sexo" => $result["sexper"],
						"cod_ubicacion" =>  $result["codger"],
						"ubicacion" =>  utf8_encode($result["ubicacion"]),
						"cod_unidad" =>  $result["cod_unidad"],
						"unidad" =>  utf8_encode($result["unidad"]),
						"nombre_nomina" => utf8_encode($result["desnom"]),
						"nombre_supervisor" => ucfirst(trim(utf8_encode($rs1[2]." ".$rs1[3]." ".$rs1[4]." ".$rs1[5]))),
						"cargo_supervisor" => $this->cargo_supervisor = utf8_encode($rs1[6]),
						"cedula_supervisor" => $result["cedsup"],
						"correo_supervisor" => $rs1["codusu"]
					);
		$cn->close();
		return $arreglo;
	}#end function

	function consultarUbicacion($arr=""){	
		
		$i = 0;
		$sep = "";

		$i = 0;
		foreach($arr as $key=>$value){
			$vec[$i] = $value;
			$cad .= $sep."'".$value."'";
			$sep = ",";
			$i++;
		}

		if(!empty($cad)){
			$condicion = " a.cedper in(".$cad.") and ";			
		}
		$f = new cls_fecha();	
		$cn = $this->crear_conexion();		 	
 	 	$cn->query = "SELECT a.cedper as codemp,b.codnom,a.nomper, a.nomper2, a.apeper,a.apeper2, 
 	 	CASE WHEN b.codcar = '0000000000' 
		THEN (SELECT sno_asignacioncargo.denasicar from sno_asignacioncargo WHERE  sno_asignacioncargo.codasicar=b.codasicar and sno_asignacioncargo.codnom=b.codnom)
		ELSE (SELECT sno_cargo.descar from sno_cargo where sno_cargo.codcar=b.codcar and sno_cargo.codnom=b.codnom)
		END AS cargo,c.denger as ubicacion,a.fecingper,f.desnom,d.codasicar, a.sexper,a.codper,a.codusu,a.cedsup,a.codger,e.desuniadm as unidad, concat(trim(b.minorguniadm),trim(b.ofiuniadm),trim(b.uniuniadm),trim(b.prouniadm),trim(b.depuniadm)) as cod_unidad
		from sno_personal as a 
		inner join sno_personalnomina as b on (a.codper=b.codper)
		inner join sno_unidadadmin as e on (e.minorguniadm=b.minorguniadm and e.ofiuniadm=b.ofiuniadm and b.uniuniadm=e.uniuniadm and e.prouniadm=b.prouniadm and b.depuniadm=e.depuniadm)
		inner join srh_gerencia as c on a.codger=c.codger
		inner join sno_asignacioncargo as d on (b.codasicar = d.codasicar and b.codnom=d.codnom)		
		inner join sno_nomina as f on (b.codnom=f.codnom)
		where ".$condicion."b.codnom in('0001','0002','0003','0006','0007','1001','1002') and b.staper in ('1','2')";
		$cn->ejecutar();
		while($result = $cn->consultar()){
			$arreglo[$result["codemp"]] = array(
				"codigo_empleado" => $result["codemp"],
				"nombre" => utf8_encode($result["nomper"]." ".$result["nomper2"]." ".$result["apeper"]." ".$result["apeper2"]),
				"cargo" => utf8_encode($result["cargo"]),
				"fecha_ingreso" => $f->bd_fecha($result["fecingper"]),
				"sexo" => $result["sexper"],
				"cod_ubicacion" =>  $result["codger"],
				"ubicacion" =>  utf8_encode($result["ubicacion"]),
				"cod_unidad" =>  $result["cod_unidad"],
				"unidad" =>  utf8_encode($result["unidad"]),
				"nombre_nomina" => utf8_encode($result["desnom"]),
				"codigo_nomina" => $result["codnom"],
				"cedula_supervisor" => $result["cedsup"]
			);
		}
		$cn->close();
		return $arreglo;
	}#end function

	function consultarEmpleadosSupervisor($arr=""){
		$i = 0;
		$sep = "";

		$i = 0;
		foreach($arr as $key=>$value){
			$vec[$i] = $value;
			$cad .= $sep."'".$value."'";
			$sep = ",";
			$i++;
		}

		if(!empty($cad)){
			$condicion = " a.cedsup in(".$cad.") and ";			
		}
		$f = new cls_fecha();	
		$cn = $this->crear_conexion();
 	 	$cn->query = "SELECT a.cedper as codemp,b.codnom,a.nomper, a.nomper2, a.apeper,a.apeper2, 
 	 	CASE WHEN b.codcar = '0000000000' 
		THEN (SELECT sno_asignacioncargo.denasicar from sno_asignacioncargo WHERE  sno_asignacioncargo.codasicar=b.codasicar and sno_asignacioncargo.codnom=b.codnom)
		ELSE (SELECT sno_cargo.descar from sno_cargo where sno_cargo.codcar=b.codcar and sno_cargo.codnom=b.codnom)
		END AS cargo,c.denger as ubicacion,a.fecingper,f.desnom,d.codasicar, a.sexper,a.codper,a.codusu,a.cedsup,a.codger,e.desuniadm as unidad, concat(trim(b.minorguniadm),trim(b.ofiuniadm),trim(b.uniuniadm),trim(b.prouniadm),trim(b.depuniadm)) as cod_unidad
		from sno_personal as a 
		inner join sno_personalnomina as b on (a.codper=b.codper)
		inner join sno_unidadadmin as e on (e.minorguniadm=b.minorguniadm and e.ofiuniadm=b.ofiuniadm and b.uniuniadm=e.uniuniadm and e.prouniadm=b.prouniadm and b.depuniadm=e.depuniadm)
		inner join srh_gerencia as c on a.codger=c.codger
		inner join sno_asignacioncargo as d on (b.codasicar = d.codasicar and b.codnom=d.codnom)		
		inner join sno_nomina as f on (b.codnom=f.codnom)
		where ".$condicion."b.codnom in('0001','0002','0003','0006','0007','1001','1002') and b.staper in ('1','2')
		ORDER BY a.cedsup ASC, a.nomper ASC";
		$cn->ejecutar();
		while($result = $cn->consultar()){
			$arreglo[$result["codemp"]] = array(
				"codigo_empleado" => $result["codemp"],
				"nombre" => utf8_encode($result["nomper"]." ".$result["nomper2"]." ".$result["apeper"]." ".$result["apeper2"]),
				"cargo" => utf8_encode($result["cargo"]),
				"fecha_ingreso" => $f->bd_fecha($result["fecingper"]),
				"sexo" => $result["sexper"],
				"cod_ubicacion" =>  $result["codger"],
				"ubicacion" =>  utf8_encode($result["ubicacion"]),
				"cod_unidad" =>  $result["cod_unidad"],
				"unidad" =>  utf8_encode($result["unidad"]),
				"nombre_nomina" => utf8_encode($result["desnom"]),
				"codigo_nomina" => $result["codnom"],
				"cedula_supervisor" => $result["cedsup"]
			);
		}
		$cn->close();
		return $arreglo;
	}#end function

	function consultarEmpleadosSupervisorAlt($arr=""){
		$i = 0;
		$sep = "";

		$i = 0;
		foreach($arr as $key=>$value){
			$vec[$i] = $value;
			$cad .= $sep."'".$value."'";
			$sep = ",";
			$i++;
		}

		if(!empty($cad)){
			$condicion = " a.cedsup_alt in(".$cad.") and ";			
		}
		$f = new cls_fecha();	
		$cn = $this->crear_conexion();		 	
 	 	$cn->query = "SELECT a.cedper as codemp,b.codnom,a.nomper, a.nomper2, a.apeper,a.apeper2, 
 	 	CASE WHEN b.codcar = '0000000000' 
		THEN (SELECT sno_asignacioncargo.denasicar from sno_asignacioncargo WHERE  sno_asignacioncargo.codasicar=b.codasicar and sno_asignacioncargo.codnom=b.codnom)
		ELSE (SELECT sno_cargo.descar from sno_cargo where sno_cargo.codcar=b.codcar and sno_cargo.codnom=b.codnom)
		END AS cargo,c.denger as ubicacion,a.fecingper,f.desnom,d.codasicar, a.sexper,a.codper,a.codusu,a.cedsup,a.codger,e.desuniadm as unidad, concat(trim(b.minorguniadm),trim(b.ofiuniadm),trim(b.uniuniadm),trim(b.prouniadm),trim(b.depuniadm)) as cod_unidad
		from sno_personal as a 
		inner join sno_personalnomina as b on (a.codper=b.codper)
		inner join sno_unidadadmin as e on (e.minorguniadm=b.minorguniadm and e.ofiuniadm=b.ofiuniadm and b.uniuniadm=e.uniuniadm and e.prouniadm=b.prouniadm and b.depuniadm=e.depuniadm)
		inner join srh_gerencia as c on a.codger=c.codger
		inner join sno_asignacioncargo as d on (b.codasicar = d.codasicar and b.codnom=d.codnom)		
		inner join sno_nomina as f on (b.codnom=f.codnom)
		where ".$condicion."b.codnom in('0001','0002','0003','0006','0007','1001','1002') and b.staper in ('1','2')";
		$cn->ejecutar();
		while($result = $cn->consultar()){
			$arreglo[$result["codemp"]] = array(
				"codigo_empleado" => $result["codemp"],
				"nombre" => utf8_encode($result["nomper"]." ".$result["nomper2"]." ".$result["apeper"]." ".$result["apeper2"]),
				"cargo" => utf8_encode($result["cargo"]),
				"fecha_ingreso" => $f->bd_fecha($result["fecingper"]),
				"sexo" => $result["sexper"],
				"cod_ubicacion" =>  $result["codger"],
				"ubicacion" =>  utf8_encode($result["ubicacion"]),
				"cod_unidad" =>  $result["cod_unidad"],
				"unidad" =>  utf8_encode($result["unidad"]),
				"nombre_nomina" => utf8_encode($result["desnom"]),
				"codigo_nomina" => $result["codnom"],
				"cedula_supervisor" => $result["cedsup"]
			);
		}
		$cn->close();
		return $arreglo;
	}#end function


	function consultarEmpleadosCodUbicacion($arr=""){
		$i = 0;
		$sep = "";

		$i = 0;
		foreach($arr as $key=>$value){
			$vec[$i] = $value;
			$cad .= $sep."'".$value."'";
			$sep = ",";
			$i++;
		}

		if(!empty($cad)){
			$condicion = " a.codger=".$cad." and ";
		}

		$f = new cls_fecha();	
		$cn = $this->crear_conexion();		 	
 	 	$cn->query = "SELECT a.cedper as codemp,b.codnom,a.nomper, a.nomper2, a.apeper,a.apeper2, 
 	 	CASE WHEN b.codcar = '0000000000' 
		THEN (SELECT sno_asignacioncargo.denasicar from sno_asignacioncargo WHERE  sno_asignacioncargo.codasicar=b.codasicar and sno_asignacioncargo.codnom=b.codnom)
		ELSE (SELECT sno_cargo.descar from sno_cargo where sno_cargo.codcar=b.codcar and sno_cargo.codnom=b.codnom)
		END AS cargo,c.denger as ubicacion,a.fecingper,f.desnom,d.codasicar, a.sexper,a.codper,a.codusu,a.cedsup,a.codger,e.desuniadm as unidad, concat(trim(b.minorguniadm),trim(b.ofiuniadm),trim(b.uniuniadm),trim(b.prouniadm),trim(b.depuniadm)) as cod_unidad
		from sno_personal as a 
		inner join sno_personalnomina as b on (a.codper=b.codper)
		inner join sno_unidadadmin as e on (e.minorguniadm=b.minorguniadm and e.ofiuniadm=b.ofiuniadm and b.uniuniadm=e.uniuniadm and e.prouniadm=b.prouniadm and b.depuniadm=e.depuniadm)
		inner join srh_gerencia as c on a.codger=c.codger
		inner join sno_asignacioncargo as d on (b.codasicar = d.codasicar and b.codnom=d.codnom)		
		inner join sno_nomina as f on (b.codnom=f.codnom)
		where ".$condicion."b.codnom in('0001','0002','0003','0006','0007','1001','1002') and b.staper in ('1','2')
		ORDER BY a.cedper ASC";
		$cn->ejecutar();
		while($result = $cn->consultar()){
			$arreglo[$result["codemp"]] = array(
				"codigo_empleado" => $result["codemp"],
				"nombre" => utf8_encode($result["nomper"]." ".$result["nomper2"]." ".$result["apeper"]." ".$result["apeper2"]),
				"cargo" => utf8_encode($result["cargo"]),
				"fecha_ingreso" => $f->bd_fecha($result["fecingper"]),
				"sexo" => $result["sexper"],
				"cod_ubicacion" =>  $result["codger"],
				"ubicacion" =>  utf8_encode($result["ubicacion"]),
				"cod_unidad" =>  $result["cod_unidad"],
				"unidad" =>  utf8_encode($result["unidad"]),
				"nombre_nomina" => utf8_encode($result["desnom"]),
				"codigo_nomina" => $result["codnom"],
				"cedula_supervisor" => $result["cedsup"]
			);
		}
		$cn->close();
		return $arreglo;
	}#end function

	function consultarEmpleadosCodUnidad($arr=""){
		$i = 0;
		$sep = "";

		$i = 0;
		foreach($arr as $key=>$value){
			//$vec[$i] = $value;
			$cad .= $value;
			//$sep = ",";
			//$i++;
		}

		if(!empty($cad)){
			$condicion = "e.minorguniadm='".substr($cad, 0,4)."' AND ".
						"e.ofiuniadm='".substr($cad, 4,2)."' AND ".
						"e.uniuniadm='".substr($cad, 6,2)."' AND ".
						"e.depuniadm='".substr($cad, 8,2)."' AND ";
		}

		$f = new cls_fecha();	
		$cn = $this->crear_conexion();			 	
 	 	$cn->query = "SELECT a.cedper as codemp,b.codnom,a.nomper, a.nomper2, a.apeper,a.apeper2, 
 	 	CASE WHEN b.codcar = '0000000000' 
		THEN (SELECT sno_asignacioncargo.denasicar from sno_asignacioncargo WHERE  sno_asignacioncargo.codasicar=b.codasicar and sno_asignacioncargo.codnom=b.codnom)
		ELSE (SELECT sno_cargo.descar from sno_cargo where sno_cargo.codcar=b.codcar and sno_cargo.codnom=b.codnom)
		END AS cargo,c.denger as ubicacion,a.fecingper,f.desnom,d.codasicar, a.sexper,a.codper,a.codusu,a.cedsup,a.codger,e.desuniadm as unidad, concat(trim(b.minorguniadm),trim(b.ofiuniadm),trim(b.uniuniadm),trim(b.prouniadm),trim(b.depuniadm)) as cod_unidad
		from sno_personal as a 
		inner join sno_personalnomina as b on (a.codper=b.codper)
		inner join sno_unidadadmin as e on (e.minorguniadm=b.minorguniadm and e.ofiuniadm=b.ofiuniadm and b.uniuniadm=e.uniuniadm and e.prouniadm=b.prouniadm and b.depuniadm=e.depuniadm)
		inner join srh_gerencia as c on a.codger=c.codger
		inner join sno_asignacioncargo as d on (b.codasicar = d.codasicar and b.codnom=d.codnom)		
		inner join sno_nomina as f on (b.codnom=f.codnom)
		where ".$condicion."b.codnom in('0001','0002','0003','0006','0007','1001','1002') and b.staper in ('1','2')
		ORDER BY a.cedper ASC";
		$cn->ejecutar();
		while($result = $cn->consultar()){
			$arreglo[$result["codemp"]] = array(
				"codigo_empleado" => $result["codemp"],
				"nombre" => utf8_encode($result["nomper"]." ".$result["nomper2"]." ".$result["apeper"]." ".$result["apeper2"]),
				"cargo" => utf8_encode($result["cargo"]),
				"fecha_ingreso" => $f->bd_fecha($result["fecingper"]),
				"sexo" => $result["sexper"],
				"cod_ubicacion" =>  $result["codger"],
				"ubicacion" =>  utf8_encode($result["ubicacion"]),
				"cod_unidad" =>  $result["cod_unidad"],
				"unidad" =>  utf8_encode($result["unidad"]),
				"nombre_nomina" => utf8_encode($result["desnom"]),
				"codigo_nomina" => $result["codnom"],
				"cedula_supervisor" => $result["cedsup"]
			);
		}
		$cn->close();
		return $arreglo;
	}#end function

	function consultarEmpleadosSupervisorSED($arr=""){
		$cn = $this->crear_conexion_mysql("sed");
		$i = 0;
		foreach($arr as $key=>$value){
			$vec["c".$i] = $value;
			$cad .= $sep."'".$value."'";
			$sep = ",";
			$i++;
		}
		if(empty($cad)){
			return array('Mensaje' => "Su búsqueda no produjo resultados");
		}
		$cn->query = "SELECT cedemp from nptrabajadores_sed where cedsup in (".$cad.") order by nombre, nombre2, apellido, apellido2 ASC";
		$cn->ejecutar();
		$i = 0;
		if($cn->reg_total>0){
			while ($rs = $cn->consultar()) {
				$vec["c".$i] = $rs[0];
				$i++;
			}
		}else{
			return array('Mensaje' => "Su búsqueda no produjo resultados");
		}
		$arreglo = $this->consultarUbicacion($vec);
		$cn->close();
		return $arreglo;
	}#end function

	function consultarDescripcionUnidad($arr=""){
		$i = 0;
		$sep = "";

		$i = 0;
		foreach($arr as $key=>$value){
			$cad .= $value;
		}

		if(!empty($cad)){
			$condicion = "e.minorguniadm='".substr($cad, 0,4)."' AND ".
						"e.ofiuniadm='".substr($cad, 4,2)."' AND ".
						"e.uniuniadm='".substr($cad, 6,2)."' AND ".
						"e.depuniadm='".substr($cad, 8,2)."'";
		}

		$cn = $this->crear_conexion();
		$cn->query = "SELECT desuniadm FROM sno_unidadadmin e WHERE ".$condicion;
		$cn->ejecutar();
		
		$result = $cn->consultar();
		$arreglo["cod_unidad"] = $cad;
		$arreglo["unidad"] = utf8_encode($result["desuniadm"]);

		$cn->close();
		return $arreglo;
	}#end function

	function consultarDescripcionUbicacion($arr=""){
		$i = 0;
		$sep = "";

		$i = 0;

		foreach($arr as $key=>$value){
			$cad .= $sep."'".$value."'";
			$sep = ",";
		}

		$cn = $this->crear_conexion();
		$cn->query = "SELECT codger,denger FROM srh_gerencia e WHERE codger IN(".$cad.")";
		$cn->ejecutar();
		while($result = $cn->consultar()){
			$arreglo[trim($result["codger"])] = array("cod_ubicacion" => trim($result["codger"]),"ubicacion" => $result["denger"]);
		}
		$cn->close();
		return $arreglo;
	}#end function

}#end class

//ini_set('display_errors', '1');

#Incluir Clases
function __autoload($class_name){
    require_once "../cls/".$class_name.'.php';
}//end function

ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache
$url_wsdl = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME'])."/";
$wsdl = "empleados.wsdl";
$soap_server  = new SoapServer($url_wsdl.$wsdl);
$soap_server->setClass("Servicios", $soap_server);
$soap_server->handle();

//$emp = new Servicios();

/*
->0101020000 2
->0101020300 2
->0101020100 2
*/
/*
$arr = $emp->consultarEmpleadosCodUnidad(array('u' => '0101020000'));
print_r($arr);*/
?>