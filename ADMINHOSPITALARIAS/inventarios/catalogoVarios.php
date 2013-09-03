<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<?php include('/configuracion/clases/catalogos.php'); ?>
<?php
$catalogoArticulos=new catalogos();
$catalogoArticulos->catalogoArticulos($entidad,$usuario,$codigo,$fecha,$basedatos);
?>
















