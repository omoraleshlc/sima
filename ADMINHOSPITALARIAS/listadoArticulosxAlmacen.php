<?PHP require("menuOperaciones.php"); ?>
<?php require('/configuracion/clases/listadoArticulosxAlmacen.php'); ?>

<?php
$consultaArticuloxAlmacen=new consultaArticulosPrecioxAlmacen();
$consultaArticuloxAlmacen->consultarArticulosxAlmacen($almacen,$entidad,$basedatos);
?>