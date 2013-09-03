<?PHP include("/configuracion/ventanasEmergentes.php");
 include("/configuracion/clases/moduloFacturacion.php");  
 ?>
<?php 

$TITULO='Módulo de Facturación';
$nCliente= $_GET['nCliente'];
$ventana='';

$facturar=new facturacion();
$facturar->facturaDirecta($_GET['tipoFacturacion'],$entidad,$fecha1,$hora1,$dia,$usuario,$_GET['nt'],$basedatos);
?>