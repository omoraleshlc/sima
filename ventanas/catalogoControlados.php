<?PHP require("/configuracion/ventanasEmergentes.php"); ?>
<?php require('/configuracion/clases/catalogoMedicamentoControlado.php'); ?>
<?php
$catalogoArticulos=new articulos();
$catalogoArticulos->catalogoArticulos($entidad,$usuario,$codigo,$fecha,$basedatos);
?>
