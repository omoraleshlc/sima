<?PHP include("/configuracion/ingresoshlcmenu/cxc/menuCXC.php"); 
include("/configuracion/clases/cierraCuenta5.php"); ?>


<?php 
$tipoFacturacion='aseguradora';
$cierreCuenta=new eCuentas();
$cierreCuenta->eCuenta($tipoFacturacion,$entidad,$fecha1,$hora1,$dia,$usuario,$_GET['folioVenta'],$basedatos);
?>
