<?PHP require("/var/www/html/sima/ADMINHOSPITALARIAS/menuOperaciones.php"); 
require("/configuracion/clases/listadoServiciosGPOProducto.php");?>
<?php 
$consultarArticulos=new consultaArticulosPrecio();
$consultarArticulos->consultarArticulos($ALMACEN,$entidad,$basedatos);
?>
