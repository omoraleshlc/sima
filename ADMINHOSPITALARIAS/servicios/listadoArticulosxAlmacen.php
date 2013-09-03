<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<?php include('/configuracion/clases/listadoArticulosxAlmacen.php'); ?>
<?php include('/configuracion/funciones.php'); ?>
<?php
$consultaArticuloxAlmacen=new consultaArticulosPrecioxAlmacen();
$consultaArticuloxAlmacen->consultarArticulosxAlmacen($almacen,$entidad,$basedatos);
?>