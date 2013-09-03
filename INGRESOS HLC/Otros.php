<?PHP require("menuOperaciones.php"); ?>
<?php require("/configuracion/clases/ECOtros.php");?>
<?php
$EC=new Otros();
$EC->estadoCuenta($fecha1,$entidad,$basedatos);
?>
