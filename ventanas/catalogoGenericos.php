<?PHP require("/configuracion/ventanasEmergentes.php"); ?>
<?php require('/configuracion/clases/catalogoMedicamentoGenerico.php'); ?>
<?php
$catalogoArticulos=new articulos();
$catalogoArticulos->catalogoArticulos($entidad,$usuario,$codigo,$fecha,$basedatos);
?>
