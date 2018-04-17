<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>::SRO::</title>
	<style type="text/css">
	#container{margin-left:auto; margin-right:auto; margin-top:48px; font-size:11px; /*font-weight:bold;*/}
	#monto_num{margin-left:405px; margin-top:7px; font-size: 12px;}
	#monto_let{margin-left:110px; margin-top:7px;}
	#nombre_ben{margin-left:100px; margin-top:29px;}
	#ciudad_fecha_anio{margin-left:85px; margin-top:23px;}
	#ciudad_fecha{width:140px}
	#anio{margin-left:40px; position:absolute; display:inline;}
	</style>
</head>
<body>
	<!-- Script para crear los encabezados y los pie de pagina al documento PDF-->
	<script type="text/php">
	 //$pdf->image("../images/fondo_cheque.jpg", "jpg", 18, 0, 580, 780);
	</script>
	  <div id="container">
	    <div id="monto_num"><?php echo "*  ".$monto_num."  *"; ?></div> 
	    <div id="nombre_ben"><?php echo "*  ".$nombre_ben."  *"; ?></div> 
	    <div id="monto_let"><?php echo "*  ".$monto_let."  *"; ?></div> 
	    <div id="ciudad_fecha_anio">
              <div id="ciudad_fecha"><?php echo $ciudad.", ".$fecha; ?></div>
              <div id="anio"><?php echo $anio; ?></div> 
            </div>
	     
	  </div>
</body>
</html>
