<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php require("/configuracion/clases/internarPaciente.php"); ?>
<?php require("/configuracion/funciones.php"); ?>
<?php 

if(!$ALMACEN) $ALMACEN=$_GET['almacen'];
$mostrarPaciente=new internar();
$mostrarPaciente->internarPaciente($fecha1,$hora1,$entidad,$_GET['almacen'],$usuario,$NUMEROE,$basedatos);
?>