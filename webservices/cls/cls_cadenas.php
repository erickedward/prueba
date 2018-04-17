<?php
  
/* +--------------------------------------------------------------------------------------------------+
	 Class: cls_cadenas	
	 Contiene varios métodos para el manejo de cadenas, como por ejemplo	 
	 codificar acentos UTF-8,encriptar o convertir una cadena en un MD5,	
  	 extraer una cantidad especifica de caracteres a una cadena,entre otros
  	+--------------------------------------------------------------------------------------------------+
|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
/* +--------------------------------------------------------------------------------------------------+
	property: cadena_md5
	Retorna la cadena original del md5 Generado
	+--------------------------------------------------------------------------------------------------+ 
|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
/* +--------------------------------------------------------------------------------------------------+
	Function: codificar_acentos_utf8
	*Utilidad:* Reemplaza a la letra ñ, las vocales acentuadas en mayúscula y minúscula
	e ¿ el valor que le corresponde en la códificación UTF-8   
	
	*Parametros:* La cadena a la que se le modificará los carecteres 
	
	*Valor(es) retonardo(s):* El valor que le corresponde al caracter modificado bajo la codificación 
	UTF-8	
	+--------------------------------------------------------------------------------------------------+*/
/* +--------------------------------------------------------------------------------------------------+	
	Function: fecha_bd
	*Utilidad:* Da el formato a una fecha normal modificandola para que pueda ser almacenada en una 
	base de datos   
	
	*Parametros:* fecha a convertir 
	
	*Valor(es) retonardo(s):* La fecha con formato utilizado por  base de datos AAAA-MM-DD
	+--------------------------------------------------------------------------------------------------+*/
