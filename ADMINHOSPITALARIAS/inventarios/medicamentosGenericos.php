<?PHP require("/var/www/html/sima/ADMINHOSPITALARIAS/menuOperaciones.php");  ?>
<?php require('/configuracion/clases/catalogoMedicamentoGenerico.php'); ?>
<?php
$catalogoArticulos=new articulos();
$catalogoArticulos->catalogoArticulos($entidad,$usuario,$codigo,$fecha,$basedatos);
?>
