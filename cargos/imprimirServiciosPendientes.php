<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/clases/imprimeServiciosPendientes.php"); ?><?php include("/configuracion/funciones.php"); ?>
<?php
$imprimirServiciosP=new imprimirServicios();
$imprimirServiciosP->imprimirServiciosP($entidad,$fecha1,$hora1,$_GET['numeroE'],$_GET['nCuenta'],$_GET['keyCAP'],$basedatos);
?>