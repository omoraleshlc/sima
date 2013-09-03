<?PHP include("/configuracion/ingresoshlcmenu/caja/menuCaja.php"); ?>
<?php include("/configuracion/clases/eCuenta.php"); ?>

<?php
$ventana='/sima/cargos/facturarParticulares.php';
$TITULO='Facturar Px Particular';
$muestraInternos=new muestraInternos();
$muestraInternos->listaInternos($ALMACEN,$entidad,$TITULO,$ventana,$basedatos);
?>
