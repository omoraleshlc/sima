<?php require("menuOperaciones.php"); ?>
<?php require("/configuracion/clases/pacientesInternosUrgencias.php") ?>
<?php 
$TITULO='Cargos a  Pacientes';
$ventana='/sima/cargos/solicitaArticulos.php';
$ventana1='../ventanas/datosAdicionales.php';
$muestraPI=new pacientesInternosUrgencias();
$muestraPI->listadoPI($entidad,$TITULO,$ventana,$ventana1,$_GET['datawarehouse'],$basedatos);
?>