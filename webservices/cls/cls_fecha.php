<?php

/*Class: cls_fecha
  Realiza una serie de operaciones relacionadas a las fechas tales como: obtener la feha actual,
  cambiar el formato de una fecha que viene de Base de Datos, verificar si una fecha es válida, entre otros.
*/

class cls_fecha{

	var $dia;
	var $mes;
	var $m;
	var $anu;

	 /*Function: obtener_fecha
	 	*Utilidad:* evitar la construcción de formatos preestablecidos en esta función de la fecha
	 	actual

      *Parametros:* El parametro recibido es un entero entre el 1 y el 7.

      *Valor(es) retonardo(s):* Retorna la fecha actual es distintos formatos según el parametro recibido.
      los tipo de formatos según el parametro son:
      - 1 = 07 de Noviembre de 2008
      - 2 = 07/Noviembre/08
      - 3 = 07/Noviembre/2008
      - 4 = 07-Noviembre-08
		- 5 = 07-Noviembre-2008
		- 6 = Viernes, 07 de Noviembre de 2008
		- 7 = 07/11/2008*/
	function obtener_fecha($f){
		$this->dia=date("d");
		$this->mes=date("m");
		$this->anu=date("Y");
		$this->mes_n = $this->obtener_mes(date("m"));
		$this->anu_n=date("y");
		$this->hora = date("h:i:s");
		$cad = new cls_cadenas();
		
		switch($f){
			case"1":return $this->dia." de ".$this->obtener_mes($this->mes)." de ".$this->anu;break;
			case"2":return $this->dia."/".$this->mes_n."/".$this->anu_n;break;
			case"3":return $this->dia."/".$this->mes_n."/".$this->anu;break;
			case"4":return $this->dia."-".$this->mes_n."-".$this->anu_n;break;
			case"5":return $this->dia."-".$this->mes_n."-".$this->anu;break;
			case"6":$dia = date("D"); return $this->obtener_dia($dia).", ".$this->dia." de ".$this->obtener_mes($this->mes)." de ".$this->anu;break;
			case"7":return $this->dia."/".$this->mes."/".$this->anu;break;
			case"8":return $this->anu."-".$this->mes."-".$this->dia." ".$this->hora;break;
			case"9":$this->dia = $cad->num2letras(date("d"));$this->anu = $cad->num2letras(date("Y"));  return $this->dia." días del mes de ".$this->obtener_mes($this->mes)." de ".$this->anu;break;
		}//end switch
	}//end Function

	 /*Function: sql_fecha
	 	*Utilidad:* Convertir el formato de fecha recibido desde una base de datos en formato normal

		*Parametros:* El parametro recibido es la fecha con el formato de BD A-M-D

		*Valor(es) retonardo(s):* La fecha con el formato en D-M-A*/
	function sql_fecha($fecha_x){
		$f = explode("-",$fecha_x);
		if(count($f)>1)
			return $f[2]."/".$f[1]."/".$f[0];
		else
			return "";
	}// end function

