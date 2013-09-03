<?PHP require("menuOperaciones.php"); ?>
<?php require('/configuracion/clases/catalogoHonorariosMedicos.php'); ?>
<?php
$catalogoServiciosxInterp=new  catalogosS();
$catalogoServiciosxInterp->catalogosServicios($entidad,$almacenSolicitante,$usuario,$fecha1,$basedatos);
?>