<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<?php include('/configuracion/clases/listadoServicios.php'); ?>
<?php
$listaServicios=new listaServicios();
$listaServicios->listadoServicios($entidad,$ALMACEN,$codigo,$basedatos);
?>