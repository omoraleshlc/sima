<?PHP require("/var/www/html/sima/ADMINHOSPITALARIAS/menuOperaciones.php"); ?>
<?php require('/configuracion/clases/medicosPrecios.php'); ?>

<?php
$medicosPrecios=new consultaMedicosPrecios();
$medicosPrecios->consultarPrecios($almacen,$entidad,$basedatos);
?>