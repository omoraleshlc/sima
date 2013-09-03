<?php require("/configuracion/ventanasEmergentes.php"); ?>


<?php
//#########CONFIGURACION DE LA TABLA##############
require("/configuracion/funciones.php");
$nombreTabla='sis_catTipoPlanCell';
$limiteRegistros=0;
$titulo='Tipos de Plan';

//DIBUJA TABLA
$catSoftware=new catalogos();    
$catSoftware-> crearTabla($reservado1,$reservado2,$reservado3,$limiteRegistros,$nombreTabla,$webPage,$titulo,$entidad,$basedatos);
//##############################################
?>