	/*Function: formato_fecha

		*Utilidad:* Tener tres (3) opciones para formatos dar a una fecha

		*Parametros:* Los parametros recibidos son la fecha a la que se le hará la modificación, el número del formato
		(1, 2 ó 3) y el separador de la fecha a modificar

		*Valor(es) retonardo(s):* Retorna la fecha solicitada según el parametro recibido.
      los tipo de formatos según el parametro son:
      - 1 = 07/11/2008
      - 2 = 07-11-2008
      - 3 = 07 de Noviembre de 2008*/
	function formato_fecha($fecha,$formato="",$sep="/"){
		$fech = explode ($sep,$fecha);
		$dia = $fech[0];
		$mes = $fech[1];
		$ano = $fech[2];

		switch($formato){
			//case "":return $fecha;break;
			case "1":return $dia."/".$mes."/".$ano;break;
			case "2":return $dia."-".$mes."-".$ano;break;
			case "3":
				switch($mes){
					case"01":$mes="Enero";break;
					case"02":$mes="Febrero";break;
					case"03":$mes="Marzo";break;
					case"04":$mes="Abril";break;
					case"05":$mes="Mayo";break;
					case"06":$mes="Junio";break;
					case"07":$mes="Julio";break;
					case"08":$mes="Agosto";break;
					case"09":$mes="Septiembre";break;
					case"10":$mes="Octubre";break;
					case"11":$mes="Noviembre";break;
					case"12":$mes="Diciembre";break;
					//return $mes;
				}//end switch
				return $dia." de ".$mes." de ".$ano;
			break;
			case "4":
				switch($mes){
					case"01":$mes="JAN";break;
					case"02":$mes="FEB";break;
					case"03":$mes="MAR";break;
					case"04":$mes="APR";break;
					case"05":$mes="MAY";break;
					case"06":$mes="JUN";break;
					case"07":$mes="JUL";break;
					case"08":$mes="AUG";break;
					case"09":$mes="SEP";break;
					case"10":$mes="OCT";break;
					case"11":$mes="NOV";break;
					case"12":$mes="DEC";break;
				}//end switch
				return $dia."-".$mes."-".$ano;
			break;
			case "5":
				switch($mes){
					case"JAN":$mes="01";break;
					case"FEB":$mes="02";break;
					case"MAR":$mes="03";break;
					case"APR":$mes="04";break;
					case"MAY":$mes="05";break;
					case"JUN":$mes="06";break;
					case"JUL":$mes="07";break;
					case"AUG":$mes="08";break;
					case"SEP":$mes="09";break;
					case"OCT":$mes="10";break;
					case"NOV":$mes="11";break;
					case"DEC":$mes="12";break;
				}//end switch
				return $dia."-".$mes."-".$ano;
			break;
		}//end switch
	}//end function

	/*Function: obtener_mes

	*Utilidad:* Si se tiene el valor o número de un mes (el cual requiere la función), se obtendrá el nombre del mes

	*Parametros:* El número de mes ejemplo: 01

	*Valor(es) retonardo(s):*  El nombre del mes

      - 01 = Enero
      - 02 = Febrero
      - 03 = Marzo
      - 04 = Abril
      - 05 = Mayo
      - 06 = Junio
      - 07 = Julio
      - 08 = Agosto
      - 09 = Septiembre
      - 10 = Octubre
      - 11 = Noviembre
		- 12 = Diciembre*/
	function obtener_mes($mes=""){
		switch($mes){
			case"01":return "Enero";break;
			case"02":return "Febrero";break;
			case"03":return "Marzo";break;
			case"04":return "Abril";break;
			case"05":return "Mayo";break;
			case"06":return "Junio";break;
			case"07":return "Julio";break;
			case"08":return "Agosto";break;
			case"09":return "Septiembre";break;
			case"10":return "Octubre";break;
			case"11":return "Noviembre";break;
			case"12":return "Diciembre";break;
		}//end switch
	}//end function

	/*Function: obtener_dia

	*Utilidad:* Si se tiene el formato del día en ingles(Sat, Sun, Mon...) te devuelve el día
	en español (Sábado, Domingo, Lunes...)

	*Parametros:* Día en ingles: Sat, Sun, Mon, Tue, Wed, Thu y Fri

	*Valor(es) retonardo(s):*  El nombre del día, según parametro

      - Sat = Sábado
      - Sun = Domingo
      - Mon = Lunes
      - Tue = Martes
      - Wed = Miércoles
      - Thu = Jueves
      - Fri = Viernes
	*/

	function obtener_dia($dia){
		switch($dia){
			case"Sat":return "Sabado";break;
			case"Sun":return "Domingo";break;
			case"Mon":return "Lunes";break;
			case"Tue":return "Martes";break;
			case"Wed":return "Mi&eacute;rcoles";break;
			case"Thu":return "Jueves";break;
			case"Fri":return "Viernes";break;
		}//end switch
	}//end function


