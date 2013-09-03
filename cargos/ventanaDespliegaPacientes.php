<?php require("/configuracion/ventanasEmergentes.php");?>
<?php include('/configuracion/clases/desplegarPacientesxHora.php'); ?>
<?php include('/configuracion/funciones.php'); ?>
<?php 
$desplegar= new despliegaPx();
$desplegar->pxHora($entidad,$_GET['almacenDestino'],$usuario,$numeroE,$basedatos);

?>