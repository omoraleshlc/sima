<?PHP require("/configuracion/ventanasEmergentes.php"); ?>
<?php require('/configuracion/clases/catalogoMateriales.php'); ?>
<?php
$catalogoArticulos=new articulos();
$catalogoArticulos->catalogoArticulos($entidad,$usuario,$codigo,$fecha,$basedatos);
?>