	/*Function: formato_fecha_

	*Utilidad:* Verifica si el formato de una fecha es válido, es decir que a partir del argumento
	recibido (la fecha), realizá un explode por / y verifica que los primeros y segundos parametros
	sean dos y numéricos, por último el tercero parametro acepta cuatro números

	*Parametros:* la fecha dividida con /

	*Valor(es) retonardo(s):*  verdadero o falso

	*/
	function formato_fecha_($fecha){
		list($dia,$mes,$annio) = explode("/",$fecha);
		$b='/';
		$c='-';
		$m=$fecha;
		$fecha=preg_replace("'".$b."'",$c,$m);
		if(ereg( "([0-9]{2})-([0-9]{2})-([0-9]{4})", $fecha)){
			return true; //"formato correcto";
		}else{
			return false; //"formato incorrecto";
		}#end if
	}#end function

	/*Function: retornar_dias

	*Utilidad:* Según el número del mes y el año devuelve el número de días que este tiene, utilizando
	el año para verificar el mes de febrero debido a que este puede variar

	*Parametros:* el número del mes (1 al 12) y el año /

	*Valor(es) retonardo(s):*  números de días del mes: 30,31 y 28 ó 29 en el caso de febrero

	*/

	function retornar_dias($mes_x="",$annio_x){

		$mes_x = preg_replace("'0'","",$mes_x);
		switch($mes_x){
			//''''''''''''''''''''''''''''''
			case 1:
			case 3:
			case 5:
			case 7:
			case 8:
			case 10:
			case 12:
				return $dia = 31;
			break;
			//''''''''''''''''''''''''''''''
			case 4:
			case 6:
			case 9:
			case 11:
				return $dia = 30;
			break;
			//'''''''''''''''''''''''''''''''
			case 2:
				return $this->bisiesto($annio_x);
		}//end switch
	}//end fucntion

	/*Function: bisiesto

	*Utilidad:* verifica si el año es bisiesto y retorna la cantidad de días que tiene el mes de febrero
	para el año en cuestión

	*Parametros:* el año a evaluar

	*Valor(es) retonardo(s):*  números de días del mes de febrero según el año: 28 ó 29

	*/

	function bisiesto($annio_x=""){
		if ((($annio_x%4) == 0) or ($annio_x % 400 == 0)){
			return $dias = 29; //año bisiesto
		}else{
			return $dias = 28;
		}//end if
	}//end function

	/*Function: validar_fecha

	*Utilidad:* valida que una fecha sea correcta, verificando los días, meses y años, el procedimiento
	es el siguiente

	- Se utiliza el médtodo formato_fecha_ para validar el formato

	- Verifica que el mes no sea manor a 1 ni mayor a 12

	- Valida que el año sea mayor a 1900

	- Utiliza el método retornar días para verificar la cantidad de días que corresponden a ese mes según el año

	- Válida que el número de día indicado no sea mayor al que le corresponde según el mes

	*Parametros:* la fecha a validar

	*Valor(es) retonardo(s):*
	- Verdadero en caso de que cada uno de los parametros evaluados no den error
	- falso en caso de que uno de los parametros evaluados este incorrecto

	*/

	function validar_fecha($fecha){
		$b='/';
		$c='-';
		$m=$fecha;
		$fecha=ereg_replace("'".$b."'",$c,$m);
		if (!$this->formato_fecha_($fecha)){
			return false;
		}

		list($dia,$mes,$annio) = explode("-",$fecha);
		if (($mes<1) || ($mes>12)){
			return false; //"mes incorrecto";
		}//end if
		//settype($annio,"integer");
		if($annio<1900){
			return false; //echo "Solo Numeros";
		}//end if
		//verifico cual es el maximo dia correspondiente al mes
		$dia_x = $this->retornar_dias($mes,$annio);
		if($dia > $dia_x){ //Validar que el dia no sea mayor a la cantidad correspondiente según el mes
			return false;
		}//end if
		return true;
	}//end function

