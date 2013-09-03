<?php require("/var/www/html/sima/OPERACIONESHOSPITALARIAS/menuOperaciones.php"); ?>
<?php require('/configuracion/clases/articulosSurtidos.php'); ?>
<?php
$aSurtidos=new articulos();
$aSurtidos->surtidos($fecha1,$usuario,$entidad,$_GET['warehouse'],$codigo,$basedatos);

?>

 