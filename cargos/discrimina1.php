<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/clases/discrimina1.php"); ?>

<?php

$cierreCuenta=new eCuentas();
$cierreCuenta->eCuenta($fecha1,$hora1,$dia,$usuario,$_GET['nt'],$basedatos);

?>
