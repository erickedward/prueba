<?php
define ("C_ERROR_RANGO_F","La fecha \"Desde\" debe ser menor o igual a la fecha \"Hasta\"");
class cls_funciones{	
	var $buscar;							#La palabra q se desea buscar con el buscador
	var $error;								#Variable de Errores
	var $onclick_buscador="";			#Evento Onclick del Buscador
	var $keypress_buscador = "";		#Evento OnKeyPress del textbox Buscador
	var $final_resumen = " (...)";
	##############################
	#Propiedades para metodo control_imagen()	
	var $titulo_imagen="";				#Titulo en la Imagenes
	var $ruta_imagen="";					#Ruta de la Imagen
	var $onclick_imagen="";				#Evento Onclick de la Imagen
	var $onmouseover_imagen="";
	var $onmouseout_imagen="";
	var $align_imagen = "";
	var $class_imagen="";	
	var $id_imagen="";
	var $alt_imagen = "";
	##############################
	#Propiedades para metodo malla	
	var $num_registros = 0;
	var $columnas = 3;
	var $ar_contenidos = array();
	var $align = "center";
	var $width = "100%";
	var $class_malla = "";
	var $valign_malla = "top";
	var $align_malla = "";
	var $titulo_malla = "";
	var $cellpadding_malla = 0;
	var $bgcolor_malla = "#FFFFFF";
	##############################
	#Propiedades para Optener IP
	var $ip_publica = "";
	var $ip_proxy = "";
	var $ambiente_pruebas = "172.17.2.185";
	var $id_buscador = "";
	#Propiedades para envio de correo
	var $html= false;								#Para mandar el mensaje en formato HTML
	var $cc = "";									#Con Copia
	var $bcc = "";									#Con Copia Oculta
	//================================================================================================
	function buscador($buscar_x=""){
		if($buscar_x!=""){
			$this->buscar = $buscar_x;
		}//end if
		$tabla_search = new cls_table(1,2);
		$tabla_search->border = 0;
		$tabla_search->cellspacing = "1";
		$tabla_search->cellpadding = "1";
		$pos = $align[$align_x];
		$tabla_search->align = "center";
		$tabla_search->width = "100%";
		$tabla_search->height="24";
		$row = $tabla_search->rows-1;
		//====================================================================
		$objeto_search = new cls_element_html();
		$objeto_search->type = "text";
		$objeto_search->name = "q_aux";
		$objeto_search->value = $this->buscar;
		$objeto_search->id = $this->id_buscador;
		$objeto_search->size = "20";
		$objeto_search_2 = new cls_element_html();
		$objeto_search_2->type = "submit";
		//$objeto_search_2->src = "imagenes/bot_buscar.gif";
		$objeto_search_2->name = "buscar";
		$objeto_search_2->value = "Buscar";
		$objeto_search_2->class = C_ESTILO_BOTONES_FORM;
		$objeto_search_2->onclick = $this->onclick_buscador;
		$objeto_search->onkeypress = "enviar_formulario_enter((evt = (event.keyCode)?event.keyCode:window.event),'".$this->keypress_buscador."')";
		/*$objeto_search_2->class = "submit";*/
		/*$tabla_search->cell[0][0]->text = "";
		$tabla_search->cell[0][0]->height = "8";*/
		$tabla_search->cell[0][0]->text = $objeto_search->control();
		$tabla_search->cell[0][0]->width = "200";
		$tabla_search->cell[0][0]->align = "right";
		$tabla_search->cell[0][1]->width = "5%";
		$tabla_search->cell[0][0]->width = "95%";
		$tabla_search->cell[0][1]->valign = "top";
		//$tabla_search->cell[0][0]->class = "buscador";
		$tabla_search->cell[0][1]->text = $objeto_search_2->control();
		//."<a href=http://intranetcnu.prueba.cnu.gov.ve/busqueda.php class=\"buq_adv\">busqueda Avanzada</a>"; 
		$tabla_search->cell[0][1]->valign = "bottom";
		//$tabla_search->cell[2][0]->;
		//$tabla_search->cell[2][0]->height = "8";
		$form_search .= $tabla_search->control();
		return $form_search;
		//====================================================================
	}//end function
	//================================================================================================
	function obtener_so(){
		//echo php_uname();
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			//echo "WINDOWS";
			return "1";
		}else if(strtoupper(substr(PHP_OS, 0, 5)) === 'LINUX'){
			//echo "LINUX";
			return "2";	
		}else{
			return "3";
		}//end if
	}//end function
	//================================================================================================
	function obtener_browser(){
		$browser = $_SERVER['HTTP_USER_AGENT'];
		$nav = "MSIE";
		if(strstr($browser,$nav)){
			$brow = 0;
		}else{
			$brow = 1;
		}//end if
		return $brow;
	}//end function
	//================================================================================================
	function obtener_resumen($cadena_x, $cantidad_x="200"){
		$cadena = substr($cadena_x,0,$cantidad_x); //extraigo los primeros 200 caracteres
		$cad = explode(' ',$cadena);
		for($i=0;$i<count($cad)-1;$i++){
			$sep = ($i==0)?(""):(" ");
			$resumen_x .= $sep.$cad[$i];
		}
		return $resumen_x.$this->final_resumen;
	}//end function
	//================================================================================================
	function validar_rango_fecha($fecha_x,$fecha_y){
		$fecha_x = substr($fecha_x,0,10);
		$fecha_y = substr($fecha_y,0,10);
		$f = explode("/",$fecha_x);
		$g = explode("/",$fecha_y);
		if((count($f)>1 and $f[2] != "0000") and (count($g)>1 and $g[2] != "0000")){
			if($f[2] <= $g[2]){
				if($f[1] <= $g[1]){
					if($f[0] <= $g[0]){
						return true;
					}else{
						$this->error = C_ERROR_RANGO_F;
						return false;
					}//end if
				}else{
						$this->error = C_ERROR_RANGO_F;
						return false;
				}//end if
			}else{
					$this->error = C_ERROR_RANGO_F;
					return false;
			}//end if
		}else{
			return false;
		}//end if
	}//end function
	//================================================================================================
	function alert($msg_x){
		if($this->ambiente_pruebas == $_SERVER["SERVER_ADDR"]){
			$cad = "\n<script language=\"javascript1.2\" type=\"text/javascript\">";
			$cad .= "\n\talert(\"$msg_x\")";
			$cad .= "\n</script>";
			//echo $cad;
		}#end if
	}// end function
	//================================================================================================
	function hr($msg_x){
	//	echo "<hr>$msg_x<hr>";
	}// end function
	//================================================================================================
	function extraer_var($cadena_x=""){
		if($cadena_x==""){ 
			return false;
		}// end if
		$gpo = explode(C_SEP_L,$cadena_x);
		return $gpo;
	}// end function
	//================================================================================================
	function formato_fecha($fecha_x){
		$f = explode("-",$fecha_x);
		if(count($f)>1)
		return $f[2]."/".$f[1]."/".$f[0];
		else
			return "";
	}// end function
	//================================================================================================
	function control_imagen($imagen_x,$ancho_x="",$alto_x=""){		
		if($imagen_x!=""){		
			$onclick = ""; $titulo="";
			if($ancho_x!=""){
				$ancho_x = " width=\"$ancho_x\"";
			}//end if
			if($alto_x!=""){
				//$alto_x = "150";
				$alto_x = " height=\"$alto_x\"";
			}//end if
			$titulo = "";
			if($this->titulo_imagen!=""){
				$titulo = " title=\"$this->titulo_imagen\"";
				$this->titulo_imagen = "";
			}//end if
			if($this->onclick_imagen!=""){
				$onclick = " onclick=\"$this->onclick_imagen\" style=\"cursor:pointer\"";
				$this->onclick_imagen = "";
			}//end if
			if($this->align_imagen!=""){
				$align = " align=\"$this->align_imagen\"";
				$this->align_imagen = "";
			}//end if
			if($this->valign_imagen!=""){
				$valign = " valign=\"$this->valign_imagen\"";
				$this->valign_imagen = "";
			}//end if
			if($this->onmouseover_imagen!=""){
				$onmouseover = " onmouseover=\"$this->onmouseover_imagen\"";
				$this->onmouseover_imagen = "";		
			}//end if
			if($this->onmouseout_imagen!=""){
				$onmouseout = " onmouseout=\"$this->onmouseout_imagen\"";
				$this->onmouseout_imagen = "";		
			}//end if
			if($this->class_imagen!=""){
				$class = " class=\"$this->class_imagen\"";
				$this->class_imagen = "";		
			}//end if
			if($this->id_imagen!=""){
				$id = " id=\"$this->id_imagen\"";
				$this->id_imagen = "";	
			}//end if
			if($this->alt_imagen!=""){
				$alt = " alt=\"$this->alt_imagen\"";
			}else{
				$im = explode("/",$imagen_x);
				$alt = " alt=\"".$im[count($im)-1]."\"";		
			}//end if
			return "<img$id src=\"$this->ruta_imagen$imagen_x\"".$ancho_x.$alto_x.$titulo.$onclick.$align.$onmouseover.$onmouseout.$class.$valign.$alt.">";
		}else{
			return "";		
		}#end if
	}//end function
	//================================================================================================
	function caracter_especial($cadena_x="",$caracter_x="",$modo_x="0"){
		if($cadena_x != "" and $caracter_x != ""){
			if($modo_x!="0"){
				$cad = explode("\\",$cadena_x);
				for($i=0;$i<count($cad);$i++){
					$cad_x .= $cad[$i]; 
				}//next
				$cadena_x = $cad_x;
			}//end if
			$c = $caracter_x;
			$r = "\\".$c;
			$cadena_x = str_replace($c,$r,$cadena_x);
		}//end if
		//echo "<br>->".$cadena_x;
		return $cadena_x;
	}//end if
	//================================================================================================
	function retornar_anios($inicio_x="2000",$final_x="",$modo_x="0"){
		$x=0;
		if($final_x==""){
			$final_x = date(Y);
		}//end if
		for($i=$final_x;$i>=$inicio_x;$i--){
			$arreglo_anios[$x] = $i;
			$x++;
		}//next
		if($modo_x!="0"){
			for($i=0;$i<count($arreglo_anios);$i++){
				$sep = ";";
				if($i == 0){
					$sep = "";
				}//end if
				$arreglo .= $sep.$arreglo_anios[$i].":".$arreglo_anios[$i];
			}//next
			 $arreglo_anios = $arreglo;
		}//end if
		return $arreglo_anios;
	}//end function
	//================================================================================================
	function fecha_bd($fecha_x,$modo="0"){
		$fecha_x = explode("'",$fecha_x);
		if(count($fecha_x)>1){
			$fecha_x = substr($fecha_x[1],0,10);		
		}else{
			$fecha_x = substr($fecha_x[0],0,10);
		}#end if
		$f = explode("/",$fecha_x);
		if(count($f)>1 and $f[2] != "0000"){
			if($modo==0){
				return "'".$f[2]."-".$f[1]."-".$f[0]."'";
			}else{
			return $f[2]."-".$f[1]."-".$f[0];
			}
		}else{
			return "''";
		}//end if
	}//end function
	//==========================================================================================================================
	function bd_fecha2($fecha_x){
		if($fecha_x!=""){
			$this->fecha_bd = $fecha_x;
		}
		$f = explode("-",$this->fecha_bd);
		if(count($f)>1 and $f[2] != "0000"){
			$this->fecha_bd = $f[2]."/".$f[1]."/".$f[0];
			return $this->fecha_bd;
		}else{
			return "";
		}//end if
	}// end function
	//==========================================================================================================================
	function bd_fecha($fecha_x){
		if($fecha_x!=""){
			$this->fecha_bd = $fecha_x;
		}
		$f1 = explode(" ",$this->fecha_bd);
		$f2 = explode("-",$f1[0]);
		$this->fecha_bd = $f2[2]."/".$f2[1]."/".$f2[0];
		if($f1[1]!=""){
			$this->fecha_bd .= " ".$f1[1];
		}
		return $this->fecha_bd;
	}// end function
	//==========================================================================================================================
	function enviar_correo($remitente="",$destinatario="",$asunto="",$mensaje=""){
		/*$tabla = new cls_table(1,1);
		$tabla->border=1;		
		$tabla->cellspacing = "1";
		$tabla->cellpadding = "1";
		$tabla->align = "center";
		$tabla->width = "100%";
		$tabla->height="24";
		$tabla->cell[0][0]->valign = "top"; 
		$tabla->cell[0][0]->text = $mensaje;*/		
		//$cabeceras =  'MIME-Version: 1.0'."\r\n";
		//$cabeceras .= 'Content-type: multipart/alternative; charset=iso-8859-1 ;format=flowed'."\r\n";		
		//$cabeceras .= 'Content-Transfer-Encoding: 8bit'."\r\n";
		//$cabeceras .= 'To: '.$destinatario.' <'.$destinatario.'>' . "\r\n";
		//$cabeceras .= 'From: '.$remitente.' <'.$remitente.'>' . "\r\n";
		//$cabeceras .= 'To: '.$destinatario."\r\n";
		$from = "From: ".$remitente."\r\n";
		//$cabeceras .= "From: \"x".$remitente."\"\n";
		//$cabeceras .= 'Cc: ventas@geniusys.com' . "\r\n";
		//$cabeceras .= 'Bcc: chequeo@example.com' . "\r\n";
		
		if($this->html==true){
			$html  = 'MIME-Version: 1.0' . "\r\n";
			$html .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		}#end if
		if($this->cc!=""){
			$bcc = "cc: $this->cc" . "\r\n";
			$this->cc ="";
		}#end if
		if($this->bcc!=""){
			$bcc = "bcc: $this->bcc" . "\r\n";
			$this->bcc ="";
		}#end if
		$cabeceras = $html.$from.$cc.$bcc;

		return mail($destinatario,$asunto,$mensaje,$cabeceras);
	}// end function
	//==========================================================================================================================
	var $usuario_correo = "";
	var $clave_correo = "";
	var $error_correo = "";
	var $nombre_correo = "";

	function enviar_correo2($remitente="",$destinatario="",$asunto="",$msj="",$msj_html="",$arr_archivos=""){
		$correo = new cls_correos();
		$correo->set_from($remitente,$this->nombre_correo);
		$correo->set_to($destinatario);
		$correo->set_subject($asunto);
		if($msj != ""){
			$correo->set_text($msj);
		}
		if($msj_html != ""){
			$correo->set_html($msj_html);
		}
		$correo->charset = "UTF-8";
		if($arr_archivos!=""){
			
			$so = $this->obtener_so();
			if($so==2){
				//UNIX
				$sep = "/";
			}else if($so()==1){
				//WIN
				$sep = "\\";
			}
			if(is_array($arr_archivos)){			
				for($i=0;$i<count($arr_archivos);$i++){
					$nombre = explode($sep,$arr_archivos[$i]);
					$correo->add_attachment($arr_archivos[$i],$nombre[count($nombre)-1]);
				}
			}else{
				$nombre = explode($sep,$arr_archivos);
				$correo->add_attachment($arr_archivos,$nombre[count($nombre)-1]);
			}
		}#end if

		$correo->set_smtp_host("correo.opsu.gob.ve");

		if($this->cc!=""){
			$correo->set_cc($this->cc);
			$this->cc = "";
		}#end if

		if($this->bcc!=""){
			$correo->set_bcc($this->bcc);
			$this->bcc = "";
		}#end if

		if($this->usuario_correo!="" and $this->clave_correo!=""){
			$correo->set_smtp_log(true);
			$correo->set_smtp_auth($this->usuario_correo, $this->clave_correo);
		}

		if ($correo->send()){
		   	return 1;
		}else{
				$this->error_correo = $correo->error;
		   	return 0;
		}
	}// end function
	//==========================================================================================================================
	//Crear Script Para Combos Dinamicos	
	function crear_script($nombre_x="",$array_x="",$nombre_padre="lista_padre",$valor_x="",$inicio="1"){
		$nombre_lista = "mi_lista";
		if($nombre_x!=""){
			$nombre_lista = $nombre_x;
		}//end if
		$nombre_padre = $nombre_padre;
		$script_combo = "\n<script language=\"JavaScript1.2\" type=\"text/javascript\">\n";
		$script_combo .= "\t".$nombre_lista."_xyz = new Array()\n";
		$script_combo .= "\tvalorg_aux[\"$nombre_lista\"]=\"".$valor_x."\"\n"; //valor por defecto
		$c = $inicio;
		if(is_array($array_x)){
			foreach($array_x as $v1 => $v2){
			 	foreach ($v2 as $v3 => $v4) {
			 		//$v3_x = ($v3!="")?($v3):("0");
			 		//$v4_x = ($v4!="")?($v4):("Ninguno");
			 		//echo "<br>$v1 : ".$v4_x." : ".$v3_x;
					$xyz_aux .= "\t".$nombre_lista."_xyz[".($c)."] = \"".$v1.":".$v4.":".$v3."\"\n";
					$c++;		
				}//end foreach
			}//end foreach
		}
		//$xyz_aux2 = "\t".$nombre_lista."_xyz[".$c."] = \""."0:Seleccione...:0\""."\n";
		//$xyz_aux = $xyz_aux.$xyz_aux2;
		$script_combo.= $xyz_aux."\trel_aux[\"$nombre_lista\"] = \"".$nombre_padre.":3\"\n</script>\n";
		return $script_combo;
	}//end funtion
	//==========================================================================================================================
	//Crear Script Para Combos Dinamicos optimizado	
	function crear_script2($nombre_x="",$array_x="",$nombre_padre="lista_padre",$valor_x="",$inicio="1",$etiquetas=true){
		$nombre_lista = "mi_lista";
		if($nombre_x!=""){
			$nombre_lista = $nombre_x;
		}//end if

		if($etiquetas){
			#Etiquetas de script
			$script_combo = "\n<script language=\"JavaScript1.2\" type=\"text/javascript\">\n";
			$script_combo2 = "\n</script>\n";
		}#end if

		#Valor por defecto de la lista
		$script_combo .= "\tvalorg_aux[\"$nombre_lista\"]=\"".$valor_x."\"\n";
		#Iniciar lista 0 o 1 con o sin opcion de "Seleccione..."
		$c = $inicio;
		#Contador para separador (,)
		$u = 0;
		$adicional = "";
		if($inicio==1){
			$adicional = "'',";		
		}
		foreach($array_x as $v1 => $v2){
		 	foreach ($v2 as $v3 => $v4){
				$sep = ($u==0)?(""):(",");
				//$xyz_aux .= "\t".$nombre_lista."_xyz[".($c)."] = \"".$v1.":".$v4.":".$v3."\"\n";
				$arr .= $sep."'".$v1.":".$this->caracter_especial($v4,"\"").":".$v3."'";
				//$c++;
				$u++;
			}#end foreach
		}#end foreach
		$xyz_aux2 = "\tvar ".$nombre_lista."_xyz = new Array(".$adicional.$arr.");";
		$script_combo.= $xyz_aux2."\n\trel_aux[\"$nombre_lista\"] = \"".$nombre_padre.":3\";".$script_combo2;
		return $script_combo;
	}#end funtion
	#==========================================================================================================================
	#Obtener la Ruta a partir de la ubicacion en el servidor
	function obtener_ruta($url_x=""){
		//echo "<br>Ruta: ".$url_x." ".$_SERVER["REQUEST_URI"];		
		$url = explode("/",$url_x);
		$cad =  "../";
		$cad_x = "";
		if(count($url)>1){
			for($i=1;$i<count($url)-1;$i++){
				$cad_x .= $cad; 
			}//next
		}else{
			$cad_x = "";		
		}//end if
		return $cad_x;
	}//end fucntion
	#==========================================================================================================================
	#Obtener la Ruta a partir de la ubicacion en el servidor
	function obtener_modulo_descarga($id_mod=""){
		if($id_mod!=""){
			$cn = new cls_conexion();
			$cn->query = "select ubicacion_descarga from administracion.cfg_ubicacion_descargas where id_ubicacion_descarga = '$id_mod'";
			$cn->ejecutar();
			$rs = $cn->consultar();
			return $rs[0];
		}#end if
	}//end fucntion
	#============================================================================================================================
	function malla($ar_contenidos="",$cols="0"){
		#========================================================
		if($ar_contenidos!=""){
			$this->ar_contenidos = $ar_contenidos;
		}#end if
		#========================================================
		if($cols!="0"){
			$this->columnas = $cols;
		}#end if
		#========================================================
		$this->num_registros = count($this->ar_contenidos);
		$this->filas = ceil($this->num_registros/$this->columnas=($this->columnas!=0)?($this->columnas):(1));
		#========================================================
		$cfg_tabla = new cls_table($this->filas,$this->columnas);
		$cfg_tabla->border = "0";
		$cfg_tabla->cellspacing = "0";
		$cfg_tabla->cellpadding = $this->cellpadding_malla;
		$cfg_tabla->align = $this->align;
		$cfg_tabla->width = $this->width;
		$cfg_tabla->bgcolor = $this->bgcolor_malla;
		$cfg_tabla->class = $this->class_malla;
		#Titulo de la Tabla
		if($this->titulo_malla != ""){
			$cfg_tabla->caption->text = $this->titulo_malla;
			$cfg_tabla->caption->class = C_ESTILO_TABLA_CAPTION;
		}#end if
		#========================================================
		for($i=1;$i<=$this->num_registros;$i++){
			$col = (($i-1) % $this->columnas);
			$fil = ceil($i/$this->columnas);
			$cfg_tabla->cell[$fil-1][$col]->text = $this->ar_contenidos[($i-1)];
			$cfg_tabla->cell[$fil-1][$col]->width = floor(100/$this->columnas=($this->columnas!=0)?($this->columnas):(1))."%";
			$cfg_tabla->cell[$fil-1][$col]->valign = $this->valign_malla;
			$cfg_tabla->cell[$fil-1][$col]->align = $this->align_malla;
			$cfg_tabla->cell[$fil-1][$col]->class = $this->class_malla;
		}//next
		return $cfg_tabla->control();
	}#end function
	#============================================================================================================================
	#Obtener grupos en los cuales pertenece un usuario
	function	verificar_grupo($sesion="",$grupo=""){
		if($_SESSION["sesion"]!=""){
			$sesion = $_SESSION["sesion"];
		}#end if
		$sv = new cls_servidores(20);
		$cn = new cls_conexion();
		$cn->query = "Select cfg_usuarios.inicio_sesion, cfg_grupos.id_grupo, cfg_grupos.descripcion From administracion.cfg_usuarios Inner Join administracion.cfg_usuario_grupo ON cfg_usuarios.id_usuario = cfg_usuario_grupo.id_usuario Inner Join administracion.cfg_grupos ON cfg_grupos.id_grupo = cfg_usuario_grupo.id_grupo Where cfg_usuario_grupo.id_grupo = '".$grupo."' and inicio_sesion = '".$sesion."'";
		$cn->ejecutar();
		/*select u.id_usuario, u.inicio_sesion, ug.id_grupo from cfg_usuarios as u 
		inner join cfg_usuario_grupo as ug on u.id_usuario = ug.id_usuario
		where inicio_sesion='rserrano' 
		group by ug.id_grupo having ug.id_grupo = '6'*/
		return $cn->reg_total;
	}#end function
	#==========================================================================================================================
	function obtener_ip(){
		if($_SERVER['HTTP_X_FORWARDED_FOR'] != ""){
			$this->ip_publica = $_SERVER['HTTP_X_FORWARDED_FOR'];
			$this->ip_proxy = $_SERVER['REMOTE_ADDR'];
			$cliente_ip = (!empty($_SERVER['REMOTE_ADDR']))?($_SERVER['REMOTE_ADDR']):((!empty($_ENV['REMOTE_ADDR']))?($_ENV['REMOTE_ADDR']):"Desconocida");
			$entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
			reset($entries);
			while (list(, $entry) = each($entries)){
				$entry = trim($entry);
				if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list)){
					$private_ip = array('/^0\./','/^127\.0\.0\.1/','/^192\.168\..*/','/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/','/^10\..*/');
					$found_ip = preg_replace($private_ip, $cliente_ip, $ip_list[1]);
					if ($cliente_ip != $found_ip){
						$cliente_ip = $found_ip;
						break;
					}//end if
				}//end if
			}//end while
		}else{
			$this->ip_publica = $cliente_ip = (!empty($_SERVER['REMOTE_ADDR']))?($_SERVER['REMOTE_ADDR']):((!empty($_ENV['REMOTE_ADDR']))?($_ENV['REMOTE_ADDR']):"Desconocida");
		}//end if
		$this->ip_cliente =  $cliente_ip;
		return $cliente_ip;
	}//end Function
	#==========================================================================================================================
	function consultarGrupo($id_grupo, $usuario,$id_sistema){
		$sv = new cls_servidores($id_sistema);
		$cn = new cls_conexion();
		$cn->query = "SELECT cfg_grupos.id_grupo, cfg_usuarios.inicio_sesion from administracion.cfg_usuario_grupo inner Join administracion.cfg_grupos ON cfg_usuario_grupo.id_grupo = cfg_grupos.id_grupo inner join administracion.cfg_usuarios ON cfg_usuario_grupo.id_usuario = cfg_usuarios.id_usuario where cfg_grupos.id_grupo = '".$id_grupo."' and cfg_usuarios.inicio_sesion = '".$usuario."'";
		$cn->ejecutar();
		if($cn->reg_total>0){
			return true;	
		}else{
			return false;		
		}
		$cn->close();
	}//end function
}//end class
?>