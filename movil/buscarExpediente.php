<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/clases/buscarExpediente.php"); ?><?php include("/configuracion/funciones.php"); ?>



<?php  $buscarExpediente=new expedientes();
$buscarExpediente->buscarExpediente($usuario,$numeroE,$basedatos); ?>

