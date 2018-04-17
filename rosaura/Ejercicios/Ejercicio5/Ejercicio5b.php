<html>
<head>
<title>Ejercicio #5</title>
</head>
<body>
<form name="Calculo">

<?php
$A=$_POST["A"];
$B=$_POST["B"];
$C=$_POST["C"];


if (($A>$B) && ($A>$C)){
	
	echo"La Esfera A es la más pesada";}

else{

     if (($B>$A) && ($B>$C)){

        echo"La esfera B es la más pesada";}

     else{

        echo"La esfera C es la mas pesada";}
    }
?>
      
</form>

<p>&nbsp;</p>
<p><a href="Ejercicio5a.php">Regresar</a></p>
</body>
</html>