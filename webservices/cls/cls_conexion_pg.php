<?php

/*class prop_campos{
	var $nombre;
	var $longitud;
	var $flags;
	var $tabla;
	var $tipo_m;
	var $tipo;
	var $default;
	var $null;
	var $key;
	var $extra;
}// end class*/
require_once("cls_constantes_pg.php");
class cls_conexion_pg{
	var $servidor = C_SERVIDOR_PG;//C_SERVIDOR_PG produccion;
	var $bdatos = C_BDATOS_PG;//C_BDATOS_PG;
	var $usuario = C_USUARIO_PG;//C_USUARIO_PG;
	var $password = C_PASSWORD_PG;//C_PASSWORD_PG;
	var $conexion;
	//======================
	var $query;
	var $tabla;
	var $registros;
	var $nro_filas = 0;
	var $nro_campos;
	var $paginacion = C_NO;
	var $pagina = 0;
	var $nro_paginas;
	var $reg_ini = C_REG_INI;
	var $reg_bloque = C_REG_BLOQUE;
	public $reg_total = 0;
	var $propietario = C_BD_ADMINISTRACION;
	var $cfg_prop = "false";
	var $modo = "";
	var $alias_tabla;
	var $arreglo_registros;					#Arreglo de Registro
	//======================
	var $insert_id;
	//======================
	var $en_transaccion = C_NO;
	var $error=false;
	var $errno=0;
	var $errno_m;
	var $errmsg="";
	var $mensaje_error;
	var $errabs = 0;
	var $error_detectado = false;
	var $mostrar_error = true;
	var $es_consulta;
	var $tipo_sentencia="";	
	//=============================
	// propiedades para los campos
	var $nombre;
	var $tipo;
	var $tipo_m;
	var $longitud;
	var $valor;
	var $val_enum;
	// errores en la conexion
	// propiedades para los registros
	var $resultset;
	var $registro;
	var $n_filas;
	var $n_campos;
	var $con_descrip=false;
	var $taux = "_t_aux";
	var $ckeys = "";
	var $claves;
	#String de Conexion
	var $imprimir_conexion = false;
	var $ip_imprimir_conexion = "";
	var $order_by = "";							#Campo por el que se desea ordenar el query en caso de activar la paginacion
	var $orden = "0";
#===========================================================
	function conectar(){		
		//if($_SERVER["REMOTE_ADDR"]=="172.17.12.63")		
		//echo  "<br>". $_SERVER["SERVER_ADDR"]."-".$this->servidor."-".$this->password."-".$this->usuario."-".$this->bdatos."->". $this->query;
		$this->conexion = pg_connect("host=$this->servidor password=$this->password user=$this->usuario dbname=$this->bdatos");
    if (pg_ErrorMessage($this->conexion)) { 
	     echo "<p><b>Ocurrio un error conectando a la base de datos: .</b></p>"; 
   	  exit; 
     }
    
	}#end function
#===========================================================	  
	public function ejecutar($query_x="",$pg_conex=""){
		//if($_SERVER["REMOTE_ADDR"]=="172.17.12.63") echo "->". $this->query;
		//$query = ($query_x=="") ? pg_escape_string($this->query) : pg_escape_string($this->query_x);   
		$query = ($query_x=="") ? $this->query : $this->query_x;
		$query = $this->hacer_query($query);		 
		$this->tipo_sentencia = $this->tipo_sentencia($query);		
		$result = ($pg_conex=="") ? pg_query($this->conexion,$query) : pg_query($pg_conex,$query);		
		
		if (pg_last_error($this->conexion)){			
			//$this->es_error(true);
			echo $this->mensaje_error =pg_last_error($this->conexion);
			echo $this->errmsg = pg_result_error($result);
			return false;
			exit();
		}#end if
		
		if ($this->es_select($result)){

			$this->nro_filas = pg_num_rows($result);
			$this->nro_campos = pg_num_fields($result);
			$this->reg_total = $this->nro_filas;			

			if ($this->paginacion == C_SI and is_numeric($this->reg_ini) and is_numeric($this->reg_bloque) and substr_count(strtoupper(substr($query,0,10)),strtoupper("SELECT "))>0 and substr_count(strtoupper($query),strtoupper(" LIMIT "))==0){

				$reg_ini = $this->reg_ini;
				$reg_bloque = $this->reg_bloque;
				$this->nro_paginas = ceil($this->reg_total/$this->reg_bloque);
				if ($this->pagina==0){
					$this->pagina = $this->nro_paginas;
				}// end if
				if (is_numeric($this->pagina)){
					$this->pagina = abs($this->pagina);
					if ($this->pagina > $this->nro_paginas){
						$this->pagina = $this->nro_paginas;
					}// end if
					$reg_ini = $reg_bloque * ($this->pagina-1);
				}else{
					$this->pagina = 1;
				}// end if

				if($this->order_by!=""){
					list($q,$c) = explode("order by",$query);
					$this->obtener_campos($query);
					$asc_desc = array("ASC","DESC");
					if($this->campos[$this->order_by] != "" and $this->campos[$this->order_by] != "*"){
						$query = $q." order by ".$this->campos[$this->order_by]." ".$asc_desc[$this->orden];
					}#end if
				}#end if

				$limit = " LIMIT $reg_ini,$reg_bloque";				
				$result = pg_query($query.$limit);
				if($result){
					$this->nro_filas = pg_num_rows($result);
				}#end if
			}// end if
		}else{
			$this->filas_afectadas = pg_affected_rows($result);
			//$this->insert_id = mysql_insert_id(); postgres SELECT last_value FROM nombretabla_nombre campo_seq
			
		}// end if
		$this->resultset = $result;		
		return $this->resultset;
	}#end function
#===========================================================
	function consultar($result_x=""){
		//echo "-->>>".$this->es_consulta."<<<--";
		if(!$this->es_consulta)
			return false;
		if ($result_x==""){
			$result_x = $this->resultset;
		}// end if
		//echo "<br>Result: -*->".$result_x;
		if($result_x!=""){
			$arreglo_x = pg_fetch_array($result_x);
		}#end if
		return $arreglo_x;
	}#end function
#===========================================================
	function hacer_query($query_x){
		$nro_palabras = explode(" ",$query_x);
		if (count($nro_palabras)>1 or substr_count(strtoupper(substr($query_x,0,10)),strtoupper("SELECT "))>0){
			return $query_x;
		}// end if
		$this->tabla[0] = $query_x;
		return "SELECT * FROM ".$this->tabla[0];
	}# end function
#===========================================================
	function tipo_sentencia($query_x=""){
		if($query_x==""){
			$query_x = $this->query;
		}//end if
		$query_x = strtoupper($query_x);
		if (substr($query_x,0,6) == "SELECT"){
			return "SELECT";
        }else if (substr($query_x,0,6) == "UPDATE"){
			return "UPDATE";
        }else if (substr($query_x,0,6) == "INSERT"){
			return "INSERT";
        }else if (substr($query_x,0,6) == "DELETE"){
			return "DELETE";
			}else if (substr($query_x,0,4) == "CALL"){
			return "STORE_PROCEDURE";
        }else{
			return "SELECT";
		}# end if
	}#end function
#===========================================================
	function es_select($result_x){		
		if(substr("'".$result_x."'",0,8)=="Resource" or substr_count(strtoupper(substr($this->query,0,10)),strtoupper("SELECT "))>0 or strtoupper(substr($this->query,0,7)) == "SELECT\n"){			
			$this->es_consulta = true;
			return true;
      }// end if
		$this->es_consulta = false;
      return false;
	}// end function
#===========================================================

	
	
	
	//=============== Hector Poli 19/06/2012============================================
	// NO BORRAR ESTA FUNCION, SIRVE PARA CERRAR LAS CONEXIONES ABIERTAS, CUALQUIER COSA ME PREGUNTAN
	function close($cn_x=""){
		$this->usuario = "";
		$this->password = "";
		$this->estado=false;
		if($cn_x!=""){
			pg_close($cn_x);
		}else{
			if($this->conexion){
				pg_close($this->conexion);
			}#end if
		}//end if
	}//end function
	//==========================================================================================
	
	
}#end class


/*$cn = new cls_conexion_pg();
$cn->conectar();
$cn->query = "select * from srh_departamento";
echo $cn->ejecutar();
while($rs = $cn->consultar()){
	prin "<br>". $rs["dendep"];
}*/
?>