<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">

html {
	margin: 0;
	padding: 0;
	}
body {

	margin: 0 auto;
	padding: 0;
	font: 12px normal Times New Roman;

}
.bodycentro{
	margin: 0px auto 0px auto;
	text-align:center;
}
/************************************************** CABECERAS *************************************/

#cabecera{
	margin: 0 auto;
	width: 761px;
	border: #000 0px solid
}

#cabecera2{
	background: url(../images/back.jpg) repeat;
	margin: 0 auto;

	border: #000 0px solid
}

#cintillo {
	background: url(http://localhost/concurso/images/cintillo3.png) no-repeat top left;
	height: 60px;
	width: 758px;
	margin-top:2px;
}



#superior{
	background: url(../images/superior2.gif) no-repeat top left;
	height: 30px;
	width: 760px;
	margin-top:1px;
}

.tabla1{
	border-collapse:collapse;
	font: 11px normal Times New Roman;
	text-align:left;
}
.tabla1 td{
	border: 1px solid black;
}


.tabla2{
	border-collapse:collapse;
	font: 11px normal Times New Roman;
	text-align:left;

}
.tabla2 td{
	padding-left:20px;
	border: 1px solid black;
}

.tabla3{
	border-collapse:collapse;
	font: 11px normal Times New Roman;
	text-align:left;

}
.tabla3 td{
	padding-left:5px;
	padding-bottom:25px;
	border: 1px solid black;
}

.nada td{
	border: 0px solid black;
}

/************************************************** CONTENIDO DEL CENTRO *************************************/


#centro, #centro2{
	background: url(../images/centro.gif) repeat-y;
	height: 1200px;  /*TAMAÑO CUERPO*/
	width: 758px;
	border: #000 0px solid;
	margin: 0 auto;
	margin-bottom:20px;

}

#centro2{
	background: url(../images/centro.gif) repeat-y;
	height: 550px;  /*TAMAÑO CUERPO*/
	width: 758px;
	border: #000 0px solid;
	margin: 0 auto;
	margin-bottom:20px;
}

#centro3{
	background: url(../images/centro.gif) repeat-y;
	height: 900px;  /*TAMAÑO CUERPO*/
	width: 758px;
	border: #000 0px solid;
	margin: 0 auto;
	margin-bottom:20px;
}

#texto{
	padding-left: 70px;
	padding-right: 70px;
	font: 14px normal Arial;
	line-height:22px
}


/*******************************************FOOT***************************************/

#inferior{
	background: url(../images/inferior.gif) no-repeat top left;
	height: 40px;
	width: 759px;
	padding-bottom:20px;
}



</style>

</head>

