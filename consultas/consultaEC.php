<?php include("/configuracion/ventanasEmergentes.php");include("/configuracion/clases/cierraCuenta2.php");  ?>
<?php 
$consultar=new eCuentas();
$consultar->eCuenta($bali,$transacciones,$TITULO,$entidad,$fecha1,$hora1,$dia,$usuario,$nT,$basedatos);
?>