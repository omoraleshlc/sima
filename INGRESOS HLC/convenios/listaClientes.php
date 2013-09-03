<?PHP require("/var/www/html/sima/INGRESOS HLC/menuOperaciones.php"); 
require("/configuracion/clases/listaClientes.php"); 

?>
<?php $lista=new listadoClientes();
$TITULO='Lista [Convenio por Articulos/Servicios Precios Fijos]';
$ventana='agregarArticulos.php';
$ventana1='despliegaConvenios.php';
$lista->listaClientes('cantidad',$entidad,$ventana,$ventana1,$TITULO,$basedatos);
?>