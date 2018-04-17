<html>
<head>
<title>Ejercicio #2</title>
</head>
<body>
<form name="Elevar">

<?php
$A=$_POST["Num"];
?>
<p>Cuadrado:</p>
<input type="text" name="total" value="<?php echo $A * $A; ?>">
<br>
<p>Cubo:</p>
<input type="text" name="total" value="<?php echo $A * $A * $A; ?>">

</form>



<p>&nbsp;</p>
<p><a href="Ejercicio2a.php">Regresar</a></p>
</body>
</html>