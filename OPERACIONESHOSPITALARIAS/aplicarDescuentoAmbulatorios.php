<?php require("menuOperaciones.php"); ?>
<?php require("/configuracion/clases/listaExternosDescuentos.php"); ?>

<?php
$ventana='../cargos/aplicarDescuentos.php';
$TITULO='Px Ambulatorios';

$listaExternosDescuentos=new muestraExternosDescuentos();
$listaExternosDescuentos->listaExternosDescuentos($ALMACEN,$entidad,$TITULO,$ventana,$basedatos);
?>