<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/clases/catalogoClientes.php"); ?>

<?php
$muestraClientes=new editarClientes();
$muestraClientes->editarC($entidad,$numCliente,$usuario,$ID_EJERCICIOM,$db_conn,$basedatos);
?>