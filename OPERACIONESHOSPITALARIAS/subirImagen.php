<?php require("menuOperaciones.php");  ?>
<?php require("/configuracion/clases/editarResultados.php"); ?>
<?php  
$reporteReportes='agregarImagen.php';
$editarResultados=new  editarResultados();
$editarResultados->editaResultados($entidad,$reporteReportes,$fecha1,$ventana,$TITULO,$_GET['datawarehouse'],$basedatos);
?>