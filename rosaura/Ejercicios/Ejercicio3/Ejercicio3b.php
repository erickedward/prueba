<html>
<head>
<title>Ejercicio #3</title>
</head>
<body>
<form name="Calculo">

<?php
$Cod=$_POST["Cod"];
$NyA=$_POST["NyA"];
$Hor=$_POST["Hor"];
$Sal=$_POST["Sal"];
$Dedu=$_POST["Dedu"];
$Bruto=$Hor*$Sal;
$Des=$Bruto*($Dedu/100);
$Neto=$Bruto-$Des;
?>

<?php echo"Código del Trabajador: $Cod"?>
<br>
<?php echo"Nombre y Apellido del Trabajador: $Cod"?>
<br>
<?php echo"Salario bruto del Trabajador: $Bruto"?>
<br>
<?php echo"Salario neto del Trabajador: $Neto"?>
<br>

</form>

<p>&nbsp;</p>
<p><a href="Ejercicio3a.php">Regresar</a></p>
</body>
</html>