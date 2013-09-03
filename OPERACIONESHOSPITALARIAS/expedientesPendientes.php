<?php require("/var/www/html/sima/OPERACIONESHOSPITALARIAS/menuOperaciones.php"); ?>
<?php require("/configuracion/clases/despliegaExpedientesPendientes.php"); ?>


<?php
$ventana='';

$despliegaExpedientes=new despliegaExpedientesPendientes();
$despliegaExpedientes->despliegaExpedientes($entidad,$ventana,$fecha1,$hora1,$ALMACEN,$basedatos);
?>
