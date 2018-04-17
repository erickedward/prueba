<?php
	//include_once("../function/sesion_sin_header.php");
	
  ob_start();
  ob_implicit_flush(0);
  if ($_GET['y']==1)
  {   
    require('../view/planillaconsulta1.php');
    $html= ob_get_clean();

    require_once("../dompdf/dompdf_config.inc.php");
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream("Supervisores_que_han_cargado_tareas.pdf");  
  }
 
  if ($_GET['y']==2)
  {   	
    require('../view/planillaconsulta2.php');
    $html= ob_get_clean();

    require_once("../dompdf/dompdf_config.inc.php");
    $dompdf = new DOMPDF();
 
    //Aqui esta para cambiar la orientacion de la pagina
    $dompdf->set_paper('letter','landscape');
      
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream("Listado_ObjetivosY_Tareas.pdf");  
  }
  if ($_GET['y']==3)
  {
    $monto_num = $_POST['monto_num'];
    $monto_let = $_POST['monto_let'];
    $nombre_ben = $_POST['nombre_ben'];
    $ciudad = $_POST['ciudad'];
    $fecha = $_POST['fecha'];
    $anio = date(Y);

    require('../view/planilla_cheque.php');
    $html= ob_get_clean();

    require_once("../dompdf/dompdf_config.inc.php");
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream("Cheque.pdf");  
  }
 
  
exit(0);
?>
