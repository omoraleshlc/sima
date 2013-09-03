<?php require("/var/www/html/sima/OPERACIONESHOSPITALARIAS/menuOperaciones.php");
require('/configuracion/clases/devolucionesPI.php');
$tF=new traerFolios();
$tF->foliosDevolucion($entidad,$basedatos);
?>

