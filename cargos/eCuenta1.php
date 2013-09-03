<?php require("/configuracion/ventanasEmergentes.php");  ?>
<?php include("/configuracion/clases/cierraCuenta2.php"); ?>


<?php 
$TITULO='ESTADO DE CUENTA';
$cierreCuenta=new eCuentas();
$cierreCuenta->eCuenta($ALMACEN,'no',$TITULO,$entidad,$fecha1,$hora1,$dia,$usuario,$_GET['nt'],$basedatos);
?>