	/*Function: restar_fecha

	*Utilidad:* devuelve el número de días, meses y años que ha pasado entre dos fecha (fecha1-fecha2)
	separando la cantidad de días, meses y años con un -

	*Parametros:* fecha a restar, fecha que restará y el modo que indicará si las fechas están divididas
	con - o /

	*Valor(es) retonardo(s):*  cantidad de días (difd), meses(difm) y años(difa) transcurridos
	(difa-difm-difa)

	*/

	function restar_fecha($fecha1="00-00-0000",$fecha2="00-00-0000",$modo="0"){
		if($modo=="0"){
			$fecha_d1 = explode("-",$fecha1);
			$fecha_d2 = explode("-", $fecha2);
		}elseif($modo=="1"){
			list($fecha_d1[0],$fecha_d1[1],$fecha_d1[2]) = explode("/",$fecha1);
			list($fecha_d2[0],$fecha_d2[1],$fecha_d2[2]) = explode("/", $fecha2);
		}#end if
		$fecha = Date("d-m-y", mktime(0, 0, 0, ($fecha_d1[1]-$fecha_d2[1]), ($fecha_d1[0]-$fecha_d2[0]), ($fecha_d1[2]-$fecha_d2[2])));
		return $fecha;
   }#end if

   	//================================================================================================

  	/*Function: fecha_bd

	*Utilidad:* De una fecha normal convierte el formato a una fecha para base de datos,el
	procedimiento es

	- Primero, se realiza un explode por ' para que en caso de que la fecha se encuentre entre '
	se pueda trabajar los la cadena de manera correcta

	- Segundo, se realiza otro explode por / para reordenar la fecha con el formato de base de datos
	(AA-M-D)

	- Tercero, verifica si año el año de la fecha es diferente a 0000, en caso de serlo no devuelve
	ningún valor dentro de ''

	- Cuarto, según el modo se coloca la fecha retornada dentro de ''

	*Parametros:* fecha a convertir y el modo (el modo posee por defecto el valor 0 (cero))

	*Valor(es) retonardo(s):*  La fecha con formato de base de datos, según el modo

	- 0 = 'AAAA-MM-DD'
	- 1 = AAAA-MM-DD

	*/
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
			}elseif($modo==1){
			return $f[2]."-".$f[1]."-".$f[0];
			}
		}else{
			return "''";
		}//end if
	}//end function
	
	function fecha_bdd($fecha_x,$modo="0"){
		$fecha_x = explode("'",$fecha_x);
		if(count($fecha_x)>1){
			$fecha_x = substr($fecha_x[1],0,10);
		}else{
			$fecha_x = substr($fecha_x[0],0,10);
		}#end if
		$f = explode("-",$fecha_x);
		if(count($f)>1 and $f[2] != "0000"){
			if($modo==0){
				return "'".$f[2]."-".$f[1]."-".$f[0]."'";
			}elseif($modo==1){
			return $f[2]."-".$f[1]."-".$f[0];
			}
		}else{
			return "''";
		}//end if
	}//end function
	//==========================================================================================================================

	/*Function: bd_fecha

	*Utilidad:* Convierte el formato de fecha de datos a una fecha normal, el procedimiento es

	- Primero, se realiza un explode por - para reordenar la fecha con el formato normal (D-M-A)

	- Segundo, verifica si año el año de la fecha es diferente a 0000, en caso de serlo no devuelve
	nada

	*Parametros:* fecha a convertir

	*Valor(es) retonardo(s):*  La fecha con formato normal (DD-MM-AAAA)

	*/
	function bd_fecha($fecha_x){
		$f = explode("-",$fecha_x);
		if(count($f)>1 and $f[2] != "0000"){
			$fecha_x = $f[2]."/".$f[1]."/".$f[0];
			return $fecha_x;
		}else{
			return "";
		}//end if
	}// end function
	function formato_hora($hora){
		$hora_es="";
		$horario="A.M.";
		$dato = explode(":",$hora);
		if ($dato[0]>11 && $dato[0]!=0) $horario="P.M.";
		if ($dato[0]==0){
			$hora_es = "12";
		}else{
			if ($dato[0]>12){
				$hora_es=$dato[0]-12;
				if ($hora_es<10) $hora_es = '0'.$hora_es;
			}//end if
		}//end if
		if ($hora_es=="") $hora_es= $dato[0];
		$hora = $hora_es.":".$dato[1].":".$dato[2]." ".$horario;
		return($hora);
	}//end function

	function obtener_fecha_rfc2822($fecha=''){
		//formato: 00/00/0000
		$fecha= empty($fecha)?date('d/m/Y'):$fecha;
		$dd   = explode('/',$fecha);
		$ts   = mktime(0,0,0,$dd[1],$dd[0],$dd[2]);
		return date('D',$ts).", ".date('d',$ts)." ".date('M',$ts)." ".date('Y',$ts)." ".date("H:m:s")." ".date("O");
	}#end function

	function obtener_nombre_dia($fecha=''){
		//formato: 00/00/0000
		$fecha= empty($fecha)?date('d/m/Y'):$fecha;
		$dias = array('Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado');
		$dd   = explode('/',$fecha);
		$ts   = mktime(0,0,0,$dd[1],$dd[0],$dd[2]);
		return $dias[date('w',$ts)];
	}#end function
	
	#función extraída de php.net (http://ve2.php.net/manual/es/function.date-diff.php)
