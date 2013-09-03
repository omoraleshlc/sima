<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/clases/modificarMedicos.php");?>
<?php
$modificaMedicos=new modificarMedicos();
$modificaMedicos->modificaMedico($entidad,$_GET['numMedico'],$basedatos);
?>