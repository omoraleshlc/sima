<?php require('/configuracion/ventanasEmergentes.php'); ?>

<?php 
$destruyeSesion=new validator();
$destruyeSesion->destruyeSesion($usuario,$hora1,$fecha1,$basedatos);
 
 
?>