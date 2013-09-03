<?php 
$conexion = mysql_connect("localhost","omorales","wolf3333"); 
$basedatos="sima";
?>
<?php
$apellido1=$_POST["word"];
/* $sSQL11= "
SELECT *
FROM pacientes
WHERE CONCAT_WS(apellido1 , apellido2, apellido3 , nombre1 , nombre2) 
LIKE '%$apellido1%'  
order by 
apellido1 asc 
limit 0,20
"; */
$sSQL11= "
SELECT *
FROM pacientes
WHERE 
apellido1 LIKE '%$apellido1%'  
or
apellido2 LIKE '%$apellido1%'  
or
apellido3 LIKE '%$apellido1%'  
or
nombre1 LIKE '%$apellido1%'  
or
nombre2 LIKE '%$apellido1%'  
order by 
apellido1 asc 
limit 0,20
";

$result11=mysql_db_query($basedatos,$sSQL11);
while($myrow11 = mysql_fetch_array($result11)){ 

		// Mostramos las lineas que se mostraran en el desplegable. Cada enlace
		// tiene una funcion javascript que pasa los parametros necesarios a la
		// funcion selectItem
		
//echo "<a href=\"javascript:selectItem('".$_POST["idContenido"]."','".$myrow11["apellido1"].$myrow11["nombre1"]."')\">"."</a>";
/* echo "<a href=\"javascript:selectItem('".$_POST["idContenido"]."',
'".$myrow11["apellido1"]." ".$myrow11["apellido2"]." ".$myrow11["apellido3"]." ".
$myrow11["nombre1"]." ".$myrow11["nombre2"]."  Exp: ".$myrow11["numCliente"]."')\">".$myrow11["apellido1"]." ".$myrow11["apellido2"]." ".$myrow11["apellido3"]." ".$myrow11["nombre1"]
." ".$myrow11["nombre2"]." || ".$myrow11["numCliente"]."</a>"; */
 echo "<a href=\"javascript:selectItem('".$_POST["idContenido"]."',
'".$myrow11["numCliente"]."')\">".$myrow11["apellido1"]." ".$myrow11["apellido2"]." ".$myrow11["apellido3"]." ".$myrow11["nombre1"]
." ".$myrow11["nombre2"]." || ".$myrow11["numCliente"]."</a>".'<br>'; 
	}

?>
