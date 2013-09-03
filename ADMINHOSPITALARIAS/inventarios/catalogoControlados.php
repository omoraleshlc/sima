<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<?php include('/configuracion/clases/catalogoMedicamentoControlado.php'); ?>
<?php
$catalogoArticulos=new articulos();
$catalogoArticulos->catalogoArticulos($entidad,$usuario,$codigo,$fecha,$basedatos);
?>
