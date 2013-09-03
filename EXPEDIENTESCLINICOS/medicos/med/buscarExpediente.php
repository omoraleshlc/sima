<?PHP include("/configuracion/expedientesclinicos/medicos/medicosmenu.php"); ?>
<?php include("/configuracion/clases/buscarExpediente.php"); ?><?php include("/configuracion/funciones.php"); ?>


<?php  $buscarExpediente=new expedientes();
$buscarExpediente->buscarExpediente($entidad,$usuario,$numeroE,$basedatos); ?>
