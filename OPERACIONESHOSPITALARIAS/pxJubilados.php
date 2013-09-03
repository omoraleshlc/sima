<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php"); ?>
<?php require("/configuracion/clases/pacientesJubilados.php"); ?>

<?php 
$ventana='ventanitaCambiaPorcentaje.php';
$pxJubilados=new jubilados();
$pxJubilados->pacientesJubilados($ventana,$entidad,$usuario,$numeroE,$basedatos);
?>

