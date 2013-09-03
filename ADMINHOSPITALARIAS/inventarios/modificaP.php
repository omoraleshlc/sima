<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<?php include('/configuracion/clases/catalogos.php'); ?>
<?php
$catalogoServicios=new catalogos();
$catalogoServicios->catalogosServicios($entidad,$ALMACEN,$usuario,$fecha,$basedatos);

?>