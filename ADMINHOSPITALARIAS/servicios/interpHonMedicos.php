<?PHP require("/var/www/html/sima/ADMINHOSPITALARIAS/menuOperaciones.php"); ?>
<?php require('/configuracion/clases/catalogoHonorariosMedicosxInterpretacion.php'); ?>
<?php
$catalogoServiciosxInterp=new  catalogos();
$catalogoServiciosxInterp->catalogosServicios($entidad,$almacenSolicitante,$usuario,$fecha1,$basedatos);
?>