<body>
	<br/>
	<div id="centro2">
	<table border="1" width="500px" algin="center">
	 <tr>
	   <td>
	   <img src="http://localhost/concurso/images/cintillo.png">
		<table border="0" width="500px" cellpadding="5px" algin="left">

			 <tr>
			 	<th align="left">
			 		RECAUDOS CONSIGNADOS POR EL ASPIRANTE:
			 	</th>
			 </tr>
			 <tr valing="top">
			 	<td>
					<table class="tabla2" cellpadding="1px" algin="left" width="490px" border="1">
						<tr align="center">
							<th width="440">RECAUDOS</th>
							<th width="30">MARCAR</th>
							<th width="30">CANTIDAD</th>
						</tr>
						<tr>
							<td>Planilla de Solicitud de Ingreso a la Funci&oacute;n Pública a un cargo de carrera.</td>
							<td><input type="checkbox"></td>
							<td><input type="text" size="1" maxlength="1" onkeypress="return validarNum(event)"></td>
						</tr>
						<tr>
							<td>Resumen curricular</td>
							<td><input type="checkbox"></td>
							<td><input type="text" size="1" maxlength="1" onkeypress="return validarNum(event)"></td>
						</tr>
						<tr>
							<td>Copia fotostática de la cédula de identidad, ampliada y legible</td>
							<td><input type="checkbox"></td>
							<td><input type="text" size="1" maxlength="1" onkeypress="return validarNum(event)"></td>
						</tr>
						<tr>
							<td>Fotografía tamaño carnet (2)</td>
							<td><input type="checkbox"></td>
							<td><input type="text" size="1" maxlength="1" onkeypress="return validarNum(event)"></td>
						</tr>
						<tr>
							<td>Fondo negro de los títulos Bachiller o Pregrado debidamente registrado, según sea el caso</td>
							<td><input type="checkbox"></td>
							<td><input type="text" size="1" maxlength="1" onkeypress="return validarNum(event)"></td>
						</tr>
						<tr>
							<td>Fondo negro del título de Postgrado debidamente registrado, según sea el caso</td>
							<td><input type="checkbox"></td>
							<td><input type="text" size="1" maxlength="1" onkeypress="return validarNum(event)"></td>
						</tr>
						<tr>
							<td>Copia fotostática  de los certificados de cursos o talleres realizados.</td>
							<td><input type="checkbox"></td>
							<td><input type="text" size="1" maxlength="1" onkeypress="return validarNum(event)"></td>
						</tr>
						<tr>
							<td>Copia fotostáticas de las constancias de trabajo  o antecedentes de servicio (FP023) en caso que haya laborado en la Administración Pública.</td>
							<td><input type="checkbox"></td>
							<td><input type="text" size="1" maxlength="2" onkeypress="return validarNum(event)"></td>
						</tr>
						<tr>
							<td>Original de constancia de estudio actualizada y calificaciones en Instituciones de Educación Universitaria</td>
							<td><input type="checkbox"></td>
							<td><input type="text" size="1" maxlength="1" onkeypress="return validarNum(event)"></td>
						</tr>
						<tr>
							<td>Declaración  Jurada del aspirante de no haber sido objeto de rescisiones de contrato de trabajo por incumplimiento en otras instituciones públicas o privadas, ni de haber sido destituido de otras instituciones.</td>
							<td><input type="checkbox"></td>
							<td><input type="text" size="1" maxlength="1" onkeypress="return validarNum(event)"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<p align="justify" style="font-size:11px;">
					&nbsp;&nbsp;Los certificados de cursos o talleres deben indicar fecha y número de horas expedido por un centro de formación    reconocido, con una antigüedad no mayor de seis (06) años.
					<br><br>
					&nbsp;&nbsp;Las constancias de trabajo relativas a la experiencia en la administración publica o privada, para ser tomadas en cuenta, deberán presentar el número de registro de información fiscal (RIF) correspondiente, con la dirección, teléfonos y sello húmedo de la empresa o institución, expedidas por la Oficina de Personal, Gerente General o Presidente de la Empresa.
					<br><br>
					&nbsp;&nbsp;Los títulos, diplomas o constancias expedidos por instituciones extranjeras deben estar legalizados y traducidos por un intérprete público, si estuvieran escritos en idioma diferente al castellano.
					<br><br>
					&nbsp;&nbsp;Todos los recaudos que se consignen, deberán ir acompañados de sus originales o copia certificada para que al momento de la solicitud de preinscripción para que sean cotejados con su original para la debida certificación.
					<br><br>
					<b>NOTA: LA VALORACION DE LAS CREDENCIALES SE HARA EN BASE AL PERFIL EXIGIDO PARA EL CARGO SOMETIDO A CONCURSO, ES DE HACER NOTAR QUE LA ACEPTACION DE LOS RECAUDOS NO IMPLICA LA INSCRIPCIÓN EN EL PROCESO.</b>
					<br><br>
					Declaro, bajo fe de juramento, que la presente información es fiel reflejo de mi situación laboral a la fecha indicada. Autorizo de manera expresa e irrevocable al Ministerio del Poder Popular para la Educación Universitaria, a revisar la información suministrada, y tomar las acciones administrativas y legales necesarias en el caso.
					<br><br>
					Doy fe de que los datos suministrados son ciertos, en la ciudad de Caracas a los  __________  días del mes de _________________ de 2010.
					</p>
				</td>
			</tr>

		</table>
		<br><br><br>
		<table class="tabla3" cellpadding="0px" algin="center" width="500px" border="1">
			<tr align="center">
				<th colspan="2" width="50%">ASPIRANTE</th>
				<th colspan="2" >FUNCIONARIO</th>
			</tr>
			<tr>
				<td colspan="2">NOMBRES Y APELLIDOS</td>
				<td colspan="2">NOMBRES Y APELLIDOS</td>
			</tr>
			<tr valign="top">
				<td width="20%">C.I. Nº</td>
				<td width="30%">Correo electronico:</td>
				<td colspan="2">C.I. Nº</td>
			</tr>
			<tr>
				<td colspan="2">FIRMA:</td>
				<td colspan="2">FIRMA:</td>
			</tr>
		</table>
	   </td>
	  </tr>
	 </table>
	 </div>
</body>

</html>