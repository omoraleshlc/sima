<?php require("/configuracion/ventanasEmergentes.php");  ?>
<?php include("/configuracion/clases/cierraCuenta4.php"); ?>


<?php 
$tipoFacturacion='particular';
$cierreCuenta=new eCuentas();
$cierreCuenta->eCuenta($tipoFacturacion,$entidad,$fecha1,$hora1,$dia,$usuario,$_GET['nt'],$basedatos);
?>
