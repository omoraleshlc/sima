<?PHP require("/var/www/html/sima/ADMINHOSPITALARIAS/menuOperaciones.php"); ?>
<?php require('/configuracion/clases/listadoArticulosxAlmacen.php'); ?>

<?php
$consultaArticuloxAlmacen=new consultaArticulosPrecioxAlmacen();
$consultaArticuloxAlmacen->consultarArticulosxAlmacen($almacen,$entidad,$basedatos);
?>