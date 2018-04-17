<html>
<head>
<title>Ejercicio #7</title>
</head>
<body>
<form name="Calculo">

<?php
$Cant_Manzanas=$_POST["Cant_Manzanas"];
$Precio_Manzana=$_POST["Precio_Manzana"];
$Monto=($Cant_Manzanas*$Precio_Manzana);

if ($Cant_Manzanas <= 2)
   {
	echo"El Monto a pagar es: $Monto Bs. <BR> sin descuento";
   }
 elseif(($Cant_Manzanas >= 3) && ($Cant_Manzanas <= 5))
     {
	  $Descuento = ($Monto * 0.10);
	  $Monto_Pagar = ($Monto - $Descuento);
      echo"El Monto a pagar es: $Monto_Pagar Bs. <BR> Con un descuento del 10%";
	 }
    else
	  {
	   if (($Cant_Manzanas >= 6) && ($Cant_Manzanas <= 10))
	      {
	       $Descuento = ($Monto * 0.15);
		   $Monto_Pagar = ($Monto - $Descuento);
 	       echo"El Monto a pagar es: $Monto_Pagar Bs. <BR> Con un descuento del 15%";
		  }
	 	  else
		     {
              $Descuento = ($Monto * 0.20);
		      $Monto_Pagar = ($Monto - $Descuento);
              echo"El Monto a pagar es: $Monto_Pagar Bs. <BR> Con un descuento del 20%";
    		 }
          }
?>
      
</form>

<p>&nbsp;</p>
<p><a href="Ejercicio7a.php">Regresar</a></p>
</body>
</html>