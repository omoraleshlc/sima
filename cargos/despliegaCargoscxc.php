<?php require("/configuracion/ventanasEmergentes.php"); ?><?php require("/configuracion/funciones.php"); ?>
<?php require("/configuracion/clases/eCCIsT.php"); ?>
<?php
$eCuenta=new estadoCuentas();
$eCuenta-> eCCI(FALSE,$usuario,$entidad,$_GET['folioVenta'],$basedatos);
?>