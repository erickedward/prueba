<html>
<head>
<title>Ejercicio #6</title>
</head>
<body>
<form name="Calculo">

<?php
$Numero[0]=$_POST["Num1"];
$Numero[1]=$_POST["Num2"];
$Numero[2]=$_POST["Num3"];
$Numero[3]=$_POST["Num4"];

echo"Los Números Introducidos fueron:<BR>\n";

for ($i=0; $i<4; $i++)
	{
	echo"$Numero[$i]<BR>\n";
	}

for ($i=0;$i<4;$i++)
    {
     for ($j=0;$j<3;$j++)
	{
	  if($Numero[$j] > $Numero[$j+1])
	    {
	     $aux = $Numero[$j];     
         $Numero[$j] = $Numero[$j+1];
	     $Numero[$j+1] = $aux;
	    }
    }                        
    }
echo"<BR><BR><BR><BR>";
echo"El mayor es: $Numero[3] <BR>\n";
echo"El Menor es: $Numero[0] <BR><BR><BR><BR>\n";

$suma= $Numero[0] + $Numero[3];

echo"La suma de ambos es: $suma <BR>\n";
	
?>
      
</form>

<p>&nbsp;</p>
<p><a href="Ejercicio6a.php">Regresar</a></p>
</body>
</html>