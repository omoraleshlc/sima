<?PHP require("menuOperaciones.php"); ?>
<?php require('/configuracion/clases/medicosPrecios.php'); ?>

<?php
$medicosPrecios=new consultaMedicosPrecios();
$medicosPrecios->consultarPrecios($almacen,$entidad,$basedatos);
?>