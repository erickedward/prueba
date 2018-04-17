<html>
<head>
<title>Ejercicio #3</title>
</head>
<body>
<form name="Calculo">

<?php
$NyA=$_POST["NyA"];
$Hor=$_POST["Hor"];
$Sal=$_POST["Sal"];
$Bruto=$Hor*$Sal;

if ($Bruto>450000)
{
echo"$NyA<br>$Bruto";    
}
else
{
echo"$NyA";
}
?>
      
</form>

<p>&nbsp;</p>
<p><a href="Ejercicio4a.php">Regresar</a></p>
</body>
</html>