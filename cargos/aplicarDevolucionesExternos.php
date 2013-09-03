<?php require('/configuracion/ventanasEmergentes.php');

require("/configuracion/clases/aplicarDevolucionExternos.php");
require("/configuracion/funciones.php"); 
$cargosCia=new acumulados();
$cargosParticularesCC=new  cierraCuenta();
$cargosAseguradoraCC=new cierraCuenta();



$devExternos=new devE();
$devExternos->devolucionExternos($usuario,$folioVenta,$entidad,$basedatos);
?>
