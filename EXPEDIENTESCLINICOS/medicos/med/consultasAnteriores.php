<?PHP 
include("/configuracion/expedientesclinicos/medicos/medicosmenu.php");  
include("/configuracion/clases/despliegaConsultasAnteriores.php"); 
include("/configuracion/funciones.php"); ?>

<?php

$despliegaCA=new despliegaCA();
$despliegaCA->consultasAnteriores($ventana,$TITULO,$_POST['numeroE'],$basedatos);
?>