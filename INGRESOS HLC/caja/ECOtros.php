<?PHP require("/var/www/html/sima/INGRESOS HLC/menuOperaciones.php"); ?>
<?php require("/configuracion/clases/ECOtros.php");?>
<?php
$EC=new Otros();
$EC->estadoCuenta($fecha1,$entidad,$basedatos);
?>