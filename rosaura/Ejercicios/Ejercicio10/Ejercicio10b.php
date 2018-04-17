<html>
<head>
<title>Ejercicio #10</title>
</head>
<body>
<form name="Calculo">

<?php
$tope=$_POST["tope"];
$fact=1;

for($i=1;$i<=$tope;$i++)
   {
    $fact=($fact * $i);
    echo"El factorial de: $i es: $fact <BR>";
   }
?>
</form>
<p>&nbsp;</p>
<p><a href="Ejercicio10a.php">Regresar</a></p>
</body>
</html>