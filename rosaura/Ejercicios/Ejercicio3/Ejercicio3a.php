<html>
<head>
<title>Ejercicio #3</title>
</head>
<body>
<FORM name="Numeros" ACTION="Ejercicio3b.php" METHOD="POST">

<?php
echo"Introduzca el c�digo del empleado:"
?>
<INPUT TYPE="text" NAME="Cod" SIZE="20">
<br>
<?php
echo"Introduzca Nombre y Apellido del Empleado:"
?>
<INPUT TYPE="text" NAME="NyA" SIZE="20">
<br>
<?php
echo"Introduzca el n�mero de horas trabajadas en el mes por el empleado:"
?>
<INPUT TYPE="text" NAME="Hor" SIZE="20">
<br>
<?php
echo"Introduzca el monto del salario por hora del empleado:"
?>
<INPUT TYPE="text" NAME="Sal" SIZE="20">
<br>
<?php
echo"Introduzca el porcentaje de deducci�n del salario del empleado:"
?>
<INPUT TYPE="text" NAME="Dedu" SIZE="20">


<br /><br /><input TYPE="SUBMIT" NAME="SUBMIT" value="Calcular">

</form>

</body>
</html>