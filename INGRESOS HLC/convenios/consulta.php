<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<?php
$descripcion=$_POST["word"];
//$descripcion="DOLAC";
$sSQL11= "
SELECT *
FROM articulos
WHERE 
descripcion
LIKE '%$descripcion%'  
and
um='s'
ORDER BY descripcion ASC LIMIT 0,10

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
'".$myrow11["codigo"]."')\">".$myrow11["descripcion"].$_POST["descipcion"]."</br>"; 
	}

?>
