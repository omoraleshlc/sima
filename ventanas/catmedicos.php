<?php require("/configuracion/ventanasEmergentes.php");?>
<?php require("/configuracion/clases/modificarMedicos.php");?>
<?php
$modificaMedicos=new modificarMedicos();
$modificaMedicos->modificaMedico($entidad,$_GET['medico'],$basedatos);
?>