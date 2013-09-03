<?PHP require("/configuracion/ventanasEmergentes.php"); ?>
<?php require('/configuracion/clases/catalogos.php'); ?>
<?php
$catalogoArticulos=new catalogosOtros();
$catalogoArticulos->catalogoArticulos($entidad,$usuario,$codigo,$fecha,$basedatos);
?>
















