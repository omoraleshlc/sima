<?php require("menuOperaciones.php");  ?>
<?php require("/configuracion/clases/expedientesDuplicados.php"); ?>



<?php  $buscarExpediente=new expedientes();
$buscarExpediente->expedientesDuplicados($entidad,$usuario,$numeroE,$basedatos); ?>