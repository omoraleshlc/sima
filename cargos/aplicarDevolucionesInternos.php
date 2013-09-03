<?php require('/configuracion/ventanasEmergentes.php');

require("/configuracion/clases/aplicarDevolucionInternos.php");
require("/configuracion/funciones.php"); 
$cargosCia=new acumulados();
$cargosParticularesCC=new  cierraCuenta();
$cargosAseguradoraCC=new cierraCuenta();


$devInternos=new devE();
$devInternos->devolucionInternos($usuario,$folioVenta,$entidad,$basedatos);
?>
