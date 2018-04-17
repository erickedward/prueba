<html>
<head>
<title>Ejercicio #8</title>
</head>
<body>
<form name="Calculo">

<?php
$tope=$_POST["tope"];
$n=0;
$Suma_Impar=0;
$Impar=0;

do{
$n = ($n+1);
$Impar = (2*$n-1);
$Suma_Impar = ($Suma_Impar + $Impar);
}while ($Impar < $tope);

echo"La suma de numeros impares del 1 al $tope es: $Suma_Impar <BR>";

?>
</form>
<p>&nbsp;</p>
<p><a href="Ejercicio8a.php">Regresar</a></p>
</body>
</html>