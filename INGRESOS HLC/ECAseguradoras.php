<?PHP require("/var/www/html/sima/INGRESOS HLC/menuOperaciones.php"); ?>
<?php require("/configuracion/clases/ECAseguradoras.php");?>




<?php
$EC=new ECC();
$EC->estadoCuenta($entidad,$basedatos);
?>