/* +--------------------------------------------------------------------------------------------------+	
	Function: bd_fecha
	*Utilidad:* Da el formato normal a una fecha que posea la estructura a las que son utilizadas por las
	bases de datos
	
	*Parametros:* fecha a convertir 
	
	*Valor(es) retonardo(s):* La fecha con formato DD/MM/AAAA
+--------------------------------------------------------------------------------------------------+*/
/* +--------------------------------------------------------------------------------------------------+	
	Function: encriptar
	*Utilidad:* Convierte una cadena en MD5 y utiliza el método reducir para que la encriptación sea
	más compleja
	
	*Parametros:* valor o cadena a convertir y el modo que será utilizado por el método reducir
	
	*Valor(es) retonardo(s):* La cadena encriptada 
+--------------------------------------------------------------------------------------------------+*/	 
/* +--------------------------------------------------------------------------------------------------+	
	Function: reducir
	*Utilidad:* Según el segundo parametro que reciba devuleve una subcadena, con la cantidad o posición
	de careacteres predefinos   
	
	*Parametros:* 
	
	- La cadena a la que se le extraerá los caracteres
	- El modo o tipo de extracción que se le realizará a la cadena, siendo los valores admitidos 1, 2 y 3
	
	*Valor(es) retonardo(s):* Según el modo o el valor recibido en el segujndo argumento, retornará una 
	subcadena formada de la siguiente manera	
	
	- 1 = últimos 30 Caracteres
	- 2 = primeros 30 Caracteres
	- 3 = sin el primer ni último Caracter
+--------------------------------------------------------------------------------------------------+*/	 
/* +--------------------------------------------------------------------------------------------------+	
	Function: nl2br2
	*Utilidad:* Eliminar enters de cadenas por cualquier caracter que se le indique, realizando un
	str_replace de los  "\r\n", "\r" o \n
	
	*Parametros:* 
	
	- La cadena a la que se le eliminará los enters
	-  El caracter por el cual será modificado el enter
	
	*Valor(es) retonardo(s):* La cadena sin los enters
+--------------------------------------------------------------------------------------------------+*/
/* +--------------------------------------------------------------------------------------------------+	
	Function: cadena_mayuscula
	*Utilidad:* Devuelve las vocales o ñ que se encuentren en minúscula a mayúscula 
	
	*Parametros:* La cadena en donde se modificará las vocales que se encuentran acentuadas y en minúscula 
		
	*Valor(es) retonardo(s):* La cadena con los caracteres en mayúscula
+--------------------------------------------------------------------------------------------------+*/	 
/* +--------------------------------------------------------------------------------------------------+	
	Function: bd_fecha_hora
	
	*Utilidad:* Modifica a una cadena con formato tipo datetime de base de datos modificandolo en 
	formato de fecha dd/mm/aaaa / h:m  
	
	*Parametros:* La fecha que se transformará 
		
	*Valor(es) retonardo(s):* La fecha y hora con su nuevo formato
+--------------------------------------------------------------------------------------------------+*/	 
/* +--------------------------------------------------------------------------------------------------+	
	Function: cadena_minuscula
	*Utilidad:* Devuelve las vocales o ñ que se encuentren en mayúscula a minúscula  
	
	*Parametros:* La cadena en donde se modificará las vocales que se encuentran acentuadas y en mayúscula 
		
	*Valor(es) retonardo(s):* La cadena con los caracteres en minúscula
+--------------------------------------------------------------------------------------------------+*/	 
/* +--------------------------------------------------------------------------------------------------+	
	Function: numeros_letras
	
	*Utilidad:* Devuelve el número en letras con solo indicarle el número   
	
	*Parametros:* El número que se quiere obtener en letras
		
	*Valor(es) retonardo(s):* El valor del número en letras, los valores retornados son del 0 al 20
+--------------------------------------------------------------------------------------------------+	 
|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/

//
// +-----------------------------------------------------------------------+
//	|	Nombre(s) de Clase(s): cls_cadenas					      	            |
// +-----------------------------------------------------------------------+
//	|	Clase(s): Extendida(s):	No	                                          |
// +-----------------------------------------------------------------------+
//	|	Prelación de Clase(s): no															|
//	+-----------------------------------------------------------------------+
//	|	Fecha de Creación:	25/04/2007													|
//	+-----------------------------------------------------------------------+
//	|	Descripción:	Funciones Variadas para el manejo de cadenas				|
//	|																								|
//	|																								|
//	+-----------------------------------------------------------------------+
//	|	Autor(es):	Richard Serrano														|
//	+-----------------------------------------------------------------------+
//	|	Version:	1.0																			|
//	+-----------------------------------------------------------------------+
//	|	Fecha última modificación:	19/05/2008											|
//	+-----------------------------------------------------------------------+
//	|	Métodos de Clase:	cls_cadenas														|
//	|																								|
//	|	codificar_acentos_utf8()															|
//	|	Descripción:																			|
//	|																								|
//	|	()																							|
//	|	Descripción:																			|
//	|																								|
//	|	()																							|
//	|	Descripción:																			|
//	|																								|
//	|	()																							|
//	|	Descripción:																			|
//	|																								|
//	|	()																							|
//	|	Descripción:																			|
//	+-----------------------------------------------------------------------+
//
//require_once("cls_cadenas.php");


class cls_cadenas{
	var $cadena_md5="";
#========================================================================================================================	
	
	function codificar_acentos_utf8($cadena_x=""){
		if($cadena_x!=""){
			$n_texto=ereg_replace("'á'",'&#224;',$cadena_x);
			$n_texto=ereg_replace("'é'","&#233;",$n_texto);
			$n_texto=ereg_replace("'í'","&#237;",$n_texto);
			$n_texto=ereg_replace("'ó'","&#243;",$n_texto);
			$n_texto=ereg_replace("'ú'","&#250;",$n_texto);
			$n_texto=ereg_replace("'Á'","&#193;",$n_texto);
			$n_texto=ereg_replace("'É'","&#201;",$n_texto);
			$n_texto=ereg_replace("'Í'","&#205;",$n_texto);
			$n_texto=ereg_replace("'Ó'","&#211;",$n_texto);
			$n_texto=ereg_replace("'Ú'","&#218;",$n_texto);
			$n_texto=ereg_replace("'ñ'", "&#241;", $n_texto);
			$n_texto=ereg_replace("'Ñ'", "&#209;", $n_texto);
			$n_texto=ereg_replace("'¿'", "&#191;", $n_texto);
			return $n_texto;
		}//end if
	}//end function
#========================================================================================================================
	
	function fecha_bd($fecha_x=""){		
		$fecha_x = substr($fecha_x,0,10);
		$f = explode("/",$fecha_x);
		if(count($f)>1 and $f[2] != "0000"){
			return $f[2]."-".$f[1]."-".$f[0];
		}else{
			return "";
		}//end if
	}//end function
#========================================================================================================================

	function bd_fecha($fecha_x=""){
		$f = explode("-",$fecha_x);
		if(count($f)>1 and $f[2] != "0000"){
			$fecha_bd = $f[2]."/".$f[1]."/".$f[0];
			return $fecha_bd;
		}else{
			return "";
		}//end if
	}// end function
#========================================================================================================================
		
	function encriptar($valor_x,$modo_x="3"){
		$this->cadena_md5 = $password = strtoupper(md5($valor_x));
		$password = $this->reducir($password,$modo_x);
		return $password;
	}//end function#========================================================================================================================
	function reducir($valor_x,$modo_x="3"){
		switch($modo_x){
			case ""://Ultimos 30 Caracteres
			case 1: 
				return strtoupper(substr($valor_x,2,32));
			break;
			case 2:	//Primeros 30 Caracteres
				return strtoupper(substr($valor_x,0,30));
			break;
			case 3:	//Sin el Primer ni Ultimo Caracter
				return strtoupper(substr($valor_x,1,30));
			break;
		}//end switch
	}//end function
#========================================================================================================================
	function nl2br2($cadena,$caracter) { 
			$string = str_replace(array("\r\n", "\r", "\n"), $caracter, $cadena);
		return $string;
	}//end function
#========================================================================================================================
	function cadena_mayuscula($cadena){
		$cadena = strtoupper($cadena);
		$cadena = str_replace("á", "Á", $cadena);
		$cadena = str_replace("é", "É", $cadena);
		$cadena = str_replace("í", "Í", $cadena);
		$cadena = str_replace("ó", "Ó", $cadena);
		$cadena = str_replace("ú", "Ú", $cadena);
		$cadena = str_replace("ñ", "Ñ", $cadena);
		return ($cadena);
	}#end function
#========================================================================================================================
	
	function cadena_minuscula($cadena){
		$cadena = strtolower($cadena);
		$cadena = str_replace("Á", "á", $cadena);
		$cadena = str_replace("É", "é", $cadena);
		$cadena = str_replace("Í", "í", $cadena);
		$cadena = str_replace("Ó", "ó", $cadena);
		$cadena = str_replace("Ú", "ú", $cadena);
		$cadena = str_replace("Ñ", "n", $cadena);
		return ($cadena);
	}#end function
#========================================================================================================================
		
	function bd_fecha_hora($fecha_x=""){
		list($fecha_x, $hora_x) = explode(" ",$fecha_x);
		$f = explode("-",$fecha_x);
		if(count($f)>1 and $f[2] != "0000"){
			$fecha_bd = $f[2]."/".$f[1]."/".$f[0];
			return $fecha_bd." / ".$hora_x;
		}else{
			return "";
		}//end if
	}#end function
#========================================================================================================================
		
	function numeros_letras($num=""){
		if($num != ""){
			$numeros = array("cero","uno","dos","tres","cuatro","cinco","seis","siete","ocho","nueve","diez","once","doce","trece","catorce","quince","dieciseis","diecisiete","dieciocho","diecinueve","veinte");
			return $numeros[$num];
		}#end if
	}#end function
	
	function rellena_cadena($cadena,$cant="0",$caracter="0",$dir="0"){
		$n = $cant - strlen($cadena);
		#Completar cadena a la izquierda		
		if($dir==1){		
			for($i=0;$i<$n;$i++){
				$cad .= $caracter;
			}#end for
		}#end if
		
		#Cadena Original
		for($i=0;$i<strlen($cadena);$i++){
			$cad .= $cadena[$i];
		}#end if

		#Completar cadena a la derecha
		if($dir==0){		
			for($i=0;$i<$n;$i++){
				$cad .= $caracter;
			}#end for
		}#end if
		return $cad;
	}#end function
	
	function num2letras($num, $fem = true, $dec = true) { 
	//if (strlen($num) > 14) die("El n?mero introducido es demasiado grande"); 
	   $matuni[2]  = "dos"; 
	   $matuni[3]  = "tres"; 
	   $matuni[4]  = "cuatro"; 
	   $matuni[5]  = "cinco"; 
	   $matuni[6]  = "seis"; 
	   $matuni[7]  = "siete"; 
	   $matuni[8]  = "ocho"; 
	   $matuni[9]  = "nueve"; 
	   $matuni[10] = "diez"; 
	   $matuni[11] = "once"; 
	   $matuni[12] = "doce"; 
	   $matuni[13] = "trece"; 
	   $matuni[14] = "catorce"; 
	   $matuni[15] = "quince"; 
	   $matuni[16] = "dieciseis"; 
	   $matuni[17] = "diecisiete"; 
	   $matuni[18] = "dieciocho"; 
	   $matuni[19] = "diecinueve"; 
	   $matuni[20] = "veinte"; 
	   $matunisub[2] = "dos"; 
	   $matunisub[3] = "tres"; 
	   $matunisub[4] = "cuatro"; 
	   $matunisub[5] = "quin"; 
	   $matunisub[6] = "seis"; 
	   $matunisub[7] = "sete"; 
	   $matunisub[8] = "ocho"; 
	   $matunisub[9] = "nove"; 
	
	   $matdec[2] = "veinti"; 
	   $matdec[3] = "treinta"; 
	   $matdec[4] = "cuarenta"; 
	   $matdec[5] = "cincuenta"; 
	   $matdec[6] = "sesenta"; 
	   $matdec[7] = "setenta"; 
	   $matdec[8] = "ochenta"; 
	   $matdec[9] = "noventa"; 
	   $matsub[3]  = 'mill'; 
	   $matsub[5]  = 'bill'; 
	   $matsub[7]  = 'mill'; 
	   $matsub[9]  = 'trill'; 
	   $matsub[11] = 'mill'; 
	   $matsub[13] = 'bill'; 
	   $matsub[15] = 'mill'; 
	   $matmil[4]  = 'millones'; 
	   $matmil[6]  = 'billones'; 
	   $matmil[7]  = 'de billones'; 
	   $matmil[8]  = 'millones de billones'; 
	   $matmil[10] = 'trillones'; 
	   $matmil[11] = 'de trillones'; 
	   $matmil[12] = 'millones de trillones'; 
	   $matmil[13] = 'de trillones'; 
	   $matmil[14] = 'billones de trillones'; 
	   $matmil[15] = 'de billones de trillones'; 
	   $matmil[16] = 'millones de billones de trillones'; 
	
	   $num = trim((string)@$num); 
	  /* echo $num;
	   echo "<hr>";*/
	   if ($num[0] == '-') { 
	      $neg = 'menos '; 
	      $num = substr($num, 1); 
	   }else 
	      $neg = '';	   
	   while ($num[0] == '0') $num = substr($num, 1); 
	   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
	   $zeros = true; 
	   $punt = false; 
	   $ent = ''; 
	   $fra = ''; 
	   for ($c = 0; $c < strlen($num); $c++) { 
	      $n = $num[$c]; 
	      if (! (strpos(".,'''", $n) === false)) { 
	         if ($punt) break; 
	         else{ 
	            $punt = true; 
	            continue; 
	         } 
	
	      }elseif (! (strpos('0123456789', $n) === false)) { 
	         if ($punt) { 
	            if ($n != '0') $zeros = false; 
	           	$fra .= $n; 
	         }else 	
	            $ent .= $n; 
	      }else 
	
	         break; 
	
	   } 
	   $ent = '     ' . $ent;	   
	   if ($dec and $fra and ! $zeros) {
	   	 
	      //$fin = ' coma->'.strlen($fra)."<-";
	      $fin = ' coma';
	      for ($n = 0; $n < strlen($fra); $n++) {
	      	$s = $fra[$n];	      	
	         if ($s == '0' && $n=='0'){	         	 
	           $fin .= ' cero'; 	            
	         }elseif (strlen($fra)==1 && $s == '1'){ 
	            $fin .= $fem ? ' una' : ' un'; 
	         }else{
	         	#decimales orizel en revisión
	         	if($fra[0] == '0' && strlen($fra)==2){
	         		$fin .= ' '.$matuni[$s];
	         	}
	         	if(strlen($fra)==2 && $n==0 && $fra>19){	     	
	         		$y = ($s==2) ?  "y " : 	( $fra[$n+1] == '0' ) ? "" : " y ";	         			         		
	            	$fin .= ' ' . $matdec[$s].$y;
	         	}elseif(strlen($fra)==2 && $n==1 && $fra>19){	         		
	         		$fin .= ' ' . $matuni[$s];
	         	}elseif(strlen($fra)==2 && $n==0){	         		
	         		$fin .= ' ' . $matuni[$fra];
	         	}#end if 
	         	
	         } 
	      }
	 /*if ($dec and $fra and ! $zeros) {
	   	$fin = ' coma';
	   	for ($n = 0; $n < strlen($fra); $n++) {
	   		if (($s = $fra[$n]) == '0'){
	   			$fin .= ' cero';
	   		}elseif ($s == '1'){
	   		$fin .= $fem ? ' una' : ' un';
	   		}else{
	   			if($n==(strlen($fra)-1)){
	   				$fin .= ' y '. $matuni[$s];
	   			}else{
	   				$fin .= ' '. $matuni[$s];
	   			}
	   			
	   		}
	   	} */
	   }else 
	      $fin = ''; 
	   if ((int)$ent === 0) return 'Cero ' . $fin; 
	   $tex = ''; 
	   $sub = 0; 
	   $mils = 0; 
	   $neutro = false;
	   #obtener centenas	   
	   while ( ($num = substr($ent, -3)) != '   ') { 
	      $ent = substr($ent, 0, -3);
	       
	      if (++$sub < 3 and $fem) { 
	         $matuni[1] = 'una'; 
	         $subcent = 'os'; 
	      }else{
	      	#en revision orizel 	      
	         //$matuni[1] = $neutro ? 'un' : 'uno';
	         $matuni[1] = 'un'; 
	         $subcent = 'os'; 
	      } 
	      $t = ''; 
	      #decenas
	      $n2 = substr($num, 1); 
	      if ($n2 == '00') {	      	
	      }elseif ($n2 < 21){ 
	         $t = ' ' . $matuni[(int)$n2]; 
	      }elseif ($n2 < 30) {
	      	
	         $n3 = $num[2]; 
	         //if ($n3 != 0) $t = 'i' . $matuni[$n3];
	         if ($n3 != 0) $t = '' . $matuni[$n3];
	         $n2 = $num[1]; 
	         $t = ' ' . $matdec[$n2] . $t; 
	      }else{ 
	         $n3 = $num[2]; 
	         if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
	         $n2 = $num[1]; 
	         $t = ' ' . $matdec[$n2] . $t; 
	      } 
	      $n = $num[0]; 
	      if ($n == 1) { 
	      	if($n2=='00'){
	      		$t = ' cien' . $t;
	      	}else{
	         $t = ' ciento' . $t;
	      	}//end if  
	      }elseif ($n == 5){ 
	         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
	      }elseif ($n != 0){ 
	         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 
	      } 
	      if ($sub == 1) { 
	      }elseif (! isset($matsub[$sub])) { 
	         if ($num == 1) { 
	            $t = ' mil'; 
	         }elseif ($num > 1){ 
	            $t .= ' mil'; 
	         } 
	      }elseif ($num == 1) { 
	         $t .= ' ' . $matsub[$sub] . '?n'; 
	      }elseif ($num > 1){ 
	         $t .= ' ' . $matsub[$sub] . 'ones'; 
	      }   
	      if ($num == '000') $mils ++; 
	      elseif ($mils != 0) { 
	         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
	         $mils = 0; 
	      } 
	      $neutro = true; 
	      $tex = $t . $tex; 
	   } 
	  //echo 
	  $tex = $neg . substr($tex, 1) . $fin;
	    //echo "<hr>";
	   return ucfirst($tex); 
	}
}//end class
?>