<?PHP require("/var/www/html/sima/INGRESOS HLC/menuOperaciones.php"); 
require("/configuracion/clases/listaClientes.php"); ?>
<?php $lista=new listadoClientes();
$TITULO='Precios Especiales';
$ventana='agregarPrecioEspecial.php';
$ventana1='despliegaPreciosEspeciales.php';
$lista->listaClientes('precioEspecial',$entidad,$ventana,$ventana1,$TITULO,$basedatos);
?>
