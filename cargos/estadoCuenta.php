<?php include("/configuracion/ventanasEmergentes.php"); ?><?php include("/configuracion/funciones.php"); ?>
<?php require("/configuracion/clases/eCCI.php"); ?>
<?php
$eCuenta=new estadoCuentas();
$eCuenta-> eCCI($usuario,$entidad,$_GET['folioVenta'],$basedatos);
?>