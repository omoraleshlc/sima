<?php require("/configuracion/ventanasEmergentes.php"); 
//#########CONFIGURACION DE LA TABLA##############
require("/configuracion/funciones.php");
$nombreTabla='sis_catTipoProcesador';
$limiteRegistros=0;
$titulo='Catalogo de Tipo de Procesador';

//DIBUJA TABLA
$catSoftware=new catalogos();    
$catSoftware-> crearTabla($reservado1,$reservado2,$reservado3,$limiteRegistros,$nombreTabla,$webPage,$titulo,$entidad,$basedatos);
//##############################################
?>
