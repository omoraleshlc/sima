<?php require('/configuracion/ventanasEmergentes.php'); ?>
<?php require('/configuracion/clases/catalogoMedicamentoPatente.php'); ?>
<?php
$catalogoArticulos=new articulos();
$catalogoArticulos->catalogoArticulos($entidad,$usuario,$codigo,$fecha,$basedatos);
?>
