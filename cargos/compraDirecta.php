<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/clases/ventanaGeneraReq.php"); ?>




<?php 

$compraDirecta=new comprasDirectas(); 
$compraDirecta->compraDirecta($fecha1,$hora1,$_GET['almacen'],$basedatos,$usuario,$entidad);
?>
