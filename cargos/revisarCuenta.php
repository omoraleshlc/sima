<?php require("/configuracion/ventanasEmergentes.php");  ?>
<?php include("/configuracion/clases/revisarCuenta.php"); ?>


<?php 
$TITULO='Revisar Cuentas';
$revisarCuenta=new revisionCuentas();
$revisarCuenta->revisarCuenta($ALMACEN,'no',$TITULO,$entidad,$fecha1,$hora1,$dia,$usuario,$_GET['nt'],$basedatos);
?>









