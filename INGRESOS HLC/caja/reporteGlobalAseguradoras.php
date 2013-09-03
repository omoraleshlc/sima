<?PHP require("/var/www/html/sima/INGRESOS HLC/menuOperaciones.php"); ?>
<?php require("/configuracion/clases/reporteGlobalAseguradoras.php");?>




<?php
$EC=new ECC();
$EC->estadoCuenta($entidad,$basedatos);
?>