function date_diff($start, $end="NOW"){
	/*// EXAMPLE:
		$start_date = 2010-03-15 13:00:00
		$end_date = 2010-03-17 09:36:15		
		echo date_diff($start_date, $end_date);		
		Returns: 1days 20hours 36min 15sec*/
		
        $sdate = strtotime($start);
        $edate = strtotime($end);

        $time = $edate - $sdate;
        if($time>=0 && $time<=59) {
                // Seconds
                $timeshift = $time.' seconds ';

        } elseif($time>=60 && $time<=3599) {
                // Minutes + Seconds
                $pmin = ($edate - $sdate) / 60;
                $premin = explode('.', $pmin);
               
                $presec = $pmin-$premin[0];
                $sec = $presec*60;
               
                $timeshift = $premin[0].' min '.round($sec,0).' sec ';

        } elseif($time>=3600 && $time<=86399) {
                // Hours + Minutes
                $phour = ($edate - $sdate) / 3600;
                $prehour = explode('.',$phour);
               
                $premin = $phour-$prehour[0];
                $min = explode('.',$premin*60);
               
                $presec = '0.'.$min[1];
                $sec = $presec*60;

                $timeshift = $prehour[0].' hrs '.$min[0].' min '.round($sec,0).' sec ';

        } elseif($time>=86400) {
                // Days + Hours + Minutes
                $pday = ($edate - $sdate) / 86400;
                $preday = explode('.',$pday);

                $phour = $pday-$preday[0];
                $prehour = explode('.',$phour*24);

                $premin = ($phour*24)-$prehour[0];
                $min = explode('.',$premin*60);
               
                $presec = '0.'.$min[1];
                $sec = $presec*60;
               
                $timeshift = $preday[0].' days '.$prehour[0].' hrs '.$min[0].' min '.round($sec,0).' sec ';

        }
        return $timeshift;
}#end function 

