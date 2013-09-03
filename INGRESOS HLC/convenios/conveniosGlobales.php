<?PHP require("/var/www/html/sima/INGRESOS HLC/menuOperaciones.php"); 
require("/configuracion/clases/listaClientes.php"); ?>
<?php $lista=new listadoClientes();

$TITULO='Convenios Globales';
$ventana='conveniosGlobalesV.php';
$ventana1='despliegaConveniosGlobales.php';
$tipoconvenio='global';
$lista->listaClientes($tipoconvenio,$entidad,$ventana,$ventana1,$TITULO,$basedatos,$tipoconvenio);
?>
