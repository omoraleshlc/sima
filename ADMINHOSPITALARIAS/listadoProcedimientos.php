<?PHP require("menuOperaciones.php"); ?>
<?php require('/configuracion/clases/listadoServicios.php'); ?>
<?php
$listaServicios=new listaServicios();
$listaServicios->listadoServicios($entidad,$ALMACEN,$codigo,$basedatos);
?>