function calcular_tiempo($fechaInicio,$fechaActual){
	#$fechaInicio ="28/02/1999";  
	#$fechaActual = "29/04/1999";  
	$diaActual = substr($fechaActual, 0, 2);  
	$mesActual = substr($fechaActual, 3, 5);  
	$anioActual = substr($fechaActual, 6, 10);  
	$diaInicio = substr($fechaInicio, 0, 2);  
	$mesInicio = substr($fechaInicio, 3, 5);  
	$anioInicio = substr($fechaInicio, 6, 10);  
	$b = 0;  
	$mes = $mesInicio-1;  
 if($mes==2){  
 	if(($anioActual%4==0 && $anioActual%100!=0) || $anioActual%400==0){  
 		$b = 29;  
 	}else{  
		 $b = 28;  
 	} #end if $anioActual
 }elseif($mes<=7){  
	if($mes==0){  
	 	$b = 31;  
	}elseif($mes%2==0){  
   		$b = 30;  
	}else{  
   		$b = 31;  
   	}#end if $mes   
 }elseif($mes>7){  
   if($mes%2==0){  
   	$b = 31;  
   }else{  
   	$b = 30;  
   }#end if   
 }#end if $mes=2
 
 if(($anioInicio>$anioActual) || ($anioInicio==$anioActual && $mesInicio>$mesActual) || ($anioInicio==$anioActual && $mesInicio == $mesActual && $diaInicio>$diaActual)){  
   echo "La fecha de inicio ha de ser anterior a la fecha Actual";  
 }else{  
	if($mesInicio <= $mesActual){  
   		$anios = $anioActual - $anioInicio;  
   	if($diaInicio <= $diaActual){  
   		$meses = $mesActual - $mesInicio;  
   		$dies = $diaActual - $diaInicio;  
   }else{  
   		if($mesActual == $mesInicio){  
   		$anios = $anios - 1;  
   }#end if   
  	 $meses = ($mesActual - $mesInicio - 1 + 12) % 12;  
 	  $dies = $b-($diaInicio-$diaActual);  
   }#end if 
 }else{  
   $anios = $anioActual - $anioInicio - 1;  
   if($diaInicio > $diaActual){  
		$meses = $mesActual - $mesInicio -1 +12;  
   		$dies = $b - ($diaInicio-$diaActual);  
   }else{  
   		$meses = $mesActual - $mesInicio + 12;  
   		$dies = $diaActual - $diaInicio;  
   }#end if  
 }#end if  
   /*echo "Años: ".$anios." <br />";  
   echo "Meses: ".$meses." <br />";  
   echo "Días: ".$dies." <br />";  */
   $result = array($anios,$meses,$dies);
   return $result;
 }#end if 
}#end function calcular_tiempo

	function calcula_edad($fecha) {	
		list($dia,$mes,$anio) = split( '[/.-]', $fecha);
		$anio_actual=date("Y");
		$mes=(int)$mes;
		$dia=(int)$dia;
		if((int)date("mes") > $mes){ //le resto 1 porque no se ha cumplido el añio para incrementar la edad
			$edad=$anio_actual-$anio;
		}//end if		
		if(((int)date("mes") == $mes) && ((int)date("d") < $dia)){
			$edad=$anio_actual-$anio-1; //no cumplio
		}//end if 
		if(((int)date("mes") == $mes) && ((int)date("d") > $dia)){
			$edad=$anio_actual-$anio; //no cumplio
		}//end if 
		if(((int)date("mes") == $mes) && ((int)date("d") == $dia)){
			$edad=$anio_actual-$anio; //no cumplio
		}//end if 
		if(((int)date("mes") < $mes) && ((int)date("d") > $dia)){
			$edad=$anio_actual-$anio-1; //ya cumplio
		}//end if 
		if(((int)date("mes") < $mes) && ((int)date("d") < $dia)){
			$edad=$anio_actual-$anio-1; //ya cumplio
		}//end if 
		if(((int)date("mes") < $mes) && ((int)date("d") == $dia)){
			$edad=$anio_actual-$anio-1; //no cumplio
		}//end if 
		return $edad;	
	}//end function	
}//end class


/*$r = new cls_fecha();
echo "pase";
echo $f = $r->sql_fecha("2005-08-06");
//$f = $r->sqlfecha_1("08/06/2005","/");
echo $r->obtener_fecha($f);*/
?>
