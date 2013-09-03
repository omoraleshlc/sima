<?PHP require("/var/www/html/sima/INGRESOS HLC/menuOperaciones.php"); 
require("/configuracion/clases/listaClientes.php"); ?>
<?php $lista=new listadoClientes();
$TITULO='Descuentos sobre Convenios';
$ventana='agregarDescuentosConvenios.php';
$ventana1='despliegaDescuentosConvenios.php';
$lista->listaClientes('descuentoConvenio',$entidad,$ventana,$ventana1,$TITULO,$basedatos);
?>
