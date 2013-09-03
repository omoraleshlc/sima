<?PHP  include("/configuracion/ventanasEmergentes.php");
include("/configuracion/clases/despliegaConsultasAnterioresMovil.php"); 
include("/configuracion/funciones.php"); ?>

<?php

$despliegaCA=new despliegaCA();
$despliegaCA->consultasAnteriores($ventana,$TITULO,$_POST['numeroE'],$basedatos);
?>