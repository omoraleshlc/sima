<?php require("menuOperaciones.php"); ?>
<?php require('/configuracion/clases/listaServicios.php'); ?>
<?php
$ventana='ventanaAsignaCuarto.php';
$titulo='Asignar un servicio a un cuarto';
$listaServicios=new listaServicios();
$listaServicios->listadoServicios($titulo,$ventana,$entidad,$ALMACEN,$codigo,$basedatos);
?>