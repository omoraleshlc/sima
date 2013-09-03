<?php require('/configuracion/ventanasEmergentes.php');

if($_GET['paquetes']){
require("/configuracion/formas/aplicarPaquete.php"); 
} else if($_GET['cargos']){
require("/configuracion/formas/ventaEstudiantes.php"); 
}
?>