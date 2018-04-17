<html>
<head>
<title>Ejercicio #1</title>
</head>
<body>
<form name="Suma">

<?php
$A=$_POST["Num_A"];
$B=$_POST["Num_B"];
?>
<p>A + B:</p>
<input type="text" name="total" value="<?php echo $A + $B; ?>">
<br>
<p>A - B:</p>
<input type="text" name="total" value="<?php echo $A - $B; ?>">
<br>
<p>A x B:</p>
<input type="text" name="total" value="<?php echo $A * $B; ?>">
<br>
<p>A / B:</p>
<input type="text" name="total" value="<?php echo $A / $B; ?>">

</form>


<p><a href="Ejercicio1a.php">Regresar</a></p>
</body>
</html>