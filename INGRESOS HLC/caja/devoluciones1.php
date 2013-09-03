<?PHP include("/configuracion/ingresoshlcmenu/caja/menuCaja.php"); ?>
<?php include("/configuracion/clases/eCuenta.php"); ?>

<?php
$ventana='/sima/INGRESOS%20HLC/caja/liquidarCuenta.php';
$muestraInternos=new muestraInternos();
$muestraInternos->listaInternos($ventana,$basedatos);
?>
