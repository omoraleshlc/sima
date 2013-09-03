<?php include('/configuracion/ventanasEmergentes.php');?>

<?php
include("/configuracion/clases/listadoArticulosPrecioMovil.php");?>
<?php 
$consultarArticulos=new consultaArticulosPrecio();
$consultarArticulos->consultarArticulos($ALMACEN,$entidad,$basedatos);
?>