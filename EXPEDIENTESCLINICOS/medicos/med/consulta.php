<?php
$usuario="omorales";
$passwd='wolf3333';
$servidor='localhost';


mysql_connect($servidor,$usuario,$passwd); 
$descripcion=$_POST["word"];

$sSQL11= "
SELECT *
FROM diagnosticos
WHERE 
descripcion
LIKE '%$descripcion%'  

ORDER BY descripcion ASC
limit 0,10
";

$result11=mysql_db_query($basedatos,$sSQL11);
while($myrow11 = mysql_fetch_array($result11)){ 


 echo "<a href=\"javascript:selectItem('".$_POST["idContenido"]."',
'".$myrow11["CI"]."')\">".$myrow11["descripcion"].$_POST["descipcion"]."</br>"; 
	}

?>
