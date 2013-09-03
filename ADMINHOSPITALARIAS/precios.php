<?PHP require("menuOperaciones.php"); 
if($_GET['warehouse']=='INVENTARIOS'){
require("/configuracion/clases/listadoArticulosPrecio.php");
}elseif($_GET['warehouse']=='SERVICIOS'){
require("/configuracion/clases/listadoServiciosPrecio.php");    
}
?>
<?php 
$consultarArticulos=new consultaArticulosPrecio();
$consultarArticulos->consultarArticulos($ALMACEN,$entidad,$basedatos);
?>
