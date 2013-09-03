<?php require("menuOperaciones.php"); 

require("/configuracion/clases/solicitudesAlmacenes.php");


$titulo='Surtir a Pacientes Directamente';
$desplegar=new solicitudesAlmacenes();
$desplegar->despliegaSolicitudes($hora1,$fecha1,$usuario,$entidad,$titulo,$_GET['datawarehouse'],$basedatos);
?>