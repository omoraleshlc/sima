<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php require("/configuracion/clases/imprimeFactura.php"); ?><?php require("/configuracion/funciones.php"); ?>

<?php 

printInvoice::imprimirFactura($_GET['nT'],$_GET['nCuenta'],$_GET['seguro'],$fecha1,$_GET['numeroE'],$basedatos);
?>