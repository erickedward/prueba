<?php
#Incluir Clases
function __autoload($class_name) {
    require_once "../cls/".$class_name.'.php';
}//end function

echo "Hola mundo";
$f = new cls_funciones();
echo "<br>->".$f->enviar_correo("rserrano@opsu.gob.ve","rserrano@opsu.gob.ve","XX","YY");
$f->nombre_correo = "Richard Serrano C.";
$f->usuario_correo = "rserrano";
$f->clave_correo = "Rich487";
echo "<br>->".$f->enviar_correo2("rserrano@opsu.gob.ve","rserrano@opsu.gob.ve","Prueba","Contenido");
?>