<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>::SRO::</title>
	<style type="text/css">
	body{
	margin-top:100px;
	margin-left:40px;
	margin-right:40px;
	margin-bottom:40px;
	}
	#Cuerpo {
		z-index:2;
		left: 0px;
		top: 50px;
	}
	table{
	border-collapse:collapse;
	border:#c0c0c0 solid 1px;
	}
	table td{
		font-size: 12px;
		padding-left: 5px;
		border-left: #c0c0c0 solid 1px;
		border-right: #c0c0c0 solid 1px; 				
	}
	table th{
		background-color: #FF0000;	
		font-size: 14px;	
		color: #FFFFFF;
		font-weight: bold;
	}
	p{
	text-align:justify;
	}
	h1{
	color:#848484;
	border-bottom:#848484 solid 1px;
	font-size: 18px;
	}
	h2{
	color:#848484;
	font-size: 14px;
	}
	.Estilo3 {
		font-size: 12px;	
		color: #FFFFFF;
		font-weight: bold;
		text-align: center;
	}
	td.BordeTOP
	{
		border-top: #c0c0c0 solid 1px; 
	}
	</style>
</head>
<body>
	<!-- Script para crear los encabezados y los pie de pagina al documento PDF-->
	<script type="text/php">
	$header=$pdf->open_object();
	$font = Font_Metrics::get_font("verdana", "bold");
	$texto = "Objetivos y Tareas por Dependencia";
	$hpagina = $pdf->get_height();
	$wpagina = $pdf->get_width();
	$wtexto = Font_Metrics::get_text_width($texto, $font, 12);
	$pdf->image("../images/banner700.jpg", "jpg", 40, 40, 700, 50);
	$pdf->page_text($wpagina/2 - $wtexto/2, $hpagina-50, $texto,
	$font, 12, array(0,0,0));
	$pdf->page_text($wpagina/2 , $hpagina-35, "{PAGE_NUM}" ,
	 $font, 12, array(0,0,0));
	$pdf->close_object();
	$pdf->add_object($header, "all");
	</script>

	<div id="wrapper" style="width: 100٪; margin-top: 10px;">
	  <div id="container" style="width: 700px; margin-left:auto; margin-right:auto;">
	  <div id="Cuerpo">
	  	<h1 align="center" >Listado de Objetivos y Tareas por Dependencia. Periodo <?php echo PERIODO; ?></h1>
	    <br /><br />
	    <table width="100%">
	      <tr align="center">
	        <th width="20%"><span class="Estilo3">DEPENDENCIA</span><</th>	      
	        <th width="15%"><span class="Estilo3">SUPERVISOR</span><</th>
	        <th width="10%"><span class="Estilo3">C&Eacute;DULA</span><</th>
	        <th width="15%"><span class="Estilo3">CARGO</span><</th>
	        <th width="20%"><span class="Estilo3">OBJETIVO</span><</th>
	        <th width="20%"><span class="Estilo3">TAREA</span><</th>	        
	      </tr>						
	    
	      <tr>	        	              
	        <td class="BordeTOP">RRHH</td>
	        <td class="BordeTOP">Pedro Perez</td>
	        <td class="BordeTOP">12345678</td>
	        <td class="BordeTOP">Director</td>
	        <td class="BordeTOP">Objetivo 1</td>
	        <td class="BordeTOP">Tarea 1</td>	        	        
	      </tr>
	        
	      <tr>
	        <td > </td>	        	              
	        <td class="BordeTOP">Mar&iacute;a Pe&ntilde;a</td>
	        <td class="BordeTOP">7894561</td>
	        <td class="BordeTOP">Coordinador</td>
	        <td class="BordeTOP">Objetivo-1</td>
	        <td class="BordeTOP">Tarea-1</td>	        	        
	      </tr>	            			
        
	      <tr>
	        <td > </td>	        	              
	        <td > </td>
	        <td > </td>
	        <td > </td>
	        <td class="BordeTOP">Objetivo-2</td>
	        <td class="BordeTOP">Tarea-1</td>	        	        
	      </tr>	             			
	        
	      <tr>
	        <td > </td>	        	              
	        <td > </td>
	        <td > </td>
	        <td > </td>
	        <td > </td>
	        <td class="BordeTOP">Tarea-2</td>	        	        
	      </tr>	              			
	            
	    </table>  
	  </div>
	</div>
	</div>
</body>
</html>
