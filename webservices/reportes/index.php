<?php

error_reporting(E_ALL);
ini_set("display_errors", "1");

$url = $_GET['x'];

if (!empty($_GET['a'])) {
    $a = $_GET['a'];
}else{
    $a = "A4";
    $a = "LETTER";
}

if (!empty($_GET['al'])) {
    $al = $_GET['al'];
}else{
    $al = "P"; 
}
//print_r($_GET);
//echo "x ->".$_GET['x'];
//echo "<br>l ->".$_GET['l'];
if (!empty($_GET['x'])) {
    $lugar = "";
    if (!empty($_GET['l'])) {
        //echo "xxxxxx";

        //$url = $url . ".html";

        switch ($_GET['l']) {
            case 'fti':
                break;
            case 'sed':
                if (!empty($_GET['dir'])) {
                    $lugar = $_GET['dir']."/includes/docs_pdf/doc/";
                }else{
                    $lugar = "http://sed.mppeuct.gob.ve/sed/includes/docs_pdf/doc/";
                }
                //correos a los que les llegara el error;
                $_GET['c'] = "rserrano@opsu.gob.ve";
                break;
            case 'prueba':
                $lugar = "http://172.17.12.58/";
            break;
            case 'a':
                $lugar = "http://asistencia.opsu.gob.ve/reportes/";
            break;
            case 'al':
                $lugar = "http://172.17.12.58/reportes/";
            break;
            case 'ap':
                $lugar = "http://asistencia.prueba.opsu.gob.ve/reportes/";
            break;
            case 'ma':
                $lugar = "http://172.17.12.64/";
            break;
        }
    }

    //error_log($lugar.$url);

    if ($homepage = file_get_contents($lugar . $url)) {
        ob_start();
        ob_get_contents();
        echo $homepage;

        $content = ob_get_clean();

        require_once('lib/html2pdf/html2pdf.class.php');
        try {
            $html2pdf = new HTML2PDF($al, $a, 'es', true, 'UTF-8', 0);
            $html2pdf->writeHTML($content);
            $html2pdf->Output('doc.pdf');
        } catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    } else {
        echo "<h1>No se encontraron documentos</h1>";
    };
} else {
    echo "<h1>No se encontraron documentos.....</h1>";
    die;
}
?>
